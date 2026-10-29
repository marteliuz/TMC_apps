import threading
import time
import PySQLPool
import QoEManager
import socket
import random
import MySQLdb
import sys
import Node
import config
            
class NodeManager(threading.Thread):
    '''
    classdocs
    '''
    myQoEManager = None
    running=False
    nodos = {}
    connection = None

    def run(self):
        self.running=True
        if self.myQoEManager is None:
            #Esto no deberia ocurrir nunca
            print("MyQoeManager no esta definido")
            sys.exit (1)
        self.debug("Comenzado NodeManager")
        self.connection = self.myQoEManager.getConnection()
        self.loadNodes()
        while (self.running):
            self.heartbeat()
            time.sleep(10)
    
    def heartbeat(self):
        self.debug("Heartbeat de NodeManager. Nodos=%d" % (self.getNumberOfNodes()))
    
    def debug(self,msg):
        self.myQoEManager.debug("(NodeManager) %s" % msg)
    def warning(self,msg):
        self.myQoEManager.warning("(NodeManager) %s" % msg)
    def error(self,msg):
        self.myQoEManager.error("(NodeManager) %s" % msg)
    
    def getNumberOfNodes(self):
        return len(self.nodos)
    
    def changeIPAddress_node(self,id,ip):
        self.debug("Change IP address to %s for node %s" % (ip,id))
        try:
            query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
            updateQuery = 'update tbnodos set dirIP=INET_ATON("%s") where idtbNodo=%s' % (ip,id)
            self.debug("Enviando query %s a BD" % updateQuery)
            query.Query(updateQuery)
            self.debug("Query modifico %d filas" %query.affectedRows)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando datos de nodo %d: $s" % (e.args[0], e.args[1]))
    
    def changePassword_node(self,id,password):
        self.debug("Change password to %s for node %s" % (password,id))
        try:
            query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
            updateQuery = 'update tbnodos set password="%s" where idtbNodo=%s' % (password,id)
            self.debug("Enviando query %s a BD" % updateQuery)
            query.Query(updateQuery)
            self.debug("Query modifico %d filas" %query.affectedRows)
        except MySQLdb.Error, e:
            self.lerror("Error actualizando datos de nodo %d: $s" % (e.args[0], e.args[1]))
    
    
    def reload_node(self,id):
        self.debug("Reloading node %s" % id)
        # Checa si nodo existe
        temp = self.nodos.get(id,None)
        if temp is None:
            self.nodos[id] = None
            self.debug("reload_node with new id %s" % id)
        else:
            self.nodos[id].running=False
        self.warning("Consulta: select idtbNodo,INET_NTOA(dirIP) as dirIP0,INET_NTOA(dirIPAlias) as dirIP1,descripcion,tipo,username,password from tbnodos where idtbNodo=%s" % id)
        try:
            query = PySQLPool.getNewQuery(self.connection)
            query.Query("select idtbNodo,INET_NTOA(dirIP) as dirIP0,INET_NTOA(dirIPAlias) as dirIP1,descripcion,monitor,tipo,username,password,inCall from tbnodos where idtbNodo=%s" % id)
            self.debug("Query retorno %d resultados" % query.rowcount)
            for row in query.record:
                id= int(row['idtbNodo'])
                dirIP=row['dirIP0']
                dirIPAlias = row['dirIP1']
                descripcion=row['descripcion']
                monitor=row['monitor']
                tipo=row['tipo']
                username=row['username']
                password=row['password']
                inCall = row['inCall']
                self.debug("Columna: id=%s dirIP=%s dirIPAlias=%s descripcion=%s tipo=%d username=%s password=%s monitor=%s inCall=%s" % (id,dirIP,dirIPAlias,descripcion,tipo,username,password,monitor,inCall))
                nodo = Node.Node()
                nodo.constructor(self.myQoEManager,id,dirIP,dirIPAlias,monitor,tipo,username,password,inCall)
                self.nodos[id] = nodo
                nodo.start()
        except MySQLdb.Error, e:
            self.error("Error cargando nodo %id %s" % (id,e))
        except KeyError, e:
            self.error("Error cargando nodo %id %s" % (id,e))
        except Exception, e: 
            self.error("Error cargando nodo %id %s" % (id,e))
            
    def loadNodes(self):
        self.warning("Cargando nodos")
        self.warning("Consulta: select idtbNodo,INET_NTOA(dirIP) as dirIP0,INET_NTOA(dirIPAlias) as dirIP1,descripcion,tipo,username,password from tbnodos")
        try:
            query = PySQLPool.getNewQuery(self.connection)
            query.Query("select idtbNodo,INET_NTOA(dirIP) as dirIP0,INET_NTOA(dirIPAlias) as dirIP1,descripcion,monitor,tipo,username,password,inCall from tbnodos")
            self.warning("Query retorno %d resultados" %query.rowcount)
            for row in query.record:
                id= int(row['idtbNodo'])
                dirIP=row['dirIP0']
                dirIPAlias = row['dirIP1']
                descripcion=row['descripcion']
                monitor=row['monitor']
                tipo=row['tipo']
                username=row['username']
                password=row['password']
                inCall = row['inCall']
                self.debug("Columna: id=%s dirIP=%s dirIPAlias=%s descripcion=%s tipo=%d username=%s password=%s monitor=%s inCall=%s" % (id,dirIP,dirIPAlias,descripcion,tipo,username,password,monitor,inCall))
                nodo = Node.Node()
                nodo.constructor(self.myQoEManager,id,dirIP,dirIPAlias,monitor,tipo,username,password,inCall)
                self.nodos[id] = nodo
                nodo.start()
            self.warning("Se cargaron %d nodos" % len(self.nodos))
        except MySQLdb.Error, e:
            self.error("Error cargando nodos %s" % e)
            sys.exit (1)
        except KeyError, e:
            self.error("Error cargando nodos %s" % e)
            sys.exit(1)
        except Exception, e:
            self.error("Error cargando nodos %s" % e)
            sys.exit(1)
            
            
     
    def end_call(self, call_id, end_date):
        self.warning("Finalizando llamada: %s" % call_id)
        self.warning("Consulta: select idTbllamadas,estado,nodo from tbllamadas where idTbllamadas=%s and estado=1")
        
        try:
            query = PySQLPool.getNewQuery(self.connection)
            query.Query("select idTbllamadas,estado,nodo from tbllamadas where idTbllamadas=%s" % call_id)
            self.debug("Query retorno %d resultados" % query.rowcount)
        except MySQLdb.Error, e:
            self.error("Error cargando llamada con id=%s %s" % (call_id, e))
            return
        
        node_id = None
        
        for row in query.record:
            node_id = row['nodo']
        
        if query.rowcount:
            try:
                updateCallQuery = "update tbllamadas set estado=0, termino='%s' where idTbllamadas=%s" % (end_date, call_id)
                self.warning("Consulta: %s" % updateCallQuery)
                self.debug("Enviando query %s a BD" % updateCallQuery)
                query.Query(updateCallQuery)
                self.debug("Query modifico %d filas" % query.affectedRows)
            except MySQLdb.Error, e:
                self.error("Error actualizando llamada con id=%s %s" % (call_id, e))
                return

            try:
                selectCallsQuery = "select idtbLlamadas,estado from tbllamadas where nodo=%s and estado=1" % node_id
                self.warning("Consulta: %s" % selectCallsQuery)
                query.Query(selectCallsQuery)
            except MySQLdb.Error, e:
                self.error("Error listando las llamadas que pertenencen al nodo con id=%s %s" % (node_id, e))
                return
            
            if not query.rowcount:
                try:
                    updateNodeQuery = "update tbnodos set inCall=0 where idTbNodo=%s" % node_id
                    self.warning("Consulta %s" % updateNodeQuery)
                    self.debug("Enviando query %s a BD" % updateNodeQuery)
                    query.Query(updateNodeQuery)
                except MySQLdb.Error, e:
                    self.error("Error actualizando el nodo con id=%s al estado inCall=0" % (node_id, e))
                    return
    
#    def procesaGet(self,nodoid,oid,valor):
#            
#            self.debug("Procesando GET para nodo %d oid = %s valor = %s" %(nodoid,oid,valor))
#
#            if (oid=="1.3.6.1.4.1.2684.1.1.21.0"):
#            
#                self.debug("Medicion es PolycomVSPacketLoss para nodo %d con valor %s" %(nodoid,valor))
#                try:
#                    tipo = 1 #packet loss
#                    query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
#                    insertQuery = "insert into tbmedidas (tiempo,node,llamada,tipo,valor) values (now(),%d,null,%d,%s);" % (nodoid,tipo,valor) 
#                    self.debug("Agregando fila %s a BD" %insertQuery)
#                    query.Query(insertQuery)
#                    self.debug("Fila insertada en %d" %query.lastInsertID)
#                except MySQLdb.Error, e:
#                    self.error("Error actualizando nodo %d en BD: %d %s" % (nodoid,e.args[0], e.args[1]))
#            
#            elif (oid=="1.3.6.1.4.1.2684.1.1.22.0"):
#            
#                self.debug("Medicion es PolycomVSJitter para nodo %d con valor %s" %(nodoid,valor))
#                try:
#                    tipo = 2 #jitter
#                    query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
#                    insertQuery = "insert into tbmedidas (tiempo,node,llamada,tipo,valor) values (now(),%d,null,%d,%s);" % (nodoid,tipo,valor) 
#                    self.debug("Agregando fila %s a BD" %insertQuery)
#                    query.Query(insertQuery)
#                    self.debug("Fila insertada en %d" %query.lastInsertID)
#                except MySQLdb.Error, e:
#                    self.error("Error actualizando nodo %d en BD: %d %s" % (nodoid,e.args[0], e.args[1]))
#            
#            elif (oid=="1.3.6.1.4.1.2684.1.1.23.0"):
#            
#                self.debug("Medicion es PolycomVSLatency para nodo %d con valor %s" %(nodoid,valor))
#                try:
#                    tipo = 3 #delay
#                    query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
#                    insertQuery = "insert into tbmedidas (tiempo,node,llamada,tipo,valor) values (now(),%d,null,%d,%s);" % (nodoid,tipo,valor) 
#                    self.debug("Agregando fila %s a BD" %insertQuery)
#                    query.Query(insertQuery)
#                    self.debug("Fila insertada en %d" %query.lastInsertID)
#                except MySQLdb.Error, e:
#                    self.error("Error actualizando nodo %d en BD: %d %s" % (nodoid,e.args[0], e.args[1]))
#
#            else:
#                self.warning("Recibido OID %s desconocido desde nodo %d" % (oid,nodoid))
#    
#    def procesaTrap(self,trap):
#        
#        self.debug("Procesando trap %s" %trap.prettyPrint())
#        
#        if trap.getSTrap()=="4":
#            self.debug("Procesando CallUp en trap %s" %trap.prettyPrint())
#            #Primero debemos encontrar cual es el nodo
#            #Se puede hacer de dos maneras
#            #1 buscando  en memoria
#            #2 buscando en la base de datos
#            #vamos a suponer que tenemos todo en memoria ;)
#            self.debug("Buscando nodo %s en memoria" % trap.getIPOrigen())
#            id=0
#            for key in self.nodos:
#                if self.nodos[key].ipAddress==trap.getIPOrigen():
#                    id=int(key)
#            if id==0:
#                self.warning("Mensaje %s de nodo desconocido" % trap.prettyPrint())
#            else:
#                #Actualizar tbNodos y agregar llamada en tbLlamadas
#                self.debug("Actualizando tbNodos InCall=1 para nodo %s en BD" %id)
#                try:
#                    query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
#                    updateQuery = "update tbnodos set inCall=1,lastTest=now() where idtbNodo=%d" %id
#                    self.debug("Enviando consulta %s a BD" %updateQuery)
#                    query.Query(updateQuery)
#                    self.debug("Query modifico %d filas" %query.affectedRows)
#                except MySQLdb.Error, e:
#                    self.error("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))  
#                
#                self.debug("Agregando evento CallUp en tbEventos para nodo %d"%id)
#                try:
#                    tipo = 1
#                    insertQuery = "insert into tbeventos (tipo,tiempo,node) values (%d,now(),%d)" % (tipo,id) 
#                    self.debug("Agregando fila %s a BD" %insertQuery)
#                    query.Query(insertQuery)
#                    self.debug("Fila insertada en %d" %query.lastInsertID)
#                except MySQLdb.Error, e:
#                    self.error("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))
#                self.debug("Generarando thread en nodo %s para SNMPPooler" %id )
#                self.nodos[id].startSNMPPooler()
#                
#        if trap.getSTrap()=="5":
#            self.debug("Procesando CallDown en trap %s" %trap.prettyPrint())
#            self.debug("Buscando nodo %s en memoria" % trap.getIPOrigen())
#            id=0
#            for key in self.nodos:
#                if self.nodos[key].ipAddress==trap.getIPOrigen():
#                    id=int(key)
#            if id==0:
#                self.warning("Mensaje %s de nodo desconocido" % trap.prettyPrint())
#            else:
#                #Actualizar tbNodos y agregar llamada en tbLlamadas
#                self.debug("Actualizando tbNodos InCall=0 para nodo %s en BD" % id )
#                try:
#                    query = PySQLPool.getNewQuery(self.connection,commitOnEnd=True)
#                    updateQuery = "update tbnodos set inCall=0,lastTest=now() where idtbNodo=%d" %id
#                    self.debug("Enviando consulta %s a BD" %updateQuery)
#                    query.Query(updateQuery)
#                    self.debug("Query modifico %d filas" %query.affectedRows)
#                except MySQLdb.Error, e:
#                    self.error("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))  
#                
#                self.debug("Agregando evento CallDown en tbEventos para nodo %d"%id)
#                try:
#                    tipo = 2
#                    insertQuery = "insert into tbeventos (tipo,tiempo,node) values (%d,now(),%d)" % (tipo,id) 
#                    self.debug("Agregando fila %s a BD" %insertQuery)
#                    query.Query(insertQuery)
#                    self.debug("Fila insertada en %d" %query.lastInsertID)
#                except MySQLdb.Error, e:
#                    self.error("Error actualizando nodo %d: %s" % (e.args[0], e.args[1]))
#                self.debug("Deteniendo thread en nodo %s para SNMPPooler" %id )
#                self.nodos[id].stopSNMPPooler()
#                    