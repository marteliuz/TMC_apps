function objetoAjax() {
    xmlhttp=false;
    this.AjaxFailedAlert = "Su navegador no soporta las funciónalidades de este sitio y podria experimentarlo de forma diferente a la que fue pensada. Por favor habilite javascript en su navegador para verlo normalmente.\n";
    this.encodeURIString = true;
    this.execute = false;
    if (window.XMLHttpRequest) { 
        this.xmlhttp = new XMLHttpRequest();
        if (this.xmlhttp.overrideMimeType) {
            this.xmlhttp.overrideMimeType('text/xml');
        }
    } 
    else if (window.ActiveXObject) { // IE
        try {
            this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }catch (e) {
            try {
                this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                this.xmlhttp = null;
            }
        }
        if (!this.xmlhttp && typeof XMLHttpRequest!='undefined') {
            this.xmlhttp = new XMLHttpRequest();
            if (!this.xmlhttp){
                this.failed = true; 
            }
        } 
    }
    return this.xmlhttp ;
}

function checkLogin()
{
	var username = document.getElementById("User").value;
	var password = document.getElementById("Pass").value;
	var divResultado = document.getElementById("divResultado");
	var response = "";
	
	if(valida(username,3)==true){
		if(valida(password,3)==true){
		
			ajax=objetoAjax();
			ajax.open("POST","../GUI/procesos/checklogin.php"+"?"+new Date().getTime(),true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==1){
					divResultado.innerHTML = "<img src='../GUI/resources/anim.gif' align='center'> Aguarde por favor...";
				}
				if (ajax.readyState==4) {
					if(ajax.status==200)
					{
						response = ajax.responseText;
						if(response=="OK"){Sexy.alert("Bienvenido "+username+"<br> En 3 segundos sera redirigido."); setTimeout(function() {window.location ="../GUI/procesos/ticket_client_user.php";},3000);}
						if(response=="NO"){Sexy.error("Error entre username y password");}
					}
					else if(ajax.status==404)
					{
						divResultado.innerHTML = "La direccion AJAX no existe";
					}else{
						divResultado.innerHTML = "Error: ".ajax.status;
					}
				}
			}
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("username="+username+"&password="+password);
		
		}else{
			Sexy.error("El campo contrase&ntilde;a no cumple con los criterios de validaci&oacute;n");
		}
	}else{
		Sexy.error("El campo usuario no cumple con los criterios de validaci&oacute;n");
	}
}

function CrearNuveoTicketExterno()
{
	var divResultado    = document.getElementById("resultado");
	var fecha_creacion  = document.getElementById("fecha_creacion").value;
	var nomb_cliente    = document.getElementById("nomb_cliente").value;
	var nomb_contacto   = document.getElementById("nomb_contacto").value;
	var telef_contacto  = document.getElementById("telef_contacto").value;
	var movil_contacto  = document.getElementById("movil_contacto").value;
	var email_contacto  = document.getElementById("email_contacto").value;
	var dir_contacto    = document.getElementById("dir_contacto").value;
	var cmbModelos      = document.getElementById("cmbModelos");
	var indice          = cmbModelos.selectedIndex;
	var modelo          = cmbModelos.options[indice].value;
	
	var nserie_terminal = document.getElementById("nserie_terminal").value;
	var nserie_falla    = document.getElementById("nserie_falla").value;
	var detalle_falla   = document.getElementById("detalle_falla").value;	

	var response = "";
	
	if(valida(nomb_cliente,5)==true){
	if(valida(nomb_contacto,5)==true){
	if(valida(telef_contacto,5)==true){
	if(valida(movil_contacto,5)==true){
	if(validaEmail(email_contacto)==true){
	if(valida(dir_contacto,5)==true){
	if(valida(nserie_terminal,5)==true){
	if(valida(nserie_falla,5)==true){
	if(valida(detalle_falla,5)==true){
	
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryNuevoTicketExterno.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
					else{ 
						response = response.split("|");
						Sexy.alert("Hemos recibido su solicitud con ID: "+response[1]+"<br> espere 3 segundos por favor..."); setTimeout(function() {window.location.reload();},3000);
					}
				}
				else if(ajax.status==404)
				{
					divResultado.innerHTML = "La direccion AJAX no existe";
				}else{
					divResultado.innerHTML = "Error: ".ajax.status;
				}
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("fecha_creacion="+fecha_creacion+"&nomb_cliente="+nomb_cliente+"&nomb_contacto="+nomb_contacto+"&telef_contacto="+telef_contacto+"&movil_contacto="+movil_contacto+"&email_contacto="+email_contacto+"&dir_contacto="+dir_contacto+"&modelo_terminal="+modelo+"&nserie_terminal="+nserie_terminal+"&nserie_falla="+nserie_falla+"&detalle_falla="+detalle_falla);
	}else{Sexy.error("el campo Detalle de Falla, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Numero de Serie con Falla, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Numero de Serie Terminal, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Direccion Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Email Contacto, no cumple con los criterios de validacion.");	}
	}else{Sexy.error("el campo Movil Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Telefono Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Nombre Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Nombre Empresa, no cumple con los criterios de validacion.");}
}

function CrearNuveoTicketCliente()
{
	var divResultado    = document.getElementById("resultado");
	var fecha_creacion  = document.getElementById("fecha_creacion").value;
	var nomb_cliente    = document.getElementById("nomb_cliente").value;
	var id_cliente      = document.getElementById("id_cliente").value;
	var nomb_contacto   = document.getElementById("nomb_contacto").value;
	var telef_contacto  = document.getElementById("telef_contacto").value;
	var movil_contacto  = document.getElementById("movil_contacto").value;
	var email_contacto  = document.getElementById("email_contacto").value;
	var dir_contacto    = document.getElementById("dir_contacto").value;
	
	var RadioGroup_0    = document.getElementById("RadioGroup_0").checked;
	var RadioGroup_1	= document.getElementById("RadioGroup_1").checked;
	
	var response = "";

	if(RadioGroup_0){
		var cmbTerminales = document.getElementById("cmbTerminales");
		var indice        = cmbTerminales.selectedIndex;
		var idtbterminal  = cmbTerminales.options[indice].value;
		//var modelo        = document.getElementById("modelo").value;
	}
	if(RadioGroup_1){
		var idtbterminal = 0;
		var cmbModelos   = document.getElementById("cmbModelos");
		var indice       = cmbModelos.selectedIndex;
		var modelo       = cmbModelos.options[indice].value;
	}

	
	var nserie_terminal = document.getElementById("nserie_terminal").value;
	var nserie_falla    = document.getElementById("nserie_falla").value;
	var detalle_falla   = document.getElementById("detalle_falla").value;
	
	if(valida(nomb_cliente,5)==true){
	if(valida(nomb_contacto,5)==true){
	if(valida(telef_contacto,5)==true){
	if(valida(movil_contacto,5)==true){
	if(valida(email_contacto,5)==true){
	if(valida(dir_contacto,5)==true){
	if(valida(nserie_terminal,5)==true){
	if(valida(nserie_falla,5)==true){
	if(valida(detalle_falla,5)==true){
	
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryNuevoTicketCliente.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					// divResultado.innerHTML = ajax.responseText;
					response = ajax.responseText;
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
					else{
						response = response.split("|");
						Sexy.alert("Su ticket fue creado con ID: "+response[1]);
						setTimeout(function() {window.location.reload();},5000);
					}
				}
				else if(ajax.status==404)
				{
					divResultado.innerHTML = "La direccion AJAX no existe";
				}else{
					divResultado.innerHTML = "Error: ".ajax.status;
				}
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("fecha_creacion="+fecha_creacion+"&id_cliente="+id_cliente+"&nomb_cliente="+nomb_cliente+"&nomb_contacto="+nomb_contacto+"&telef_contacto="+telef_contacto+"&movil_contacto="+movil_contacto+"&email_contacto="+email_contacto+"&dir_contacto="+dir_contacto+"&id_terminal="+idtbterminal+"&modelo_terminal="+modelo+"&nserie_terminal="+nserie_terminal+"&nserie_falla="+nserie_falla+"&detalle_falla="+detalle_falla);
	
	}else{Sexy.error("el campo Detalle de Falla, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Numero de Serie con Falla, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Numero de Serie Terminal, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Direccion Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Email Contacto, no cumple con los criterios de validacion.");	}
	}else{Sexy.error("el campo Movil Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Telefono Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Nombre Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Nombre Empresa, no cumple con los criterios de validacion.");}
}

function loadTerminalInfo()
{
	var divResultado = document.getElementById("divInfoTerminal");
	var cmbUsuario   = document.getElementById("cmbTerminales");
	var indice       = cmbUsuario.selectedIndex;
	var valor        = cmbUsuario.options[indice].value;
	var idterminal   = valor;

	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowTerminalInfo.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{divResultado.innerHTML = ajax.responseText;}
			else if(ajax.status==404)
			{
				divResultado.innerHTML = "La direccion AJAX no existe";
			}else{
				divResultado.innerHTML = "Error: ".ajax.status;
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("idterminal="+idterminal);
}

function NuevoTerminalTicket()
{
	hideDiv('DivCmbTerminales');
	var divResultado = document.getElementById("divInfoTerminal");
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowTerminalInfo.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{divResultado.innerHTML = ajax.responseText;}
			else if(ajax.status==404)
			{
				divResultado.innerHTML = "La direccion AJAX no existe";
			}else{
				divResultado.innerHTML = "Error: ".ajax.status;
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}

function hideDiv(divID)
{
	var div = document.getElementById(divID);
	div.style.visibility = 'hidden';
}

function showDiv(divID)
{
	var div = document.getElementById(divID);
	div.style.visibility = 'visible';
}

function ShowDivCmbTerminales()
{
	showDiv('DivCmbTerminales');
}

// VALIDACIONES

function valida(string, largo)
{
	string = trim(string);
	if(validaBlanco(string)==true)
	{
		if(validaLargo(string, largo)==true){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function validaBlanco(string)
{
	// Recibe un string y devuleve false si es vacio o blanco, devielve true cumple con la validacion
	if(string==""){return false;}else{return true;}
}

function validaLargo(string, largo)
{
	// Recibe un string y un int que representa el largo, devuelve false si el largo del string no supera int, devielve true cumple con la validacion
	if(string.length>=largo){return true;}else{return false;}
}

function trim(myString)
{
	return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}

function validaEmail(valor){
    re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
    if(!re.exec(valor))    {
        return false;
    }else{
        return true;
    }
}

function soloLetras(e)
{
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
	especiales = [8,37,39,46];
	tecla_especial = false
	for(var i in especiales){
		if(key == especiales[i])
		{
			tecla_especial = true;
			break;
        } 
	}
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
		return false;
}

function soloNumeros(e)
{
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = "1234567890 ";
	especiales = [8,37,39,46];
	tecla_especial = false
	for(var i in especiales){
		if(key == especiales[i])
		{
			tecla_especial = true;
			break;
        } 
	}
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
		return false;
}

function modoRut(e)
{
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = "1234567890-Kk";
	especiales = [8,37,39,46];
	tecla_especial = false
	for(var i in especiales){
		if(key == especiales[i])
		{
			tecla_especial = true;
			break;
        } 
	}
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
		return false;
}
