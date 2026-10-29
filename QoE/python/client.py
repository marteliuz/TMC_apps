import Pyro4
import code
import sys
import QoEManager
import NodeManager
import Node

uri = "PYRO:QoE@localhost:28117"

qoe = Pyro4.Proxy(uri)

shell = code.InteractiveConsole({ 'qoe': qoe })
try:
    shell.interact("Welcome to QoE management console")
except SystemExit,e:
    print("Bye!!")
except:
    print("Exception")
    qoe._release()

sys.exit()