'''
@author: JF/mrm
'''

import logging
import threading
import time
import datetime
import os
import sys
import PySQLPool
import QoEManager
import socket
import random
import MySQLdb
import config
import urllib2
import xml.dom.minidom
import requests # revisar diferencia json vs json()
import json
            
class Node(threading.Thread):
    id             = 0
    ipAddress      = "127.0.0.1"
    ipAddressAlias = "127.0.0.1"
    monitor        = 0
    tipo           = 1
    username       = "admin"
    password       = "1234"
    
    inCall       = False
    isAlive      = True
    myQoEManager = None
    running      = False
    connection   = None
    
    handler = None
    opener  = None
    
    content   = None
    error     = 0
    errorCode = ""
    
    msg      = None
    netStats = None
    advStats = None
    
    xmldoc   = None
    
    # HUAWEI
    # session=False
    acSessionId = None
    # certificate=False
    timeout= 5
    
    ac_txPacks = 0
    ac_txPlost = 0
    ac_rxPacks = 0
    ac_rxPlost = 0
    
    def constructor(self,myQoEManager,id,dirIP,dirIPAlias,monitor,tipo,username,password,inCall):
        self.myQoEManager   = myQoEManager
        self.id             = id
        self.ipAddress      = dirIP
        self.ipAddressAlias = dirIPAlias
        self.monitor        = monitor
        self.tipo           = tipo
        self.username       = username
        self.password       = password
        self.connection     = myQoEManager.connection
        
        if inCall > 0:
            self.inCall = True
            
        if self.username != None:
            if self.tipo == 10:
                #CISCO
                self.debug("Creado nodo CISCO con valores ID=%s dirIP=%s dirIPAlias=%s monitor=%s tipo=%s username=%s password=%s inCall=%s"  %(id,dirIP,dirIPAlias,monitor,tipo,username,password,inCall))
            elif self.tipo in [3,4,8,9] :
                #POLYCOM
                self.debug("Generando HTTP digest para nodo")
                self.handler = urllib2.HTTPDigestAuthHandler()
                self.handler.add_password(config.realm[tipo],self.ipAddress,username,password)
                self.opener = urllib2.build_opener(self.handler)
                self.debug("Creado nodo Polycom con valores %s %s %s %s %s %s %s %s"  %(id,dirIP,dirIPAlias,monitor,tipo,username,password,inCall))
            elif self.tipo == 11:
                #Huawei 9030
                self.debug("Creado nodo HUAWEI con valores ID=%s dirIP=%s dirIPAlias=%s monitor=%s tipo=%s username=%s password=%s inCall=%s"  %(id,dirIP,dirIPAlias,monitor,tipo,username,password,inCall))
            else:
                self.lerror("Unknown node type %s %s -> %s" % (id,dirIP,tipo))
                self.monitor=0

    def run(self):
        if self.monitor != 0:
            self.running = True
            
            if self.inCall:
                wait_time = config.incall_wait_time
            else:
                wait_time = config.wait_time
            
            espera = random.randint(0, wait_time)
            self.debug("Esperando %d segundos antes de comenzar" %espera)
            time.sleep(espera)
            newIsAlive = self.isAlive
            newInCall  = self.inCall
            
            if self.tipo==11:
                self.huawei_loop()
            else:
                while (self.running):
                    self.debug("Haciendo polling a nodo %s en %s" % (self.id,self.ipAddress))
                    self.poll()

                    if self.error == 0:
                        if self.tipo == 10:
                            #CISCO
                            self.debug("Recibido desde polling CISCO: %s" % self.xmldoc)
                            newIsAlive = True
                        else:
                            #POLYCOM
                            self.debug("Recibido desde polling Polycom: %s" % self.content)
                            newIsAlive = True
                    else:
                        self.warning("Error durante polling %d - %s" % (self.error, self.errorCode))
                        if self.error == 2:
                            newIsAlive = True
                        else:
                            newIsAlive = False

                    if self.isAlive != newIsAlive:
                        self.debug("Transicion de isAlive para nodo desde %d a %d" %(self.isAlive, newIsAlive))
                        if newIsAlive==False:
                            self.warning("Nodo abajo")
                            
                        self.updateNodeIsAlive(newIsAlive)
                        
                    self.isAlive = newIsAlive
                    if self.isAlive:
                        ###
                        self.processContent()
                        if self.error!=0:
                            self.warning("Error procesando contenido %s - %s" %(self.error,self.errorCode))
                            HTTPerror = self.errorCode
                            newInCall = False
                            try:
                                if HTTPerror == "401":
                                    self.HTTPerror401()
                                if HTTPerror == "404":
                                    self.HTTPerror404()
                                #if HTTPerror == "500":
                                    #self.HTTPerror500()
                                if HTTPerror == "502":
                                    self.HTTPerror502()
                            except Exception, e:
                                self.warning("No se pudo capturar error HTTP. - %s" %e)
                        else:
                            if self.tipo == 10:
                                #CISCO
                                if self.xmldoc != None:
                                    self.debug("Procesado correctamente el contenido XML = %s" % self.xmldoc)
                                    newInCall = self.isInCall()
                                    if self.error != 0:
                                        self.debug("No pudo obtener inCall desde XML CISCO %s - %s" %(self.error,self.errorCode))
                                    else:
                                        self.debug("Obtenido isInCall = %s desde polling" % newInCall)
                            else:
                                #POLYCOM
                                self.debug("Procesado correctamente el contenido msg = %s" % self.msg)
                                if self.msg == "":
                                    self.debug("Valor vacio de msg - equipo se reseteo")
                                    newInCall = False
                                else:
                                    newInCall = self.isInCall()
                                    if self.error != 0:
                                        self.debug("No pudo obtener inCall desde msg Polycom %s - %s" %(self.error,self.errorCode))
                                    else:
                                        self.debug("Obtenido isInCall = %s desde polling" % newInCall)
                    else:
                        newInCall = False
                    
                    if self.inCall != newInCall:
                        self.debug("Transicion de inCall para nodo desde %d a %d" %(self.inCall,newInCall))
                        self.updateNodeInCall(newInCall)
                        self.generateCallEvent(newInCall)
                        self.ac_txPacks=0
                        self.ac_txPlost=0
                        self.ac_rxPacks=0
                        self.ac_rxPlost=0
                    
                    self.inCall = newInCall
                    
                    if self.inCall:
                        if self.isAlive:
                            try:
                                if self.tipo == 10:
                                    #CISCO
                                    self.CISCOinsertMediciones()
                                else:
                                    #POLYCOM
                                    self.insertMediciones()
                            except Exception, e:
                                self.warning("Error insertando mediciones %s" %e)
                        time.sleep(config.incall_polling_time)
                    else:
                        time.sleep(config.polling_time)
            self.debug("Node %s not running anymore.. bye" % self.id)
        else:
            self.debug("Nodo %d no chequea conectividad (monitor = 0)" % self.id)

####POLYCOM PROCESSING FUNCTIONS

    def insertMediciones(self):
        query = None
        try:
            query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando tbmedidas n BD: %d %s" % (e.args[0], e.args[1]))
            return
        
        tipo = 1 #RX packet loss
        valor = self.getRxPercentPacketLoss()
        if self.error == 0:
            self.debug("Insertando medicion RX packet loss, tipo=%d valor=%s" % (tipo,valor))
            if valor == "---":
                self.warning("Valor no es numero. valor=%s" % valor)
                valor = 0.0
            try:
                insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
                self.debug("Agregando fila %s a BD" %insertQuery)
                query.Query(insertQuery)
                self.debug("Fila insertada en %d" %query.lastInsertID)
            except MySQLdb.Error, e:
                self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        else:
            self.warning("Error procesando RX Packet loss %s - %s" %(self.error,self.errorCode))
            

        tipo = 2 #RX jitter
        valor = self.getRxVideoJitter()
        if self.error == 0:
            self.debug("Insertando medicion RX video jitter, tipo=%d valor=%s" % (tipo,valor))
            if valor == "---":
                self.warning("Valor no es numero. valor=%s" % valor)
                valor = 0.0
            try:
                insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
                self.debug("Agregando fila %s a BD" %insertQuery)
                query.Query(insertQuery)
                self.debug("Fila insertada en %d" %query.lastInsertID)
            except MySQLdb.Error, e:
                self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        else:
            self.warning("Error procesando RX Video jitter %s - %s" %(self.error,self.errorCode))
         
        tipo = 6 #TX packet loss
        valor = self.getTxPercentPacketLoss()
        if self.error == 0:
            self.debug("Insertando medicion TX packet loss, tipo=%d valor=%s" % (tipo,valor))
            if valor == "---":
                self.warning("Valor no es numero. valor=%s" % valor)
                valor = 0.0
            try:
                insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
                self.debug("Agregando fila %s a BD" %insertQuery)
                query.Query(insertQuery)
                self.debug("Fila insertada en %d" %query.lastInsertID)
            except MySQLdb.Error, e:
                self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        else:
            self.warning("Error procesando TX Packet loss %s - %s" %(self.error,self.errorCode))
            
        tipo = 7 #TX jitter
        valor = self.getRxVideoJitter()
        if self.error == 0:
            self.debug("Insertando medicion TX video jitter, tipo=%d valor=%s" % (tipo,valor))
            if valor == "---":
                self.warning("Valor no es numero. valor=%s" % valor)
                valor = 0.0
            try:
                insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
                self.debug("Agregando fila %s a BD" %insertQuery)
                query.Query(insertQuery)
                self.debug("Fila insertada en %d" %query.lastInsertID)
            except MySQLdb.Error, e:
                self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        else:
            self.warning("Error procesando TX Video jitter %s - %s" %(self.error,self.errorCode))

        #Insercion de datos en tbllamadas
        plrx = self.getRxPercentPacketLoss()
        self.debug("capturado plrx = %s" % plrx)
        if self.error == 0:
            if plrx == "---":
                self.warning("plrx no es numero. valor=%s" % plrx)
                plrx = 0.0
            
            pltx = self.getTxPercentPacketLoss()
            self.debug("capturado pltx = %s" % pltx)
            if self.error == 0:
                if pltx == "---":
                    self.warning("pltx no es numero. valor=%s" % pltx)
                    pltx = 0.0
                self.debug("Se insertaran mediciones en tbllamadas RX Packet Loss=%s y TX Packet Loss=%s para el nodo POLYCOM = %s" % (plrx,pltx,self.id))
                try:
                    updateQuery = "update tbllamadas set nplTX = nplTX + 1, nplRX = nplRX + 1, totalplTX = (npltx * totalpltx + %s) / (npltx+1), totalplRX = (nplrx * totalplrx + %s) / (nplrx + 1), rtplTX = (0.9 * rtpltx) + (0.1 * %s), rtplRX = (0.9 * rtplrx) + (0.1 * %s) where nodo=%s and estado = 1" % (pltx,plrx,pltx,plrx,self.id)
                    self.debug("Enviando consulta %s a BD" % updateQuery)
                    query.Query(updateQuery)
                    self.debug("Query modifico %d filas" % query.affectedRows)
                except MySQLdb.Error, e:
                    self.lerror("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))
                        
            else:
                self.warning("Error procesando TX Packet loss %s - %s" %(self.error,self.errorCode))
        else:
            self.warning("Error procesando RX Packet loss %s - %s" %(self.error,self.errorCode))

    def updateNodeIsAlive(self,estatus):
        self.debug("Actualizando isAlive a %d en BD" %estatus)
        #
        if estatus == 1:
            # Detecta Nodo Arriba
            self.HTTPnodeAlive()
        else:
            #Detecta Nodo Abajo
            self.HTTPtimedOut()
        try:
            query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
            updateQuery = "update tbnodos set isAlive=%d,lastTest=now() where idtbNodo=%d" % (estatus,self.id)
            self.debug("Enviando consulta %s a BD" %updateQuery)
            query.Query(updateQuery)
            self.debug("Query modifico %d filas" %query.affectedRows)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))   
    
    def processContent(self):
        if self.tipo != 10:
            #POLYCOM
            if self.content == None:
                self.msg = None
                self.netStats = None
                self.advStats = None
            else:
                try:
                    temp = self.content.split("'")
                    self.msg = temp[1]
                    self.netStats = temp[3]
                    self.advStats = temp[5]
                except Exception, e:
                    self.error=1
                    self.errorCode = "%s" %e
                    self.msg = None
                    self.netStats = None
                    self.advStats = None

    def getMsg(self):
        return self.msg
    
    def getNetStats(self):
        return self.netStats
    
    def getAdvStats(self):
        return self.advStats
    
    def getVar(self,stat,var=1):
        if stat==None:
            self.error = 1
            self.errorCode = "String esta vacio"
            return None
        else:
            try:
                temp = stat.split("|")[var]
            except Exception, e:
                self.error=1
                self.errorCode = "%s" %e
                return None
            else:
                return temp
    
    def getVarMsg(self,var=1):
        return self.getVar(self.msg,var)

    def getVarNetStats(self,var=1):
        return self.getVar(self.netStats,var)

    def getVarAdvStats(self,var=1):
        return self.getVar(self.advStats,var)

    def getTransferRate(self):
        temp = self.getVarNetStats(4)
        if temp.endswith("K"):
            self.debug("Obteniendo valor para Transfer Rate %s" % (temp))
            return temp
        else:
            self.debug("No se pudo obtener Transfer Rate.")
            return "N/D"
        
    def getCallStatus(self):
        return self.getVarMsg(3)

    def getCallDirection(self):
        return self.getVarMsg(9)
    
    def getPeer(self):
        return self.getVarAdvStats(0)

    def getPeerIP(self):
        return self.getVarAdvStats(1)
    
    def getTxPercentPacketLoss(self):
        temp = self.getVarNetStats(7)
        if temp.endswith("%"):
            return self.getVarNetStats(7).split(" ")[0]
        else:
            self.debug("La funcion getTxPercentPacketLoss no devuelve valor deseado.")
            return 0.0
    
    def getRxPercentPacketLoss(self):
        temp = self.getVarNetStats(15)
        if temp.endswith("%"):
            return self.getVarNetStats(15).split(" ")[0]
        else:
            temp = self.getVarNetStats(22)
            if temp.endswith("%"):
                self.debug("Se obtiene valor de funcion getRxPercentPacketLoss alternativo para %s" % (temp))
                return self.getVarNetStats(22).split(" ")[0]
            else:
                self.debug("Se devuelve valor por default. La funcion getRxPercentPacketLoss no devuelve valor deseado.")
                return 0.0
    
    def getTxVideoJitter(self):
        return self.getVarAdvStats(9).split(" ")[0]

    def getRxVideoJitter(self):
        return self.getVarAdvStats(21).split(" ")[0]

####SHARED FUNCTIONS

    def poll(self):
        if self.tipo == 10:
            #CISCO
            response = None
            try:
                fullURL = "http://"+self.ipAddress +"/getxml?location=Status/Call"
                response,error = self.getURLResponse(self.ipAddress, self.username, self.password, fullURL)
                self.debug("Recibido response= %s - error= %s" % (response, error))
                if error == None:
                    self.error = 0
                else:
                    self.error =1
                    self.errorCode = "%s" % error
            except Exception, e:
                self.error = 1
                self.errorCode = "%s" % e
            else:
                self.error = 0
            
            if response != None:
                try:
                    self.xmldoc = xml.dom.minidom.parse(response)
                except Exception, e:
                    self.error = 1
                    self.errorCode = "%s" % e
                else:
                    self.error = 0
            else:
                self.error = 1
        elif self.tipo in [3,4,8,9] :
            #POLYCOM
            response = None
            fullURL="ERROR"
            try:
                fullURL = "http://"+self.ipAddress +"/"+config.xml[self.tipo]
            except Exception, e:
                self.error = 1
                self.errorCode = "%s" % e
                self.lerror("Cant build fullURL %s %s %s" % (self.ipAddress,self.tipo,config.xml[self.tipo]))
                return
                
            self.debug("Polling POLYCOM con usuario %s y password %s a %s" % (self.username, self.password, fullURL))
            
            try:
                req = urllib2.Request(fullURL)
                if self.username==None:
                    response = urllib2.urlopen(req)
                else:
                    response = self.opener.open(fullurl=fullURL)
            except urllib2.URLError, e:
                if hasattr(e, 'reason'):
                    self.error = 1
                    self.errorCode = "%s" % e.reason
                elif hasattr(e, 'code'):
                    self.error = 2
                    self.errorCode = "%s" % e.code
                response     = None
                self.content = None
            except Exception, e:
                self.error = 1
                self.errorCode = "%s" % e
            else:
                self.error = 0
                
            if response != None:
                try:
                    self.content = response.read()
                    response.close()
                except Exception, e:
                    self.error = 1
                    self.errorCode = "%s" % e
                else:
                    self.error = 0
        elif self.tipo == 11:
            pass
                    
    def isInCall(self):
        if self.tipo == 10:
            #CISCO
            try:
                #doc1      = xml.dom.minidom.parse(self.xmldoc)
                #version   = self.xmldoc.childNodes[0].attributes.get("version").value
                call      = self.xmldoc.childNodes[0].childNodes[1]
                #callid    = call.attributes.get("item").value
                status    = self.CISCOgetValue(call,1)
                direction = self.CISCOgetValue(call,3)
                self.debug("Nodo CISCO con estado = %s" % status)
                self.error = 0
                return True
            except Exception, e:
                self.debug("Cisco: Exception en isInCall() Error %s se asume que esta desconectado" %e)
                self.error = 1
                return False
        else:
            #POLYCOM
            tmp = self.getCallStatus()
            if self.error!=0:
                return False
            if tmp=="disconnected":
                self.error=0
                return False
            elif tmp=="connected":
                self.error=0
                return True
            else:
                self.error=1
                self.errorCode="Estatus desconocido %s" % tmp
                return False

    def updateNodeInCall(self,newInCall):
        if newInCall:
            inCall=1
        else:
            inCall=0
        self.debug("Actualizando tbNodos InCall=%d en BD" % inCall)
        try:
            query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
            updateQuery = "update tbnodos set inCall=%d,lastTest=now() where idtbNodo=%d" % (inCall,self.id)
            self.debug("Enviando consulta %s a BD" % updateQuery)
            query.Query(updateQuery)
            self.debug("Query modifico %d filas" % query.affectedRows)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))
    
    def generateCallEvent(self,newInCall):
        if newInCall:
            tipo = 1
            estado = 1 #InCall
        else:
            tipo = 2
            estado = 0 #No InCall
        self.debug("Agregando evento tipo=%d en tbEventos para nodo" % tipo)
        try:
            query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
            insertQuery = "insert into tbeventos (tipo,tiempo,fecha,node) values (%d,now(),CURDATE(),%d)" % (tipo,self.id) 
            self.debug("Agregando fila %s a BD" % insertQuery)
            query.Query(insertQuery)
            self.debug("Fila insertada en %d" % query.lastInsertID)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando nodo %d %s" % (e.args[0], e.args[1]))

        if self.tipo == 10:
            #CISCO
            if estado == 1:
                self.debug("Insertando nueva llamada en tbllamadas, Nodo CISCO = %d estado = %d" % (self.id, estado))
                try:
                    #doc1 = xml.dom.minidom.parse(self.xmldoc)
                    call = self.xmldoc.childNodes[0].childNodes[1]
                    callDirection = self.CISCOgetValue(call,3)
                    nodoPeerIP    = self.CISCOgetValue(call,9)
                    nodoPeerText  = self.CISCOgetValue(call,13)
                    #TransferRate  = self.CISCOgetValue(call,15)
                    TransferRate  = self.CISCOgetValue(call,15)
                    TransferRate  = TransferRate + " K"
                    self.error = 0
                except Exception, e:
                    self.lerror("CISCO Exception getting data for generateCallEvent: Error procesando doc1 %s" % e)
                    self.error = 1
                try:
                    if self.error != 1:
                        query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
                        insertQuery = "insert into tbllamadas (nodo, NodoPeerText, NodoPeerIP, inicio, fecha, estado, direccion, velocidad) values (%d, '%s', '%s', NOW(), CURDATE(), %d, '%s', '%s');" % (self.id,nodoPeerText,nodoPeerIP,estado,callDirection,TransferRate)
                        self.debug("Enviando query = %s a BD" %insertQuery)
                        query.Query(insertQuery)
                        self.debug("Fila insertada en %d" %query.lastInsertID)
                except MySQLdb.Error, e:
                    self.lerror("Error insertando datos de llamada en tbllamadas : %d %s" % (e.args[0], e.args[1]))
            else:
                self.debug("Actualizando datos de llamada en tbllamadas, Nodo=%d estado=%d" % (self.id, estado))
                try:
                    updateQuery = "update tbllamadas set estado=0, termino=now() where nodo=%d and estado=1" % (self.id)
                    self.debug("Enviando query %s a BD" % updateQuery)
                    query.Query(updateQuery)
                    self.debug("Query modifico %d filas" %query.affectedRows)
                except MySQLdb.Error, e:
                    self.lerror("Error actualizando datos de la llamada %d: $s" % (e.args[0], e.args[1]))
        elif self.tipo == 11: 
            #HUAWEI
            if estado == 1:
                self.debug("Insertando nueva llamada en tbllamadas, Nodo HUAWEI = %d estado = %d" % (self.id, estado))
                try:
                    nodoPeerText,nodoPeerIP,callDirection,TransferRate,self.error = self.huaweiGetConfParamsInfoAPI()
                except Exception, e:
                    self.lerror("Huawei Exception getting data for generateCallEvent: Error procesando doc1 %s" % e)
                    self.error = 1
                try:
                    if self.error != 1:
                        query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
                        insertQuery = "insert into tbllamadas (nodo, NodoPeerText, NodoPeerIP, inicio, fecha, estado, direccion, velocidad) values (%d, '%s', '%s', NOW(), CURDATE(), %d, '%s', '%s');" % (self.id,nodoPeerText,nodoPeerIP,estado,callDirection,TransferRate)
                        self.debug("Enviando query = %s a BD" %insertQuery)
                        query.Query(insertQuery)
                        self.debug("Fila insertada en %d" %query.lastInsertID)
                except MySQLdb.Error, e:
                    self.lerror("Error insertando datos de llamada en tbllamadas : %d %s" % (e.args[0], e.args[1]))
            else:
                self.debug("Actualizando datos de llamada en tbllamadas, Nodo=%d estado=%d" % (self.id, estado))
                try:
                    updateQuery = "update tbllamadas set estado=0, termino=now() where nodo=%d and estado=1" % (self.id)
                    self.debug("Enviando query %s a BD" % updateQuery)
                    query.Query(updateQuery)
                    self.debug("Query modifico %d filas" %query.affectedRows)
                except MySQLdb.Error, e:
                    self.lerror("Error actualizando datos de la llamada %d: $s" % (e.args[0], e.args[1]))
        elif self.tipo in [3,4,8,9] :
            #POLYCOM
            if estado == 1:
                self.debug("Insertando nueva llamada en tbllamadas, Nodo=%d estado=%d" % (self.id, estado))
                nodoPeerText = self.getPeer()
                if self.error == 0:
                    nodoPeerIP = self.getPeerIP()
                    if self.error == 0:
                        callDirection = self.getCallDirection()
                        if self.error == 0:
                            TransferRate = self.getTransferRate()
                            if self.error == 0:
                                try:
                                    query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
                                    insertQuery = "insert into tbllamadas (nodo, NodoPeerText, NodoPeerIP, inicio, fecha, estado, direccion, velocidad) values (%d, '%s', '%s', NOW(), CURDATE(), %d, '%s', '%s');" % (self.id,nodoPeerText,nodoPeerIP,estado,callDirection,TransferRate)
                                    self.debug("Enviando query = %s a BD" %insertQuery)
                                    query.Query(insertQuery)
                                    self.debug("Fila insertada en %d" %query.lastInsertID)
                                except MySQLdb.Error, e:
                                    self.lerror("Error insertando datos de llamada en tbllamadas : %d %s" % (e.args[0], e.args[1]))
                            else:
                                self.warning("Error procesando self.getTransferRate %s - %s" % (self.error,self.errorCode))
                        else:
                            self.warning("Error procesando self.getCallDirection %s - %s" %(self.error,self.errorCode))
                    else:
                        self.warning("Error procesando self.getPeerIP %s - %s" %(self.error,self.errorCode))
                else:
                    self.warning("Error procesando self.getPeer %s - %s" %(self.error,self.errorCode))
            else:
                self.debug("Actualizando datos de llamada en tbllamadas, Nodo=%d estado=%d" % (self.id, estado))
                try:
                    updateQuery = "update tbllamadas set estado=0, termino=now() where nodo=%d and estado=1" % (self.id)
                    self.debug("Enviando query %s a BD" % updateQuery)
                    query.Query(updateQuery)
                    self.debug("Query modifico %d filas" %query.affectedRows)
                except MySQLdb.Error, e:
                    self.lerror("Error actualizando datos de la llamada %d: $s" % (e.args[0], e.args[1]))
        else:
             self.lerror("Unknown node type in generate call event")
####CISCO PROCESSING FUNCTIONS

    def CISCOgetValue(self,nodo,pos):
        #getValue
        return nodo.childNodes[pos].childNodes[0].nodeValue

    def CISCOgetStats(self,nodo):
        #getStats
        r = {}
        r['jitter']    = self.CISCOgetValue(nodo,1)
        r['packets']   = self.CISCOgetValue(nodo,3)
        r['lost']      = self.CISCOgetValue(nodo,5)
        r['bytes']     = self.CISCOgetValue(nodo,13)
        r['rate']      = self.CISCOgetValue(nodo,15)
        r['maxjitter'] = self.CISCOgetValue(nodo,17)
        return r
    
    def getURLResponse(self,codec=None,username=None,password=None,fullURL=None):
        if username!=None:
            self.debug("Generando HTTP digest para nodo CISCO %s" % codec)
            handler = urllib2.HTTPPasswordMgrWithDefaultRealm()
            handler.add_password(None, fullURL, username, password)     
            opener = urllib2.build_opener(urllib2.HTTPBasicAuthHandler(handler),urllib2.HTTPDigestAuthHandler(handler)) 
        self.debug("Polling de getURLResponse function con usuario %s a %s" % (username,fullURL))
        response = None
        error    = None
        req = urllib2.Request(fullURL)
        try:
            if username==None:
                response = urllib2.urlopen(req)
            else:
                response = opener.open(fullurl=fullURL)
        except urllib2.URLError, e:
            if hasattr(e, 'reason'):
                self.lerror("Error en getURLResponse function - reason %s" % e.reason)
                error = "%s" % e.reason
            elif hasattr(e, 'code'):
                self.lerror("Error en getURLResponse function - code %s" % e.code)
                error = "%s" % e.code
            response = None
        except Exception, e:
            self.lerror("Exception en getURLResponse - %s" % e)
            error = "%s" % e
        else:
            self.debug("OK answered from %s" % codec)
        return response,error

    def CISCOinsertMediciones(self):
        txJitter=0
        rxJitter=0
        
        last_ac_txPacks = self.ac_txPacks
        last_ac_txPlost = self.ac_txPlost
        last_ac_rxPacks = self.ac_rxPacks
        last_ac_rxPlost = self.ac_rxPlost
        self.debug("last values txt:%s txl:%s rxt:%s rxl:%s" % (last_ac_txPacks,last_ac_txPlost,last_ac_rxPacks,last_ac_rxPlost))
        perc_txPlost=0
        perc_rxPlost=0
        #//
        
        # MOD 20120718
        self.ac_txPacks = 0.0
        self.ac_txPlost = 0.0
        self.ac_rxPacks = 0.0
        self.ac_rxPlost = 0.0
        # END MOD
        
        query = None
        try:
            query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando tbmedidas n BD: %d %s" % (e.args[0], e.args[1]))
            return

        fullURL = "http://"+self.ipAddress +"/getxml?location=Status/Diagnostics/Call"
        response,error = self.getURLResponse(self.ipAddress,self.username,self.password,fullURL)
        self.debug("Recibido stats response =%s error=%s" % (response,error))
        if response == None:
            self.lerror("ERROR getting stats - please check log file")
        
        status=True
        try:
            doc2 = xml.dom.minidom.parse(response)
            diagnostics = doc2.childNodes[0].childNodes[1]
            call = diagnostics.childNodes[1]
            channels = call.childNodes[1]
            stats={}
            for node in channels.childNodes:
                if node.nodeType==1:
                    node_name = node.nodeName
                    node_id = node.attributes.get("item").value
                    node_stats = self.CISCOgetStats(node.childNodes[1])
                    node_stats['id'] = node_id
                    node_stats['type'] = node_name
                    stats[node_id] = node_stats
        except:
            status=False
        
        if status:
            for channel,channel_stats in stats.items():
                for name,value in channel_stats.items():
                    if channel_stats['type']=="OutgoingVideoChannel":
                        if name=="packets":
                            #MOD 20120718
                            self.ac_txPacks = self.ac_txPacks + long(value)
                            #self.ac_txPacks = long(value)
                        if name=="lost":
                            self.ac_txPlost = self.ac_txPlost + long(value)
                            # self.ac_txPlost = long(value)
                        if name=="jitter":
                            txJitter = long(value)
                    if channel_stats['type']=="IncomingVideoChannel":
                        if value!="0":
                            if name=="packets":
                                self.ac_rxPacks = self.ac_rxPacks + long(value)
                                # self.ac_rxPacks = long(value)
                            if name=="lost":
                                self.ac_rxPlost = self.ac_rxPlost + long(value)
                                # self.ac_rxPlost = long(value)
                            if name=="jitter":
                                rxJitter = long(value)
            self.error = 0
        else:
            self.lerror("ERROR parsing stats - please check log file")
            self.error = 1
            return
        self.debug("current values txt:%s txl:%s rxt:%s rxl:%s" % (self.ac_txPacks , self.ac_txPlost , self.ac_rxPacks , self.ac_rxPlost))
        delta_txPlost = self.ac_txPlost - last_ac_txPlost
        delta_txPacks = self.ac_txPacks - last_ac_txPacks
        if delta_txPacks>0:
            perc_txPlost = 100.0*delta_txPlost / delta_txPacks
        else:
            perc_txPlost=0
        
        if delta_txPacks < 0:
            self.debug("delta_txPacks es menor que 0 %s" %delta_txPacks)
            self.error=0
            return
            
            
        delta_rxPlost = self.ac_rxPlost - last_ac_rxPlost
        delta_rxPacks = self.ac_rxPacks - last_ac_rxPacks
        if delta_rxPacks>0:
            perc_rxPlost = 100.0*delta_rxPlost / delta_rxPacks
        else:
            perc_rxPlost=0

        if delta_rxPacks < 0:
            self.debug("delta_rxPacks es menor que 0 %s" %delta_rxPacks)
            self.error=0
            return
        
        ###################
        tipo = 1 #RX packet loss
        valor = perc_rxPlost
        if self.error == 0:
            self.debug("Insertando medicion RX packet loss, tipo=%d valor=%s" % (tipo,valor))
            try:
                insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
                self.debug("Agregando fila %s a BD" %insertQuery)
                query.Query(insertQuery)
                self.debug("Fila insertada en %d" %query.lastInsertID)
            except MySQLdb.Error, e:
                self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        else:
            self.warning("Error procesando RX Packet loss %s - %s" %(self.error,self.errorCode))

        tipo = 2 #RX jitter
        valor = rxJitter
        if self.error == 0:
            self.debug("Insertando medicion RX video jitter, tipo=%d valor=%s" % (tipo,valor))
            try:
                insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
                self.debug("Agregando fila %s a BD" %insertQuery)
                query.Query(insertQuery)
                self.debug("Fila insertada en %d" %query.lastInsertID)
            except MySQLdb.Error, e:
                self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        else:
            self.warning("Error procesando RX Video jitter %s - %s" %(self.error,self.errorCode))
         
        tipo = 6 #TX packet loss
        valor = perc_txPlost
        if self.error == 0:
            self.debug("Insertando medicion TX packet loss, tipo=%d valor=%s" % (tipo,valor))
            try:
                insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
                self.debug("Agregando fila %s a BD" %insertQuery)
                query.Query(insertQuery)
                self.debug("Fila insertada en %d" %query.lastInsertID)
            except MySQLdb.Error, e:
                self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        else:
            self.warning("Error procesando TX Packet loss %s - %s" %(self.error,self.errorCode))
            
        tipo = 7 #TX jitter
        valor = txJitter
        if self.error == 0:
            self.debug("Insertando medicion TX video jitter, tipo=%d valor=%s" % (tipo,valor))
            try:
                insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
                self.debug("Agregando fila %s a BD" %insertQuery)
                query.Query(insertQuery)
                self.debug("Fila insertada en %d" %query.lastInsertID)
            except MySQLdb.Error, e:
                self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        else:
            self.warning("Error procesando TX Video jitter %s - %s" %(self.error,self.errorCode))

        #Insercion de datos en tbllamadas
        plrx = perc_rxPlost
        self.debug("capturado plrx = %s" % plrx)
        pltx = perc_txPlost
        self.debug("Se insertaran mediciones en tbllamadas RX Packet Loss=%s y TX Packet Loss=%s para el nodo CISCO = %s" % (plrx,pltx,self.id))
        try:
            updateQuery = "update tbllamadas set nplTX = nplTX + 1, nplRX = nplRX + 1, totalplTX = (npltx * totalpltx + %s) / (npltx+1), totalplRX = (nplrx * totalplrx + %s) / (nplrx + 1), rtplTX = (0.9 * rtpltx) + (0.1 * %s), rtplRX = (0.9 * rtplrx) + (0.1 * %s) where nodo=%s and estado = 1" % (pltx,plrx,pltx,plrx,self.id)
            self.debug("Enviando consulta %s a BD" % updateQuery)
            query.Query(updateQuery)
            self.debug("Query modifico %d filas" % query.affectedRows)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))
    
####HTTP ERRORS FUNCTIONS 
        
    def HTTPerror401(self):
        self.debug("Se ha encontrado nodo con error HTTP 401.")
        try:
            self.debug("Verificando estado de alerta para este Nodo.")
            query = PySQLPool.getNewQuery(self.connection)
            query.Query("SELECT COUNT(*) AS contador FROM dbqoe.tbbitacora WHERE tipo = 4 AND ack = 0 AND nodo = %s" % (self.id))
            for row in query.record:
                contador = int(row['contador'])
                if contador == 0:
                    insertQuery = "INSERT INTO dbqoe.tbbitacora (fecha, tipo, text, username, ack, nodo) VALUES (NOW(), 4, 'Nodo %s detectado con error HTTP 401 - Authentication error (user, pass or realm)', 'System', 0, %s)" % (self.id, self.id)
                    self.debug("Se agregara registro aplicando - %s a BD" %insertQuery)
                    query.Query(insertQuery)
                    self.debug("Fila insertada en tbbitacora ID %d" %query.lastInsertID)
                else:
                    self.debug("Ya existe alerta creada para este Nodo.")
        except MySQLdb.Error, e:
            self.lerror("Error procesando HTTPerror401 nodo %d: %s" % (e.args[0], e.args[1]))

    def HTTPerror404(self):
        self.debug("Se ha encontrado nodo con error HTTP 404.")
        try:
            self.debug("Verificando estado de alerta para este Nodo.")
            query = PySQLPool.getNewQuery(self.connection)
            query.Query("SELECT COUNT(*) AS contador FROM dbqoe.tbbitacora WHERE tipo = 5 AND ack = 0 AND nodo = %s" % (self.id))
            for row in query.record:
                contador = int(row['contador'])
                if contador == 0:
                    insertQuery = "INSERT INTO dbqoe.tbbitacora (fecha, tipo, text, username, ack, nodo) VALUES (NOW(), 5, 'Nodo %s detectado con error HTTP 404 - Version de FW no soportado o modelo incorrecto.', 'System', 0, %s)" % (self.id, self.id)
                    self.debug("Se agregara registro aplicando - %s a BD" %insertQuery)
                    query.Query(insertQuery)
                    self.debug("Fila insertada en tbbitacora ID %d" %query.lastInsertID)
                else:
                    self.debug("Ya existe alerta creada para este Nodo.")
        except MySQLdb.Error, e:
            self.lerror("Error procesando HTTPerror404 nodo %d: %s" % (e.args[0], e.args[1]))

    def HTTPerror500(self):
        self.debug("Se ha encontrado nodo con error HTTP 500.")
        try:
            self.debug("Verificando estado de alerta para este Nodo.")
            query = PySQLPool.getNewQuery(self.connection)
            query.Query("SELECT COUNT(*) AS contador FROM dbqoe.tbbitacora WHERE tipo = 6 AND ack = 0 AND nodo = %s" % (self.id))
            for row in query.record:
                contador = int(row['contador'])
                if contador == 0:
                    insertQuery = "INSERT INTO dbqoe.tbbitacora (fecha, tipo, text, username, ack, nodo) VALUES (NOW(), 6, 'Nodo %s detectado con error HTTP 500 - Equipo booteando.', 'System', 0, %s)" % (self.id, self.id)
                    self.debug("Se agregara registro aplicando - %s a BD" %insertQuery)
                    query.Query(insertQuery)
                    self.debug("Fila insertada en tbbitacora ID %d" %query.lastInsertID)
                else:
                    self.debug("Ya existe alerta creada para este Nodo.")
        except MySQLdb.Error, e:
            self.lerror("Error procesando error HTTP nodo %d: %s" % (e.args[0], e.args[1]))

    def HTTPerror502(self):
        self.debug("Se ha encontrado nodo con error HTTP 502.")
        try:
            self.debug("Nodo %s CISCO esta iniciando y preparando XML" %self.id)
        except MySQLdb.Error, e:
            self.lerror("Error procesando error HTTP nodo %d: %s" % (e.args[0], e.args[1]))

    def HTTPtimedOut(self):
        self.debug("Se ha detectado nodo con HTTP timed out.")
        try:
            self.debug("Verificando estado de alerta para este Nodo.")
            query = PySQLPool.getNewQuery(self.connection)
            query.Query("SELECT COUNT(*) AS contador FROM dbqoe.tbnodosabajo WHERE nodo = %s AND estado = 0" % (self.id))
            for row in query.record:
                contador = int(row['contador'])
                if contador == 0:
                    #No hay alertas activas, por lo tanto, se inserta una nueva.
                    # Insert en tbNodosAbajo
                    insertQuery = "INSERT INTO dbqoe.tbnodosabajo (nodo, estado, fechaInicio) VALUES (%s, 0, NOW())" % (self.id)
                    self.debug("Se agregara registro de Nodo Abajo usando - %s - a BD" % insertQuery)
                    query.Query(insertQuery)
                    self.debug("Fila insertada en tbNodosAbajo ID %d" %query.lastInsertID)
                    # Insert en tbBitacora
                    # insertQuery = "INSERT INTO dbqoe.tbbitacora (fecha, tipo, text, username, ack, nodo) VALUES (NOW(), 8, 'Nodo %s detectado DOWN.', 'System', 0, %s)" % (self.id, self.id)
                    # self.debug("Se agregara registro aplicando - %s a BD" %insertQuery)
                    # query.Query(insertQuery)
                    # self.debug("Fila insertada en tbBitacora ID %d" %query.lastInsertID)
                else:
                    #Existe una alerta activa.
                    self.debug("Ya existe alerta creada para este Nodo.")
        except MySQLdb.Error, e:
            self.lerror("Error procesando error HTTP nodo %d: %s" % (e.args[0], e.args[1]))

    def HTTPnodeAlive(self):
        self.debug("Se ha detectado cambio de estado isAlive en nodo.")
        try:
            self.debug("Verificando estado de alerta para este Nodo")
            query = PySQLPool.getNewQuery(self.connection)
            query.Query("SELECT COUNT(*) AS contador FROM dbqoe.tbnodosabajo WHERE nodo = %s AND estado = 0" % (self.id))
            for row in query.record:
                contador = int(row['contador'])
                if contador == 0:
                    #No hay alertas activas, Hay un error
                    self.warning("Existe un error en tbNodosAbajo, no se encuentra registro para el Nodo")
                else:
                    if contador == 1:
                        #Hacer Update en tbNodosAbajo
                        self.debug("Se procede con el cambio de estado en el registro de tbNodosAbajo")
                        query.Query("SELECT * FROM dbqoe.tbnodosabajo WHERE nodo = %s AND estado = 0" % (self.id))
                        for row in query.record:
                            idtmp = int(row['idtbnodosabajo'])
                        updateQuery = "update dbqoe.tbnodosabajo set estado = 1, fechaTermino = NOW() where idtbnodosabajo=%d" % (idtmp)
                        self.debug("Enviando consulta %s a BD" %updateQuery)
                        query.Query(updateQuery)
                        self.debug("Query modifico %d filas en tbNodosAbajo" %query.affectedRows)
                    else:
                        #Hay mas de una alerta activa, Hay un error
                        self.warning("Existen mas de un registro activo para este nodo en tbNodosAbajo")
        except MySQLdb.Error, e:
            self.lerror("Error procesando HTTPnodeAlive")         

####LOG FUNCTIONS

    def debug(self,msg):
        self.myQoEManager.debug("(Nodo %s @ %s) %s" % (self.id,self.ipAddress,msg))        

    def warning(self,msg):
        self.myQoEManager.warning("(Nodo %s @ %s) %s" % (self.id,self.ipAddress,msg))        

    def lerror(self,msg):
        self.myQoEManager.error("(Nodo %s @ %s) %s" % (self.id,self.ipAddress,msg))

    def huawei_loop(self):
        self.debug("Starting API connection to HUAWEI codec %s " % self.id)
        self.acSessionId = None
        callstate = ""
        callstate_old = "offline"
        cont = 0
        mailbox_error=0
        session=False
        certificate=False
        
        r=None
        status_code=None
        j_resp=None
        success = None
        data = None
        payload = None
        headers = None
        m_data = None
        
        while self.running :
            if not session:
                try:
                    self.debug("Requesting Session ID for %s"%self.id)
                    r = requests.post("http://%s/action.cgi?ActionID=WEB_RequestSessionIDAPI"%self.ipAddress,timeout=self.timeout)
                    status_code = r.status_code
                    j_resp = r.json()
                    self.lerror("%s->%s"%(status_code,j_resp))
                    success = j_resp['success']
                    data = json.loads(j_resp['data'])
                    self.acSessionId = data['acSessionId']
                    self.debug("Got SessioId:%s sucessfully for %s" %(self.acSessionId,self.id))
                    session=True
                    certificate=False
                except Exception,e:
                    session=False
                    self.lerror("Couldnt get SessionId for %s" % self.id)
                    self.lerror("Exception %s" % e)
                    if callstate_old != "offline":
                        self.debug("Node %s callstate:offline" % (self.id))
                        callstate_old = "offline"
                        self.debug("Transicion de isAlive para nodo desde %d a False" %(self.isAlive))
                        self.isAlive = False
                        self.warning("Nodo abajo")
                        self.updateNodeIsAlive(False)
                    time.sleep(self.timeout)
            elif not certificate:
                try:    
                    self.debug("Requesting Certificate for %s"%self.id)
                    payload = {"user":self.username,"password":self.password}
                    headers = {'content-type': 'application/json','sessionid':self.acSessionId}
                    r = requests.post("http://%s/action.cgi?ActionID=WEB_RequestCertificate"%self.ipAddress,data=json.dumps(payload),headers=headers,timeout=self.timeout)
                    status_code = r.status_code
                    j_resp = r.json()
                    success = j_resp['success']
                    if status_code==200:
                        if success:
                            self.debug("Got certificate sucessfully for %s"%self.id)
                            certificate=True
                    if certificate==False:
                        self.lerror("Couldnt get certificate for %s" % self.id)
                        self.lerror("Response %s" % j_resp)
                        session=False
                        if callstate_old != "offline":
                            self.debug("Node %s callstate:offline" % (self.id))
                            callstate_old = "offline"
                            self.debug("Transicion de isAlive para nodo desde %d a False" %(self.isAlive))
                            self.isAlive = False
                            self.warning("Nodo abajo")
                            self.updateNodeIsAlive(False)
                        time.sleep(self.timeout)
                except Exception,e:
                    certificate=False
                    session=False
                    self.lerror("Couldnt get certificate for %s" % self.id)
                    self.lerror("Exception %s" % e)
                    if callstate_old != "offline":
                        self.debug("Node %s callstate:offline" % (self.id))
                        callstate_old = "offline"
                        self.debug("Transicion de isAlive para nodo desde %d a False" %(self.isAlive))
                        self.isAlive = False
                        self.warning("Nodo abajo")
                        self.updateNodeIsAlive(False)
                    time.sleep(self.timeout)
            else:
                mailbox = False
                
                try:
                    self.debug("Haciendo polling a nodo %s en %s" % (self.id,self.ipAddress))
                    headers = {'content-type': 'application/json','sessionid':self.acSessionId}
                    r = requests.post("http://%s/action.cgi?ActionID=WEB_GetMailboxDataAPI"%self.ipAddress,headers=headers,timeout=self.timeout)
                    status_code = r.status_code
                    j_resp = r.json()
                    success = j_resp['success']
                    if status_code==200:
                        if success:
                            mailbox=True
                    m_data = json.loads(j_resp['data'])
                    callstate = m_data['state']['callstate']
                    callstate = "%s" % callstate
                    self.debug("callstate=%s callstate_old=%s" % (callstate,callstate_old))
                    cont = cont +1
                    if cont>999:
                        cont=0
                    if callstate != callstate_old:
                        self.debug("callstate:%s (%s)" % (callstate,cont))
                        if callstate_old == "offline":
                            self.debug("Transicion de isAlive para nodo desde %d a True" %(self.isAlive))
                            self.isAlive = True
                            self.updateNodeIsAlive(True)
                        callstate_old = callstate
                        newInCall = False
                        if callstate=="0":
                            # self.saveStatus("idle")
                            newInCall = False
                        elif callstate=="1":
                            # self.saveStatus("dialing")
                            newInCall = False
                        elif callstate=="2":
                            # self.saveStatus("busy")
                            newInCall = True
                        if self.inCall != newInCall:
                            self.debug("Transicion de inCall para nodo desde %d a %d" %(self.inCall,newInCall))  
                            self.updateNodeInCall(newInCall)
                            self.generateCallEvent(newInCall)
                            self.ac_txPacks=0
                            self.ac_txPlost=0
                            self.ac_rxPacks=0
                            self.ac_rxPlost=0
                            self.inCall = newInCall
                        if self.inCall:
                            self.huaweiPollAndInsertMediciones()
                except Exception,e:
                    mailbox=False
                    self.lerror("Couldnt get mailboxdata for %s" % self.id)
                    self.lerror("Exception %s" % e)
                    if callstate_old != "offline":
                        self.debug("Node %s callstate:offline" % (self.id))
                        callstate_old = "offline"
                        self.debug("Transicion de isAlive para nodo desde %d a False" %(self.isAlive))
                        self.isAlive = False
                        self.warning("Nodo abajo")
                        self.updateNodeIsAlive(False)
                    time.sleep(self.timeout)
                if not mailbox:
                    mailbox_error = mailbox_error +1
                    if mailbox_error >3:
                        session=False
                        certificate=False
                        mailbox_error=0
                time.sleep(config.incall_polling_time)
        self.warning("Finishing loop for %s" % self.codec)
        
        
    def huaweiGetConfParamsInfoAPI(self):
        self.debug("Sending WEB_GetConfParamsInfoAPI")
        payload={"siteHandle":255}
        headers = {'content-type': 'application/json','sessionid':self.acSessionId}
        nodoPeerText = ""
        nodoPeerIP =""
        callDirection =""
        TransferRate = ""
        my_error=1
        try:
            r = requests.post("http://%s/action.cgi?ActionID=WEB_GetConfParamsInfoAPI"%self.ipAddress,data=json.dumps(payload),headers=headers)
            status_code = r.status_code
            j_resp = r.json()
            success = j_resp['success']
            self.debug("status_code = %s" % status_code)
            self.debug("success = %s " % success)
            self.debug(j_resp)
            c_data = json.loads(j_resp['data'])
            nodoPeerText=c_data["remoteNumber"]
            nodoPeerIP =""
            callDirection =""
            TransferRate = c_data["confSpeedSend"]
            my_error=0
        except Exception,e:
            self.warning("Error in huaweiGetConfParamsInfoAPI %s" %e)
            my_error=1
        return nodoPeerText,nodoPeerIP,callDirection,TransferRate,my_error
    
    def huaweiPollAndInsertMediciones(self):
        self.debug("Sending WEB_GetCallStatusInfoAPI")
        payload={"siteHandle":255}
        headers = {'content-type': 'application/json','sessionid':self.acSessionId}
        r = requests.post("http://%s/action.cgi?ActionID=WEB_GetCallStatusInfoAPI"%self.ipAddress,data=json.dumps(payload),headers=headers)
        status_code = r.status_code
        j_resp = r.json()
        success = j_resp['success']
        self.debug("status_code = %s" % status_code)
        self.debug("success = %s " % success)
        self.debug(j_resp)
        try:
            c_data = json.loads(j_resp['data'])
            videoLossPerSend = c_data['videoLossPerSend']
            videoLossPerRev = c_data['videoLossPerRev']
            videoLossPerSend = float(videoLossPerSend.replace("%",""))
            videoLossPerRev = float(videoLossPerRev.replace("%",""))
        except Exception, e:
            self.warning("Exception in WEB_GetCallStatusInfoAPI %s" % e)
            return
        self.debug("videoLossPerSend: %s %%" % videoLossPerSend)
        self.debug("videoLossPerRev: %s %%" % videoLossPerRev)
        query = None
        try:
            query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando tbmedidas n BD: %d %s" % (e.args[0], e.args[1]))
            return
        tipo = 1 #RX packet loss
        valor = videoLossPerRev
        self.debug("Insertando medicion RX packet loss, tipo=%d valor=%s" % (tipo,valor))
        try:
            insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
            self.debug("Agregando fila %s a BD" %insertQuery)
            query.Query(insertQuery)
            self.debug("Fila insertada en %d" %query.lastInsertID)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        tipo = 6 #TX packet loss
        valor = videoLossPerSend
        self.debug("Insertando medicion TX packet loss, tipo=%d valor=%s" % (tipo,valor))
        try:
            insertQuery = "insert into tbmedidas (tiempo,fecha,node,llamada,tipo,valor) values (now(),CURDATE(),%d,null,%d,%s);" % (self.id,tipo,valor) 
            self.debug("Agregando fila %s a BD" %insertQuery)
            query.Query(insertQuery)
            self.debug("Fila insertada en %d" %query.lastInsertID)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando nodo BD: %d %s" % (e.args[0], e.args[1]))
        #Insercion de datos en tbllamadas
        plrx = videoLossPerRev
        self.debug("capturado plrx = %s" % plrx)
        pltx = videoLossPerSend
        self.debug("capturado pltx = %s" % pltx)
        self.debug("Se insertaran mediciones en tbllamadas RX Packet Loss=%s y TX Packet Loss=%s para el nodo HUAWEI = %s" % (plrx,pltx,self.id))
        try:
            updateQuery = "update tbllamadas set nplTX = nplTX + 1, nplRX = nplRX + 1, totalplTX = (npltx * totalpltx + %s) / (npltx+1), totalplRX = (nplrx * totalplrx + %s) / (nplrx + 1), rtplTX = (0.9 * rtpltx) + (0.1 * %s), rtplRX = (0.9 * rtplrx) + (0.1 * %s) where nodo=%s and estado = 1" % (pltx,plrx,pltx,plrx,self.id)
            self.debug("Enviando consulta %s a BD" % updateQuery)
            query.Query(updateQuery)
            self.debug("Query modifico %d filas" % query.affectedRows)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))