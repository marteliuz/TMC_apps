log="QoE.log"
dbusername="qoemanager"
dbpassword="latin"
dbhost="127.0.0.1"
db="dbqoe"

timeout=5
wait_time=120
incall_wait_time=30

polling_time=60
incall_polling_time=15

#embedded web server
server_host = "10.56.12.150"
server_port=28117


# Tipos
#'0'     NO SE USA
#'1'     'Organizacion'
#'2'     'Red'
#'3'     'Polycom VSX'
#'4'     'Polycom HDX'
#'5'     'Router'
#'6'     'Switch'
#'7'     'Firewall'
#'8'     'Polycom QDX'
#'9'     'Polycom HDX con XML'
#'10'    'Tandberg C20'

xml=[None,
     None,
     None,
     "getlastconnectionmsg.xml",
     "a_getlastconnectionmsg.htm",
     None,
     None,
     None,
     "a_getlastconnectionmsg.htm",
     "getlastconnectionmsg.xml",
     "status.xml"]

realm=[None,
     None,
     None,
     "this site",
     "this web site",
     None,
     None,
     None,
     "this web site",
     "this web site",
     "TANDBERG-Endpoint"]
