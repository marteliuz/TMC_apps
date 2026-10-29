'''
Created on 30-06-2011
@author: jfroco
'''

import telnetlib
import string
import socket

class WebServer(object):
    
    version = "1.0001"
    #codec = "56.2.6.53"
    codec = "56.2.6.161"
    itach = "10.0.0.13"
    myStatus = "unknown"
    
    def index(self):
        return "Hello world!, this is a CherryPy WebServer"
    index.exposed = True

    def status(self,tiempo=None):
        return self.myStatus
    status.exposed = True   
    
    def main(self):

        cabecera_html = '''
        <!DOCTYPE html> 
        <html> 
            <head> 
                <meta charset="utf-8">
                <meta name="viewport" content="initial-scale=1.0,height=device-height,width=device-width">
                <title>Easy Control</title> 
                <link href="data/jquery.mobile-1.0b1.min.css" type="text/css" rel="stylesheet"/>
                <script type="text/javascript" src="data/jquery-1.6.1.min.js"></script>
                <script type="text/javascript" src="data/jquery.mobile-1.0b1.min.js"></script>
                <script language="javascript" src="data/EasyControl-v1.js"></script>
            </head> 
        '''
        
        cabecera_body = '''
        <body onload="setTimeout(scrollTo, 0, 0, 1)">  
        '''
        
        incMyDevices = '''
            <li data-role="list-divider"><h2>My devices:</h2></li>
            <li data-icon="gear"><a href="#camera2" data-rel="dialog">Camera</a></li>
            <li data-icon="gear"><a href="#monitor" data-rel="dialog">Video Monitor</a></li>
            <li data-icon="gear"><a href="#datashow" data-rel="dialog">Content Monitor</a></li>
            <li data-icon="gear"><a href="#codec" data-rel="dialog">VC Endpoint</a></li>
        '''
        
        pgHome = '''
        <div data-role="page" id="home" data-theme="b">
            <div data-role="header" data-position="fixed" data-icon="home">
                <h1><div id="status">Home</div></h1>
            </div><!-- /header -->

            <div data-role="content">    
                <ul data-role="listview" >
                    <li data-role="list-divider"><h2>My meetings ''' + self.version + ''':</h2></li>
                    <li><a href="#local"><img src="/data/images/Presentacion.jpg" /><h3>Local meeting</h3><p>Press to begin a local meeting</p></a></li>
                    <li><a href="#directory"><img src="/data/images/Directorio.jpg" /><h3>Call another site</h3><p>Press to access the corporate directory</p></a></li>
                    <li><a href="#home" rel="external" onclick="call('55209999');"><img src="/data/images/Meeting-Room.jpg" /><h3>My Meeting Room</h3><p>Press to access your meeting room</p></a></li>
                    <li><a href="#home" rel="external" onclick="call('20200155');"><img src="/data/images/Concierge-Desk.jpg" /><h3>Concierge Desk</h3><p>Press to call for assistance</p></a></li>
                    ''' + incMyDevices + '''
                </ul>
            </div><!-- /content -->
        </div><!-- /page  first-->
        '''
        
        pgDialPad2 = '''
        <div data-role="page" id="dialpad2" data-theme="b">
        <div data-role="header" data-position="inline"  data-theme="b">
            <h1>Dialpad</h1>
        </div>

    <div data-role="content"  data-theme="b" align="center">
        <div data-role="controlgroup" data-type="horizontal">
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('1');return false;">1</a>
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('2');return false;">2</a>
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('3');return false;">3</a>
        </div>
        <div data-role="controlgroup" data-type="horizontal">
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('4');return false;">4</a>
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('5');return false;">5</a>
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('6');return false;">6</a>
        </div>
        <div data-role="controlgroup" data-type="horizontal">
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('7');return false;">7</a>
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('8');return false;">8</a>
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('9');return false;">9</a>
        </div>
        <div data-role="controlgroup" data-type="horizontal">
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('*');return false;">*</a>
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('0');return false;">0</a>
            <a href="#incall" data-role="button" rel="external" onclick="sendkey('g');return false;">#</a>
        </div> 
    </div>
</div>
        '''
        
        pgDirectorio = '''
        <!-- Start of directory page -->
<div data-role="page" id="directory" data-theme="b">
    <div data-role="header" data-position="inline">
        <h1>Directory</h1>
        <a href="#home" data-icon="home" class="ui-btn-left">Home</a>
    </div><!-- /header -->

    <div data-role="content">    
        <ul data-role="listview" data-filter="true" data-filter-placeholder="Search room...">
            <li data-role="list-divider">LatinTelecom</li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('209.130.214.3##0155');">HELPDESK</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('56.2.6.241');">LTCL ETORREITER</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('56.2.6.242');">LTCL RCHOLAKY</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('56.2.6.163');">LTCL SALA REUNION 2</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('56.2.6.53');">LTCL INGENIERIA</a></li>
            <li data-role="list-divider">CV Argentina</li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('54.11.7.103');">CVAR FCAPARELLI</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('54.11.7.100');">CVAR SALA REUNION 1</a></li>
            <li data-role="list-divider">CV Brasil</li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('55.11.7.110');">CVBR EPONCE</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('55.11.7.100');">CVBR SALA DE REUNIAO 1</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('55.11.7.101');">CVBR SALA DE REUNIAO 2</a></li>
            <li data-role="list-divider">CV Chile</li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('56.2.7.101');">CVCL HGODOY</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('56.2.7.105');">CVCL SALA REUNION 1</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('56.2.7.103');">CVCL SALA REUNION 2</a></li>
            <li data-role="list-divider">CV Peru</li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('51.1.7.101');">CVPE CABAD</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('51.1.7.100');">CVPE SALA REUNION 1</a></li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('51.1.7.102');">CVPE SALA REUNION 2</a></li>
            <li data-role="list-divider">CV Venezuela</li>
            <li data-icon="grid"><a href="#home" rel="external" onclick="call('58.212.7.100');">CVVE SALA REUNION</a></li>
        </ul>
    </div><!-- /content -->
</div><!-- /page directory-->
        '''
        
        pgMonitor = '''
        <!-- Start of monitor page -->
<div data-role="page" id="monitor" data-theme="b">
    <div data-role="header" data-position="inline" data-theme="b">
        <h1>Device</h1>
        <!-- <a href="#home" data-icon="home" class="ui-btn-left">Home</a> -->
    </div><!-- /header -->

    <div data-role="content">    
        <ul data-role="listview" >
            <li data-role="list-divider"><h2>My monitor:</h2></li>
            <li data-icon="grid"><a href="#monitor" rel="external" onclick="tvonoff('1');">Turn on/off</a></li>
            <li data-icon="grid"><a href="#monitor" rel="external" onclick="tvmute('1');">Mute/Unmute</a></li>
            <li data-icon="grid"><a href="#monitor" rel="external" onclick="tvvolumeup('1');">Volume Up</a></li>
            <li data-icon="grid"><a href="#monitor" rel="external" onclick="tvvolumedown('1');">Volume Down</a></li>
            <li data-icon="grid"><a href="#monitor" rel="external" onclick="tvchangeinput('1');">Change Input</a></li>
        </ul>
    </div><!-- /content -->
</div><!-- /page monitor-->
        '''
        
        pgIncall = '''
        <!-- Start of incall page -->
<div data-role="page" id="incall" data-theme="b">
    <div data-role="header" data-position="inline">
        <h1>In Call</h1>
        <a href="#dialpad2" data-icon="grid" class="ui-btn-right" data-rel="dialog">Dialpad</a>
        <!-- <a href="#home" data-icon="home" class="ui-btn-left">Home</a> -->
    </div><!-- /header -->

    <div data-role="content">    
        <ul data-role="listview" >
            <li data-role="list-divider"><h2>My call:</h2></li>
            <li data-icon="grid"><a href="#incall" rel="external" onclick="vcbutton('play');">Send Content</a></li>
            <li data-icon="grid"><a href="#incall" rel="external" onclick="vcbutton('stop');">Stop Content</a></li>
            <li data-icon="grid"><a href="#incall" rel="external" onclick="mute();">Mute/Unmute</a></li>
            <li data-icon="grid"><a href="#incall" rel="external" onclick="volume('up');">Volume Up</a></li>
            <li data-icon="grid"><a href="#incall" rel="external" onclick="volume('down');">Volume Down</a></li>
            <li data-icon="grid"><a href="#incall" rel="external" onclick="hangup();">End call</a></li>
            ''' + incMyDevices + '''
        </ul>
    </div><!-- /content -->
</div><!-- /page incall-->
        '''
        
        pgLocal = '''
        <!-- Start of local page -->
<div data-role="page" id="local" data-theme="b">
    <div data-role="header" data-position="inline">
        <h1>Local meeting</h1>
        <a href="#home" data-icon="home" class="ui-btn-left">Home</a>
    </div><!-- /header -->

    <div data-role="content">    
        <ul data-role="listview" >
            <li data-role="list-divider"><h2>My meeting:</h2></li>
            <li data-icon="grid"><a href="#local" rel="external" onclick="vcbutton('play');">Send Content</a></li>
            <li data-icon="grid"><a href="#local" rel="external" onclick="vcbutton('stop');">Stop Content</a></li>
            <li><a href="#home">End local meeting</a></li>
        ''' + incMyDevices + '''
        </ul>
    </div><!-- /content -->
</div><!-- /page local-->
        '''
        
        pgCodec = '''
        <!-- Start of codec page -->
<div data-role="page" id="codec" data-theme="b">
    <div data-role="header" data-position="inline" data-theme="b">
        <h1>Device</h1>
        <!-- <a href="#home" data-icon="home" class="ui-btn-left">Home</a> -->
    </div><!-- /header -->

    <div data-role="content">    
        <ul data-role="listview" >
            <li data-role="list-divider"><h2>My VC endpoint:</h2></li>
            <li data-icon="grid"><a href="#codec" rel="external" onclick="codeconoff();">Turn on</a></li>
            <li data-icon="grid"><a href="#codec" rel="external" onclick="codecmute();">Mute/Unmute</a></li>
            <li data-icon="grid"><a href="#codec" rel="external" onclick="codecvolumeup();">Volume Up</a></li>
            <li data-icon="grid"><a href="#codec" rel="external" onclick="codecvolumedown();">Volume Down</a></li>
            <li data-icon="grid"><a href="#dialpad2" data-rel="dialog">Dialpad</a></li>
        </ul>
    </div><!-- /content -->
</div><!-- /page -->
        '''
        
        pgDatashow = '''
        <!-- Start of datashow page -->
<div data-role="page" id="datashow" data-theme="b">
    <div data-role="header" data-position="inline" data-theme="b">
        <h1>Device</h1>
        <!-- <a href="#home" data-icon="home" class="ui-btn-left">Home</a> -->
    </div><!-- /header -->

    <div data-role="content">    
        <ul data-role="listview" >
            <li data-role="list-divider"><h2>My Content Monitor:</h2></li>
            <li data-icon="grid"><a href="#datashow" rel="external" onclick="tvonoff('2');">Turn on/off</a></li>
            <li data-icon="grid"><a href="#datashow" rel="external" onclick="tvmute('2');">Mute/Unmute</a></li>
            <li data-icon="grid"><a href="#datashow" rel="external" onclick="tvvolumeup('2');">Volume Up</a></li>
            <li data-icon="grid"><a href="#datashow" rel="external" onclick="tvvolumedown('2');">Volume Down</a></li>
            <li data-icon="grid"><a href="#datashow" rel="external" onclick="tvchangeinput('2');">Change Input</a></li>
        </ul>
    </div><!-- /content -->
</div><!-- /page -->
        
        '''
        
        pgCamera = '''
        <!-- Start of camera page -->
<div data-role="page" id="camera2" data-theme="b">
    <div data-role="header" data-position="inline" data-theme="b">
        <h1>Camera</h1>
        <!-- <a href="#home" data-icon="home" class="ui-btn-left">Home</a> -->
    </div><!-- /header -->

    <div data-role="content"  data-theme="b" align="center">
        <div data-role="controlgroup" data-type="horizontal">
            <a href="#incall" data-role="button" rel="external" onclick="movecamera('up');return false;">UP</a>
        </div>
        <div data-role="controlgroup" data-type="horizontal">
            <a href="#incall" data-role="button" rel="external" onclick="movecamera('left');return false;">LEFT</a>
            <a href="#incall" data-role="button" rel="external" onclick="movecamera('right');return false;">RIGHT</a>
        </div>
        <div data-role="controlgroup" data-type="horizontal">
            <a href="#incall" data-role="button" rel="external" onclick="movecamera('down');return false;">DOWN</a>
        </div>
        <div data-role="controlgroup" data-type="horizontal">
            <a href="#incall" data-role="button" rel="external" onclick="movecamera('zoom+');return false;">Zoom IN</a>
            <a href="#incall" data-role="button" rel="external" onclick="movecamera('zoom-');return false;">Zoom OUT</a>
        </div> 
    </div>
</div><!-- /page -->
        
        '''
        
        fin_body = "</body>"
        fin_html = "</html>"
        
        return cabecera_html + cabecera_body + pgHome + pgDialPad2 + pgDirectorio + pgMonitor + pgIncall + pgLocal + pgCodec + pgDatashow + pgCamera +fin_body + fin_html
      
               
    main.exposed = True

# TELNET FUNCTIONS

    def answer(self,tiempo=None):
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open(self.codec,24,2)
        tn.write("\n")
        tn.write("answer video\n")
        jj = tn.read_until("answer incoming video call", 2)
        jj = jj + tn.read_until("answer incoming video call", 2)
        tn.close()
        if string.find(jj,"passed")!=-1:
            return "OK"
        else:
            return "Error"
    answer.exposed = True
        
    def call(self,tiempo=None,velocidad="1024",peer=None):
        if peer==None:
            return "No peer"
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open(self.codec,24,2)
        tn.write("\n")
        tn.write("dial auto %s %s\n" % (velocidad,peer))
        jj = tn.read_until("dialing", 2)
        tn.close()
        if string.find(jj,"dialing")!=-1:
            return "OK"
        else:
            return "Error"
    call.exposed = True
    
    def vcbutton(self,tiempo=None,velocidad="1024",action="play"):
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open(self.codec,24,2)
        tn.write("\n")
        tn.write("vcbutton %s\n" % (action))
        jj = tn.read_until("succeeded", 2)
        tn.close()
        if string.find(jj,"succeeded")!=-1:
            return "OK"
        else:
            return "Error"
    vcbutton.exposed = True

    def mute(self,tiempo=None):
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open(self.codec,24,2)
        tn.write("\n")
        tn.write("mute near toggle\n")
        jj = tn.read_until("mute near on", 2)
        tn.close()
        if string.find(jj,"on")!=-1:
            return "on"
        else:
            return "off"
    mute.exposed = True

    def hangup(self,tiempo=None):
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open(self.codec,24,5)
        tn.write("\n")
        tn.write("hangup video\n")
        jj = tn.read_until("hanging", 2)
        tn.close()
        if string.find(jj,"hanging")!=-1:
            return "OK"
        else:
            return "Error"
    hangup.exposed = True
    
    def volume(self,direction="up",tiempo=None):
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open(self.codec,24,5)
        tn.write("\n")
        tn.write("volume %s\n" % direction)
        jj = tn.read_until("no_return", 2)
        tn.close()
        if string.find(jj,"volume")!=-1:
            return "OK"
        else:
            return "Error"
    volume.exposed = True
    
    def sendkey(self, key, tiempo=None):
        if key == "g":
            key="\#"
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open(self.codec,24,5)
        tn.write("\n")
        tn.write("gendial %s\n" % key)
        jj = tn.read_until("no_return", 2)
        tn.close()
        if string.find(jj,"gendial")!=-1:
            return "OK"
        else:
            return "Error"
    sendkey.exposed = True        
    
    def movecamera(self, direction, tiempo=None):
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open(self.codec,24,5)
        tn.write("\n")
        tn.write("camera near move discrete\n")
        tn.write("camera near move %s\n" % direction)
        jj = tn.read_until("no_return", 2)
        tn.close()
        if string.find(jj,"camera")!=-1:
            return "OK"
        else:
            return "Error"
    movecamera.exposed = True
        
# IR FUNCTIONS

    def tvmute(self, puerto, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
            #INGENIERIA
        #myCmd = "sendir,1:" + puerto + ",1,38000,1,1,171,168,22,63,22,63,22,63,22,20,22,20,22,20,22,20,22,20,22,63,22,63,22,63,22,20,22,20,22,20,22,20,22,20,22,63,22,63,22,63,22,63,22,20,22,20,22,20,22,20,22,20,22,20,22,20,22,20,22,63,22,63,22,63,22,63,22,3812\r"
            #SALA 1
        myCmd = "sendir,1:" + puerto + ",1,40000,1,1,342,169,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,20,22,63,22,20,22,20,22,63,22,20,22,20,22,63,22,63,22,20,22,63,22,63,22,20,22,63,22,1039,342,169,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,20,22,63,22,20,22,20,22,63,22,20,22,20,22,63,22,63,22,20,22,63,22,63,22,20,22,63,22,4018\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    tvmute.exposed = True
        
    def tvonoff(self, puerto, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
            #INGENIERIA
        #myCmd = "sendir,1:" + puerto + ",1,38000,1,1,171,169,22,63,22,63,22,63,22,20,22,20,22,20,22,20,22,20,22,63,22,63,22,63,22,20,22,20,22,20,22,20,22,20,22,20,22,63,22,20,22,20,22,20,22,20,22,20,22,20,22,63,22,20,22,63,22,63,22,63,22,63,22,63,22,63,22,3812\r"
            #SALA 1
        myCmd = "sendir,1:" + puerto + ",1,40000,1,1,342,169,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,20,22,20,22,62,22,62,22,62,22,20,22,20,22,20,22,62,22,62,22,20,22,20,22,20,22,62,22,62,22,62,22,1038,342,169,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,20,22,20,22,62,22,62,22,62,22,20,22,20,22,20,22,62,22,62,22,20,22,20,22,20,22,62,22,62,22,62,22,4012\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    tvonoff.exposed = True
    
    def tvvolumeup(self, puerto, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
            #INGENIERIA
        #myCmd = "sendir,1:" + puerto + ",1,37000,1,1,168,166,22,61,22,61,22,61,22,19,22,19,22,19,22,19,22,19,22,61,22,61,22,61,22,19,22,19,22,19,22,19,22,19,22,61,22,61,22,61,22,19,22,19,22,19,22,19,22,19,22,19,22,19,22,19,22,61,22,61,22,61,22,61,22,61,22,3743\r"
            #SALA 1
        myCmd = "sendir,1:" + puerto + ",1,40000,1,1,342,170,22,21,22,62,22,21,22,62,22,21,22,62,22,21,22,62,22,62,22,21,22,62,22,21,22,62,22,21,22,62,22,21,22,21,22,62,22,21,22,62,22,21,22,21,22,21,22,21,22,62,22,21,22,62,22,21,22,62,22,62,22,62,22,62,22,1038,342,170,22,21,22,62,22,21,22,62,22,21,22,62,22,21,22,62,22,62,22,21,22,62,22,21,22,62,22,21,22,62,22,21,22,21,22,62,22,21,22,62,22,21,22,21,22,21,22,21,22,62,22,21,22,62,22,21,22,62,22,62,22,62,22,62,22,4012\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    tvvolumeup.exposed = True
    
    def tvvolumedown(self, puerto, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
            #INGENIERIA
        #myCmd = "sendir,1:" + puerto + ",1,38000,1,1,171,169,22,62,22,62,22,62,22,20,22,20,22,20,22,20,22,20,22,62,22,62,22,62,22,20,22,20,22,20,22,20,22,20,22,62,22,62,22,20,22,62,22,20,22,20,22,20,22,20,22,20,22,20,22,62,22,20,22,62,22,62,22,62,22,62,22,3812\r"
            #SALA 1
        myCmd ="sendir,1:" + puerto + ",1,40000,1,1,342,169,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,63,22,20,22,63,22,20,22,20,22,20,22,20,22,20,22,20,22,63,22,20,22,63,22,63,22,63,22,63,22,1040,342,169,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,20,22,63,22,63,22,20,22,63,22,20,22,20,22,20,22,20,22,20,22,20,22,63,22,20,22,63,22,63,22,63,22,63,22,4018\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    tvvolumedown.exposed = True
    
    def tvchangeinput(self, puerto, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
            #INGENIERIA
        #myCmd = "sendir,1:" + puerto + ",1,38000,1,1,171,169,22,63,22,63,22,63,22,20,22,20,22,20,22,20,22,20,22,63,22,63,22,63,22,20,22,20,22,20,22,20,22,20,22,63,22,20,22,20,22,20,22,20,22,20,22,20,22,20,22,20,22,63,22,63,22,63,22,63,22,63,22,63,22,63,22,3806\r"
            #SALA 1
                #SOLO SE ENVIA CODIGO DE LA ENTRADA 3 QUE ESTA PREDEFINIDA PARA VC ENDPOINT.
        myCmd = "sendir,1:" + puerto + ",1,40000,1,1,342,170,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,20,22,62,22,20,22,62,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,20,22,62,22,20,22,62,22,1039,342,170,22,62,22,62,22,62,22,62,22,20,22,62,22,20,22,62,22,20,22,20,22,20,22,20,22,62,22,20,22,62,22,20,22,20,22,20,22,62,22,62,22,62,22,62,22,62,22,20,22,62,22,62,22,20,22,20,22,20,22,20,22,20,22,62,22,1039,342,170,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,20,22,62,22,20,22,62,22,62,22,20,22,62,22,20,22,62,22,20,22,62,22,20,22,20,22,62,22,20,22,62,22,1039,342,170,22,62,22,62,22,62,22,62,22,20,22,62,22,20,22,62,22,20,22,20,22,20,22,20,22,62,22,20,22,62,22,20,22,20,22,20,22,62,22,62,22,62,22,62,22,62,22,20,22,62,22,62,22,20,22,20,22,20,22,20,22,20,22,62,22,4018\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    tvchangeinput.exposed = True
    
    def codeconoff(self, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
        myCmd = "sendir,1:3,1,39000,1,1,100,99,23,33,23,33,34,44,34,44,23,33,34,44,23,33,34,44,34,44,23,33,23,33,34,44,34,44,34,44,23,33,23,33,23,2197,100,99,23,33,23,33,34,44,34,44,23,33,34,44,23,33,34,44,34,44,23,33,23,33,34,44,34,44,34,44,23,33,23,33,23,3875\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    codeconoff.exposed = True
    
    def codecmute(self, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
        myCmd = "sendir,1:3,1,39000,1,1,100,99,23,33,23,33,34,44,34,44,23,33,34,44,23,33,34,44,34,44,34,44,34,44,23,33,34,44,23,33,34,44,34,44,23,2197,100,99,23,33,23,33,34,44,34,44,23,33,34,44,23,33,34,44,34,44,34,44,34,44,23,33,34,44,23,33,34,44,34,44,23,3875\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    codecmute.exposed = True
    
    def codecvolumeup(self, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
        myCmd = "sendir,1:3,1,39000,1,1,100,100,23,33,23,33,34,44,34,44,23,33,34,44,23,33,34,44,34,44,34,44,34,44,23,33,34,44,34,44,23,33,34,44,23,2197,100,100,23,33,23,33,34,44,34,44,23,33,34,44,23,33,34,44,34,44,34,44,34,44,23,33,34,44,34,44,23,33,34,44,23,3875\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    codecvolumeup.exposed = True
    
    def codecvolumedown(self, tiempo=None):
        host = self.itach
        port = 4998
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.connect((host, port))
        myCmd = "sendir,1:3,1,39000,1,1,100,99,23,33,23,33,34,44,34,44,23,33,34,44,23,33,34,44,34,44,34,44,34,44,34,44,23,33,23,33,34,44,34,44,23,2197,100,99,23,33,23,33,34,44,34,44,23,33,34,44,23,33,34,44,34,44,34,44,34,44,34,44,23,33,23,33,34,44,34,44,23,3875\r"
        s.send(myCmd)
        data = s.recv(1024)
        s.close()
        return "OK"
    codecvolumedown.exposed = True
    
    
    