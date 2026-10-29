'''
Created on 13-06-2011

@author: JF
'''
import cherrypy
import time

class WebServer:
    def boton1(self):
        time.sleep(2)
        return "001"
    boton1.exposed = True

    def boton2(self):
        return "002"
    boton2.exposed = True
    
    
    
    def main(self):
        return '''
<!DOCTYPE html> 
<html> 
    <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,height=device-height,width=device-width">
    <title>Easy Control</title> 
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>
</head> 
<body onload="setTimeout(scrollTo, 0, 0, 1)"> 

<!-- Start of first page -->
<div data-role="page" id="foo" data-theme="b">

    <div data-role="header" data-position="fixed">
        <h1><div id="status">My status is Idle</div></h1>
        <a href="#bar" data-icon="gear" class="ui-btn-right">Options</a>
    </div><!-- /header -->

    <div data-role="content">    

<ul data-role="listview">
    <li><a href="#bar">Local meeting</a></li>
    <li><a href="#bar">Directory</a></li>
    <li><a href="#bar">Meeting room</a></li>
    <li><a href="#bar">Concierge desk</a></li>

</ul>

 
    </div><!-- /content -->


    <div data-role="footer" data-position="fixed" class="ui-bar">

     <div data-role="controlgroup" data-type="horizontal" align="center">
     <a href="#bar" data-role="button" data-icon="refresh">TV On/Off</a>
<a href="#bar" data-role="button" data-icon="refresh">VC On/Off</a>
<a href="#bar" data-role="button" data-icon="refresh">DS On/Off</a>   
</div>
    </div><!-- /footer -->
</div><!-- /page -->


<!-- Start of second page -->
<div data-role="page" id="bar" data-theme="a" ">

    <div data-role="header" data-position="inline">
        <h1>Options</h1>
        <a href="#foo" data-icon="home" class="ui-btn-left">Home</a>
    </div><!-- /header -->

    <div data-role="content">    
        <p>I'm first in the source order so I'm shown as the page.</p>        
        <p><a href="#foo">Back to foo</a></p>    
    </div><!-- /content -->

    <div data-role="footer">
        <h4>Page Footer</h4>
    </div><!-- /footer -->
</div><!-- /page -->
</body>
</html>

        '''
    main.exposed=True


def main():
    cherrypy.server.socket_host = "10.0.0.37"
    cherrypy.quickstart(WebServer())

if __name__ == '__main__':
    main()