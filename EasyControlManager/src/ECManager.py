'''
Created on 30-06-2011

@author: jfroco
'''

import logging
import logging.handlers
import threading
import time
import os
import sys
import telnetlib
import string


class ECManager(threading.Thread):
    version = "0.01"
    log = "ecmanager.log"
    running = False   
    connection = None
    myWebServer = None
    myLogger = None
    
    #codec = "56.2.6.53"
    codec = "56.2.6.161"
    port = 24
    timeout = 5
    tn = None

    def run(self):

        self.running = True
        self.myLogger = logging.getLogger('ECManager')
        self.myLogger.setLevel(logging.DEBUG)
        handler = logging.handlers.TimedRotatingFileHandler(self.log , 'midnight', 1, backupCount=14)
        formatter = logging.Formatter("%(asctime)s %(levelname)s : %(module)s:%(lineno)d - %(message)s")
        handler.setFormatter(formatter)
        self.myLogger.addHandler(handler)
        
        self.warning("Starting Easy Control Manager")
        self.debug("Version: %s - OS: %s - %s" % (self.version,os.name,sys.version))
        
        self.debug("Starting API connection to codec %s " % self.codec)
        self.tn = telnetlib.Telnet()
        self.tn.open(self.codec,self.port,self.timeout)

        self.tn.write("\n")
        self.tn.write("callstate register\n")
        self.tn.write("callinfo all\n")
        
        while (self.running):
            texto = self.tn.read_until("\r\n",self.timeout)
            if len(texto)>0:
                self.debug("Message from %s: %s" % (self.codec,texto))
                if string.find(texto,"incoming: call")!=-1:
                    self.myWebServer.myStatus = "ringing"
                    self.debug("Status is now: %s" % self.myWebServer.myStatus)
                if string.find(texto,":ringing:")!=-1:
                    self.myWebServer.myStatus = "ringing"
                    self.debug("Status is now: %s" % self.myWebServer.myStatus)
                if string.find(texto,"ended: call")!=-1:
                    self.myWebServer.myStatus = "idle"
                    self.debug("Status is now: %s" % self.myWebServer.myStatus)
                if string.find(texto,"cleared: call")!=-1:
                    self.myWebServer.myStatus = "idle"
                    self.debug("Status is now: %s" % self.myWebServer.myStatus)
                if string.find(texto,"system is not in a call")!=-1:
                    self.myWebServer.myStatus = "idle"
                    self.debug("Status is now: %s" % self.myWebServer.myStatus)
                if string.find(texto,"active: call")!=-1:
                    self.myWebServer.myStatus = "busy"
                    self.debug("Status is now: %s" % self.myWebServer.myStatus)
                if string.find(texto,":connected:")!=-1:
                    self.myWebServer.myStatus = "busy"
                    self.debug("Status is now: %s" % self.myWebServer.myStatus)
                if string.find(texto,"[ALLOCATED]")!=-1:
                    self.myWebServer.myStatus = "dialing"
                    self.debug("Status is now: %s" % self.myWebServer.myStatus)
            else:
                self.heartbeat()
            
            
    def getThreads(self):
        return threading.activeCount()
    
    def error(self,msg):
        self.myLogger.error(msg)
        
    def debug(self,msg):
        self.myLogger.debug(msg)
        
    def warning(self,msg):
        self.myLogger.warning(msg)

    def heartbeat(self):
        self.debug("Heartbeat __**__ threads=%d -- %s" % (self.getThreads(),self.myWebServer.myStatus))
