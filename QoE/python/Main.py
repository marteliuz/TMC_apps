'''
Created on 06-04-2010

@author: MR
'''
import QoEManager
import config
import WebServer
import cherrypy
import os

if __name__ == '__main__':
    
    miQoEManager = QoEManager.QoEManager()
    miQoEManager.start()
    # miQoEManager.join()
    miWebServer = WebServer.WebServer(miQoEManager)
    cherrypy.config.update({
        'log.access_file':"access.log",
        'log.error_file':"error.log",
        'log.screen':False,
        'server.socket_host':config.server_host,
        'server.socket_port':config.server_port
    })
    cherrypy.engine.autoreload.unsubscribe()
    cherrypy.quickstart(miWebServer)