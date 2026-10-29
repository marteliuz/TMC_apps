import datetime

import cherrypy

import QoEManager
import NodeManager
import Node

class WebServer(object):

    myQoEManager = None
    def __init__(self,qoeManager):
        self. myQoEManager = qoeManager
    
    def index(self, codec=None, *args, **kw):
        self.debug("Received for %s from %s" % (codec,cherrypy.request.remote.ip))
        return "Hello %s" % codec
    index.exposed = True
    
    def changeNodeIPAddress(self,id=None,ip=None):
        self.debug("changeNodeIPAddress %s from %s" % (id,cherrypy.request.remote.ip))
        if not id:
            return "id?"
        if not ip:
            return "ip?"
        try:
            self.myQoEManager.myNodeManager.changeIPAddress_node(int(id),"%s"%ip)
            return "OK"
        except Exception, e:
            return "Exception %s" % e
    changeNodeIPAddress.exposed=True
    
    def changeNodePassword(self,id=None,password=None):
        self.debug("changeNodePassword %s from %s" % (id,cherrypy.request.remote.ip))
        if not id:
            return "id?"
        if not password:
            return "password?"
        try:
            self.myQoEManager.myNodeManager.changePassword_node(int(id),"%s"%password)
            return "OK"
        except Exception, e:
            return "Exception %s" % e
    changeNodePassword.exposed=True
    
    def getNodeList(self):
        self.debug("getNodeList from %s" % (cherrypy.request.remote.ip))
        output = "<html><body><table><tr><th>ID</th><th>IP Address</th><th>Monitor?</th><th>Tipo</th></tr>"
        nodos = self.myQoEManager.myNodeManager.nodos
        for k in nodos.keys():
            output = output + "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>" % (nodos[k].id, nodos[k].ipAddress,nodos[k].monitor,nodos[k].tipo)
        return output + "</table></body></html>"
    getNodeList.exposed=True
    
    def getNodes(self):
        self.debug("getNodes from %s" % (cherrypy.request.remote.ip))
        return "%s" % self.myQoEManager.myNodeManager.getNumberOfNodes()
    getNodes.exposed = True
    
    def getThreads(self):
        self.debug("getThreads from %s" % (cherrypy.request.remote.ip))
        return "%s" % self.myQoEManager.getThreads()
    getThreads.exposed = True
    
    def getNode(self,id=None):
        self.debug("getNode %s from %s" % (id,cherrypy.request.remote.ip))
        if not id:
            return "id?"
        try:
            nodo = self.myQoEManager.myNodeManager.nodos[int(id)]
            output = '''
                node.id             = %s
                node.ipAddress      = %s
                node.ipAddressAlias = %s
                node.monitor        = %s
                node.tipo           = %s
                node.username       = %s
                node.password       = %s
                node.inCall         = %s
                node.isAlive        = %s
                node.running        = %s
            ''' % (nodo.id,nodo.ipAddress,nodo.ipAddressAlias,nodo.monitor,nodo.tipo,nodo.username,nodo.password,nodo.inCall,nodo.isAlive,nodo.running)
            return output
        except Exception, e:
            return "Exception %s" % e
    getNode.exposed=True
    
    def reloadNode(self,id=None):
        self.debug("getNode %s from %s" % (id,cherrypy.request.remote.ip))
        if not id:
            return "id?"
        try:
            self.myQoEManager.myNodeManager.reload_node(int(id))
            return "OK"
        except Exception, e:
            return "Exception %s" % e
    reloadNode.exposed=True
    
    def endCall(self, id=None, date=None):
        if not id:
            return "id?"
        
        if not date:
            date = datetime.datetime.now()
        else:
            try:
                date = datetime.datetime.strptime(date, "%d-%m-%Y %H:%M:%S")
            except ValueError:
                try:
                    date = datetime.datetime.strptime(date, "%d-%m-%Y %H:%M")
                except:
                    return "Datetime format must be one of these: 'dd-mm-aa hh:mm:ss' or 'dd-mm-aa hh:mm'"
        try:
            self.myQoEManager.myNodeManager.end_call(int(id), date)
            return "OK"
        except Exception, e:
            return "Exception %s" % e
    endCall.exposed=True
    
    def debug(self,msg):
        self.myQoEManager.debug("(WebServer) %s" % msg)
    def warning(self,msg):
        self.myQoEManager.warning("(WebServer) %s" % msg)
    def error(self,msg):
        self.myQoEManager.error("(WebServer) %s" % msg)