'''
Created on 30-06-2011
@author: jfroco
'''

import ECManager
import WebServer
import cherrypy
import os

if __name__ == '__main__':
    miECManager = ECManager.ECManager()
    miWebServer =  WebServer.WebServer()
    miECManager.myWebServer = miWebServer
    miECManager.start()

    current_dir = os.path.dirname(os.path.abspath(__file__))
    # Set up site-wide config first so we get a log if errors occur.
    cherrypy.config.update({'environment': 'production',
                            'log.error_file': 'site.log',
                            'log.screen': True})
        
    conf = {'/data': {'tools.staticdir.on': True,
                      'tools.staticdir.dir': os.path.join(current_dir, 'data'),
                      'tools.staticdir.content_types': {'js': 'text/javascript',
                                                        'css': 'text/css'}}}
    cherrypy.server.socket_host = "10.0.0.5"
    cherrypy.server.socket_port = 7676
    #cherrypy.server.socket_host = "10.0.1.110"
    cherrypy.quickstart(miWebServer, '/', config=conf)