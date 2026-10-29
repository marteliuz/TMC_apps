'''
Created on 06-04-2010

@author: MR
'''

import logging
import logging.handlers
import threading
import time
import os
import sys
import NodeManager
import MySQLdb
import PySQLPool
import config
import socket
import Pyro4
import select

class QoEManager(threading.Thread):
    '''
    Proceso principal
    Se encarga de crear log, abrir la conexion a base de datos
    e iniciar NodeManager
    '''
    version = "0.531h"
    log=config.log
    running = False   
    connection = None
    myNodeManager = None
    myLogger = None
    
    username= config.dbusername
    password=config.dbpassword
    host=config.dbhost
    db=config.db
    
         
    def run(self):

        self.running = True
        self.myLogger = logging.getLogger('QoEPlatform')
        self.myLogger.setLevel(logging.DEBUG)
        handler = logging.handlers.TimedRotatingFileHandler(self.log , 'midnight', 1, backupCount=7)
        formatter = logging.Formatter("%(asctime)s %(levelname)s : %(module)s:%(lineno)d - %(message)s")
        handler.setFormatter(formatter)
        self.myLogger.addHandler(handler)
        
        self.warning("Comenzando QoE Platform")
        self.debug("Version: %s - OS: %s - %s" % (self.version,os.name,sys.version))
        self.warning("Creando la conexion a la base de datos")
        self.debug("Conectandose a %s en %s usando %s" % (self.db,self.host,self.username))
        try:
            self.connection = PySQLPool.getNewConnection(username=self.username, password=self.password, host=self.host, db=self.db)
        except MySQLdb.Error, e:
            self.error("Error conectando a base de datos %d: %s" % (e.args[0], e.args[1]))
            sys.exit (1)
        self.debug("Conectado exitosamente a bd usando puerto %s" % self.connection.info['port'])
        
        socket.setdefaulttimeout(config.timeout)
        
        self.debug("Creando NodeManager")
        self.myNodeManager = NodeManager.NodeManager()
        self.myNodeManager.myQoEManager = self
        self.myNodeManager.start()
        self.debug("Creando exitosamente NodeManager")
#        
        while (self.running):
            self.heartbeat()
            time.sleep(10)
            # with Pyro4.Daemon(port=28117) as daemon:
                # uri = daemon.register(self,"QoE")
                # self.warning("starting daemon in %s" % uri)
                # while (self.running):
                    # s,_,_ = select.select(daemon.sockets,[],[],0.01)
                    # if s:
                        # self.warning("processing event in console");
                        # daemon.events(s)
    
    def getConnection(self):
        return self.connection
    
    def getThreads(self):
        return threading.activeCount()
    
    def getNumberOfNodes(self):
        return self.myNodeManager.getNumberOfNodes()
    
    def error(self,msg):
        self.myLogger.error(msg)
    def debug(self,msg):
        self.myLogger.debug(msg)
    def warning(self,msg):
        self.myLogger.warning(msg)

    def heartbeat(self):
        self.debug("Heartbeat __**__ threads=%d " % self.getThreads())
        
    