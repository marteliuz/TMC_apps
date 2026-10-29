'''
Created on 30-06-2011

@author: jfroco
'''

import telnetlib
import string

class WebServer(object):
    
    myStatus = "unknown"
    
    def index(self):
        return "Hello world!"
    index.exposed = True
    
    def status(self,tiempo=None):
        return '''
        <html>
        <head>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>

</head><body>''' + self.myStatus +"</body></html>"
    status.exposed = True
    
    
    def main(self):
        return '''
        <html>
        <head>
       <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</head>
<script language="javascript" type="text/javascript">

var texto = "Estatus = ";
var request = false;
var request2 = false
var request3 = false
var request3 = false

    getStatus();
    setInterval(getStatus, 1000); 

function getStatus() {

   try {
     request = new XMLHttpRequest();
   } catch (trymicrosoft) {
     try {
       request = new ActiveXObject("Msxml2.XMLHTTP");
     } catch (othermicrosoft) {
       try {
         request = new ActiveXObject("Microsoft.XMLHTTP");
       } catch (failed) {
         request = false;
       }  
     }
   }

 if (!request)
     alert("Error initializing XMLHttpRequest!");
     
     fecha = new Date()
     tiempo = fecha.getTime()
     request.open("POST", "status?tiempo="+tiempo, true);
     request.onreadystatechange = updateStatus;
     request.send(null);
}


function answer() {

   try {
     request2 = new XMLHttpRequest();
   } catch (trymicrosoft) {
     try {
       request2= new ActiveXObject("Msxml2.XMLHTTP");
     } catch (othermicrosoft) {
       try {
         request2 = new ActiveXObject("Microsoft.XMLHTTP");
       } catch (failed) {
         request2 = false;
       }  
     }
   }

 if (!request2)
     alert("Error initializing XMLHttpRequest!");
     
     fecha = new Date()
     tiempo = fecha.getTime()
     request2.open("POST", "answer?tiempo="+tiempo, true);
     request2.onreadystatechange = updateAnswer;
     request2.send(null);
}

 function updateStatus() {
     if (request.readyState == 4)
         if (request.status == 200) {
         
             resultado = request.responseText;
             document.getElementById("status").innerHTML = texto+resultado;
             
         
         }
         
         
   }
   
   
 function updateAnswer() {
     if (request2.readyState == 4)
         if (request2.status == 200) {
         
             resultado = request2.responseText;
             document.getElementById("answer").innerHTML = resultado;
             
         
         }
         
         
   }   
   
   
   
function call() {

   try {
     request3 = new XMLHttpRequest();
   } catch (trymicrosoft) {
     try {
       request3= new ActiveXObject("Msxml2.XMLHTTP");
     } catch (othermicrosoft) {
       try {
         request3 = new ActiveXObject("Microsoft.XMLHTTP");
       } catch (failed) {
         request3= false;
       }  
     }
   }

 if (!request3)
     alert("Error initializing XMLHttpRequest!");
     
     fecha = new Date()
     tiempo = fecha.getTime()
     request3.open("POST", "call?peer=8980222&tiempo="+tiempo, true);
     request3.onreadystatechange = updateCall;
     request3.send(null);
}

 function updateCall() {
     if (request3.readyState == 4)
         if (request3.status == 200) {
         
             resultado = request3.responseText;
             document.getElementById("dialing").innerHTML = resultado;
             
         
         }
         
         
   }   
   

function hangup() {

   try {
     request4 = new XMLHttpRequest();
   } catch (trymicrosoft) {
     try {
       request4= new ActiveXObject("Msxml2.XMLHTTP");
     } catch (othermicrosoft) {
       try {
         request4 = new ActiveXObject("Microsoft.XMLHTTP");
       } catch (failed) {
         request4= false;
       }  
     }
   }

 if (!request4)
     alert("Error initializing XMLHttpRequest!");
     
     fecha = new Date()
     tiempo = fecha.getTime()
     request4.open("POST", "hangup?tiempo="+tiempo, true);
     request4.onreadystatechange = updateHangup;
     request4.send(null);
}

 function updateHangup() {
     if (request4.readyState == 4)
         if (request4.status == 200) {
         
             resultado = request4.responseText;
             document.getElementById("hanging").innerHTML = resultado;
             
         
         }
         
         
   }   


function updateStatusTest() {
    response ="Unknown";
    document.getElementById("status").innerHTML = texto+response;
}

</script>
<body>

<div id="status">Estatus = </div>
<form>
<input type="button" value="Answer" onclick="answer();">
</form>
<div id="answer"></div>

<form>
<input type="button" value="Call" onclick="call();">
</form>
<div id="dialing"></div>

<form>
<input type="button" value="Hangup" onclick="hangup();">
</form>
<div id="hanging"></div>
</body>
</html>
        
        
        
        '''
    main.exposed = True

    def answer(self,tiempo=None):
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open("56.2.6.30",24,2)
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
        
        
    def call(self,tiempo=None,velocidad="384",peer=None):
        if peer==None:
            return "No peer"
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open("56.2.6.30",24,2)
        tn.write("\n")
        tn.write("dial auto %s %s\n" % (velocidad,peer))
        jj = tn.read_until("dialing", 2)
        tn.close()
        if string.find(jj,"dialing")!=-1:
            return "OK"
        else:
            return "Error"
    call.exposed = True
    
    
    def hangup(self,tiempo=None):
        tn = telnetlib.Telnet()
        tn.set_debuglevel(10)
        tn.open("56.2.6.30",24,5)
        tn.write("\n")
        tn.write("hangup video\n")
        jj = tn.read_until("hanging", 2)
        tn.close()
        if string.find(jj,"hanging")!=-1:
            return "OK"
        else:
            return "Error"
    hangup.exposed = True
