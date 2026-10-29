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
			ajax.open("POST","../procesos/checkloginClte.php"+"?"+new Date().getTime(),true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==1){
					divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
				}
				if (ajax.readyState==4) {
					if(ajax.status==200)
					{
						response = ajax.responseText;
						if(response=="OK"){Sexy.alert("Bienvenido "+username+"<br> En 3 segundos sera redirigido."); setTimeout(function() {window.location ="../procesos/ticket_client_user.php";},3000);}
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

function checkClientRUT()
{
	var rutCliente = document.getElementById("rut_cliente").value;
	var divResultado = document.getElementById("resultado");
	
	if(rutCliente!="")
	{
		
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryCheckClientRUT.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					response = parseInt(response);
					//divResultado.innerHTML = response;
					if(response>0)
					{
						document.getElementById("rut_cliente").value = "";
						Sexy.error("El RUT ingresado ya existe");
					}
					//if(response=="NO"){Sexy.error("Error entre username y password");}
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
		ajax.send("rutCliente="+rutCliente);
		
	}else{
		Sexy.error("El campo Rut no puede ser vacio.")
	}
}

function resetFormNuevoCliente()
{
	try{
		document.getElementById("nomb_cliente").value = "";
		document.getElementById("rut_cliente").value = "";
		document.getElementById("telef_cliente").value = "";
		document.getElementById("giro_cliente").value = "";
		document.getElementById("sigla_cliente").value = "";
		document.getElementById("dir_cliente").value = "";
		document.getElementById("nomb_contacto").value = "";
		document.getElementById("cargo_contacto").value = "";
		document.getElementById("email_contacto").value = "";
		document.getElementById("telef_contacto").value = "";
		document.getElementById("movil_contacto").value = "";
		document.getElementById("dir_contacto").value = "";
		divResultado = document.getElementById('resultado');
		divResultado.innerHTML = "";
	}catch(err){
		alert(err.message);
	}
}

function resetFormNuevoTerminal()
{
	try{
		document.getElementById("nro_serie").value = "";
		document.getElementById("ubicacion").value = "";
		document.getElementById("serie_camara").value = "";
		document.getElementById("serie_mic").value = "";
		document.getElementById("serie_cremoto").value = "";;
		divResultado = document.getElementById('resultado');
		divResultado.innerHTML = "";
	}catch(err){
		alert(err.message);
	}
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

function changeSearchMode(divA, divB)
{
	var divAa = document.getElementById(divA);
	var divBb = document.getElementById(divA);
	
	if(document.getElementById('op2').checked)
	{
		hideDiv(divA);
		showDiv(divB);
		document.getElementById("resultado").innerHTML = "";
	}else{
		hideDiv(divB);
		showDiv(divA);
		document.getElementById("resultado").innerHTML = "";
	}
}

function InsertUsuario()
{
	var nomb_usuario = document.getElementById("nomb_usuario").value;
	var username     = document.getElementById("username").value;
	var email		 = document.getElementById("email").value;
	var password	 = document.getElementById("password").value;
	var password2	 = document.getElementById("password2").value;
	var RadioGroup_0 = document.getElementById("RadioGroup_0").checked;
	var RadioGroup_1 = document.getElementById("RadioGroup_1").checked;
	var divResultado = document.getElementById('resultado');
	var tipo    = "";
	var cliente = "";
	var response = "";
	
	if(valida(nomb_usuario, 10)==true){
	if(valida(username, 5)==true){
	if(validaEmail(email)==true){
	if(valida(password, 4)==true){
	if(valida(password2, 4)==true){
		if(RadioGroup_0)
		{tipo    = 1;cliente = 0;}
		if(RadioGroup_1)
		{tipo = 2;
			var cmbCliente = document.getElementById("cmbClientes");
			var indice = cmbCliente.selectedIndex;
			var value  = cmbCliente.options[indice].value;
			cliente = value;
		}
		if(password!=password2)
		{
			Sexy.error("Las contrase&#328;as ingresadas no coinciden.");
		}else{
			ajax=objetoAjax();
			ajax.open("POST","../procesos/qryNuevoUsuario.php"+"?"+new Date().getTime(),true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==1){
					divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
				}
				if (ajax.readyState==4) {
					if(ajax.status==200)
					{
						response = ajax.responseText;
						if(response=="OK"){Sexy.alert("Usuario registrado satisfactoriamente."); setTimeout(function() {window.location.reload();},3000);}
						if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
						if(response=="ERROR USUARIO"){Sexy.error("El nombre de usuario ya existe.");}
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
			ajax.send("nombre="+nomb_usuario+"&username="+username+"&password="+password+"&email="+email+"&cliente="+cliente+"&tipo="+tipo);
		}
	}else{Sexy.error("El campo Password2, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo Password, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo Email, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo username, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo nombre, no cumple con los criterios de validacion.");}
}

function showAllTerminalesByCliente()
{
	var divResultado = document.getElementById("resultado");
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var id_cliente   = cmbClientes.options[indice].value;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowAllTerminalesByCliente.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				divResultado.innerHTML = ajax.responseText;
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
	ajax.send("id_cliente="+id_cliente);
}

function showAllTerminalesByCliente1()
{
	var divResultado = document.getElementById("imprimir");
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var id_cliente   = cmbClientes.options[indice].value;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowAllTerminalesByCliente1.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				divResultado.innerHTML = ajax.responseText;
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
	ajax.send("id_cliente="+id_cliente);
}

function ShowUserInfo()
{
	var divResultado = document.getElementById("datos");
	var cmbUsuario   = document.getElementById("cmbUsuarios");
	var indice       = cmbUsuario.selectedIndex;
	var valor        = cmbUsuario.options[indice].value;
	var idusuario    = valor;

	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowUserInfo.php"+"?"+new Date().getTime(),true);
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
	ajax.send("iduser="+idusuario);
}

function disableCliente(id_cliente)
{
	var divResultado = document.getElementById('resultado');
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryDisableCliente.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
	if (ajax.readyState==1){
		divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
	}
		if (ajax.readyState==4) {
			if(ajax.status==200)
				{
					response = ajax.responseText;
					// divResultado.innerHTML = response;
					if(response=="OK"){Sexy.alert("El Cliente ha sido deshabilitado satisfactoriamente."); setTimeout(function() {window.location.reload();},5000);}
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
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
	ajax.send("id_cliente="+id_cliente);
}

function enableCliente(id_cliente)
{
	var divResultado = document.getElementById('resultado');
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryEnableCliente.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
	if (ajax.readyState==1){
		divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
	}
		if (ajax.readyState==4) {
			if(ajax.status==200)
				{
					response = ajax.responseText;
					// divResultado.innerHTML = response;
					if(response=="OK"){Sexy.alert("El Cliente ha sido habilitado satisfactoriamente."); setTimeout(function() {window.location.reload();},5000);}
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
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
	ajax.send("id_cliente="+id_cliente);
}

function updateUserInfo()
{
	var idtb     = document.getElementById('idtb').value;
	var nombre   = document.getElementById("nomb_usuario").value;
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var email    = document.getElementById("email").value;
	
	var cmbCliente    = document.getElementById("cmbClientes");
	var indice        = cmbCliente.selectedIndex;
	var cliente       = cmbCliente.options[indice].value;
	
	var radioAdmin    = document.getElementById("RadioGroup_0").checked;
	var radioClte     = document.getElementById("RadioGroup_1").checked;
	var radioActive   = document.getElementById("RadioGroupEstado_0").checked;
	var radioInactive = document.getElementById("RadioGroupEstado_1").checked;
	var divResultado  = document.getElementById('resultado');
	
	var tipo    = "";
	var estado  = "";
	var response;
	
	if (radioAdmin){ tipo    = 1; cliente = 0;}
	if (radioClte){ tipo = 2;}
	if (radioActive){ estado = 1;}
	if (radioInactive){	estado = 0;}
	
	if(valida(nombre,10)){
	if(valida(username,5)){
	if(valida(password,4)){
	if(validaEmail(email)){
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryUpdateUserInfo.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
			if (ajax.readyState==4) {
				if(ajax.status==200)
					{
						response = ajax.responseText;
						if(response=="OK"){Sexy.alert("La informacion del usuario has sido actualizada correctamente."); setTimeout(function() {window.location.reload();},3000);}
						if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
						if(response=="ERROR USERNAME"){Sexy.error("El nombre de usuario ya existe.");}
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
		ajax.send("idtb="+idtb+"&nombre="+nombre+"&username="+username+"&password="+password+"&email="+email+"&estado="+estado+"&tipo="+tipo+"&cliente="+cliente);
	
	
	}else{Sexy.error("El campo Email, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Password, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Username, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nombre, no cumple los criterios de validacion.");}
}

function InsertCliente()
{
	var nomb_cliente   = document.getElementById("nomb_cliente").value;
	var rut_cliente    = document.getElementById("rut_cliente").value;
	var telef_cliente  = document.getElementById("telef_cliente").value;
	var giro_cliente   = document.getElementById("giro_cliente").value;
	var sigla_cliente  = document.getElementById("sigla_cliente").value;
	var dir_cliente    = document.getElementById("dir_cliente").value;
	var nomb_contacto  = document.getElementById("nomb_contacto").value;
	var cargo_contacto = document.getElementById("cargo_contacto").value;
	var email_contacto = document.getElementById("email_contacto").value;
	var telef_contacto = document.getElementById("telef_contacto").value;
	var movil_contacto = document.getElementById("movil_contacto").value;
	var dir_contacto   = document.getElementById("dir_contacto").value;
		
	var region_cliente	= getSelectedValue("cmbRegiones_cliente");
	var ciudad_cliente  = getSelectedValue("cmbComunas_cliente");
	
	var region_contacto	= getSelectedValue("cmbRegiones_contacto");
	var ciudad_contacto = getSelectedValue("cmbComunas_contacto");
	
	var	divResultado = document.getElementById('resultado');
	var response;

	//--------------------------------------------------------------------------------
	if(valida(nomb_cliente, 5)==true){
	if(valida(rut_cliente, 9)==true){
	if(valida(telef_cliente, 5)==true){
	if(valida(giro_cliente, 5)==true){
	if(valida(sigla_cliente, 3)==true){
	if(valida(dir_cliente, 5)==true){
	if(valida(nomb_contacto, 5)==true){
	if(valida(cargo_contacto, 5)==true){
	if(validaEmail(email_contacto)==true){
	if(valida(telef_contacto, 5)==true){
	if(valida(movil_contacto, 5)==true){
	if(valida(dir_contacto, 5)==true){

	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryNuevoCliente.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				// divResultado.innerHTML = response;
			
				if(response=="OK"){Sexy.alert("Cliente registrado satisfactoriamente."); setTimeout(function() {window.location.reload();},3000);}
				if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
				if(response=="ERROR RUT"){Sexy.error("El RUT asociado al cliente ya existe.");}
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
	ajax.send("nomb_cliente="+nomb_cliente+"&rut_cliente="+rut_cliente+"&telef_cliente="+telef_cliente+"&giro_cliente="+giro_cliente+"&sigla_cliente="+sigla_cliente+"&dir_cliente="+dir_cliente+"&reg_cliente="+region_cliente+"&nomb_contacto="+nomb_contacto+"&cargo_contacto="+cargo_contacto+"&email_contacto="+email_contacto+"&telef_contacto="+telef_contacto+"&movil_contacto="+movil_contacto+"&dir_contacto="+dir_contacto+"&reg_contacto="+region_contacto+"&ciudad_cliente="+ciudad_cliente+"&ciudad_contacto="+ciudad_contacto);

	}else{Sexy.error("El campo Direccion de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Movil de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Telefono de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Email de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Cargo de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nombre de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Direccion de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Sigla del cliente, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo Giro de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Telefono de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo RUT de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nombre de cliente, no cumple los criterios de validacion.");}
}

function showTerminalesByClientID()
{
	var divResultado = document.getElementById("divTerminales");
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var id_cliente   = cmbClientes.options[indice].value;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowDivTerminalesByClientID.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_cliente="+id_cliente);
}

function showTerminalInfo()
{
	var divResultado = document.getElementById("divTerminales1");
	var cmbTerminal  = document.getElementById("cmbTerminalesHuerfanos");
	var indice       = cmbTerminal.selectedIndex;
	var value        = cmbTerminal.options[indice].value;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowTerminalInfo1.php"+"?"+new Date().getTime(),true);
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
	ajax.send("terminal="+value);
}
	
function showTerminalesAndContratosByClientID()
{
	var divResultado = document.getElementById("divContratos");
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var id_cliente   = cmbClientes.options[indice].value;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowDivContratosByClientID.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_cliente="+id_cliente);
}

function showTerminalesAndContratosByClientID1()
{
	var divResultado = document.getElementById("divContratos");
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var id_cliente   = cmbClientes.options[indice].value;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowDivContratosByClientID1.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_cliente="+id_cliente);
}

function ShowClientInfo()
{
	//limpiar divResultado final
	document.getElementById("resultado").innerHTML = ""
	
	var divResultado = document.getElementById("datos");
	var cmbCliente   = document.getElementById("cmbClientes");
	var indice       = cmbCliente.selectedIndex;
	var value        = cmbCliente.options[indice].value;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowClientInfo.php"+"?"+new Date().getTime(),true);
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
	ajax.send("cliente="+value);
}

function ShowContratoClientes()
{
	var divResultado = document.getElementById("datos");
	var cmbCliente   = document.getElementById("cmbClientes");
	var indice       = cmbCliente.selectedIndex;
	var value        = cmbCliente.options[indice].value;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowContratoClientes.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_cliente="+value);

}

function updateClientInfo()
{
	var idtb           = document.getElementById("id").value;
	var nomb_cliente   = document.getElementById("nomb_cliente").value;
	var rut_cliente    = document.getElementById("rut_cliente").value;
	var telef_cliente  = document.getElementById("telef_cliente").value;
	var giro_cliente   = document.getElementById("giro_cliente").value;
	var sigla_cliente   = document.getElementById("sigla_cliente").value;
	var dir_cliente    = document.getElementById("dir_cliente").value;
	var nomb_contacto  = document.getElementById("nomb_contacto").value;
	var cargo_contacto = document.getElementById("cargo_contacto").value;
	var email_contacto = document.getElementById("email_contacto").value;
	var telef_contacto = document.getElementById("telef_contacto").value;
	var movil_contacto = document.getElementById("movil_contacto").value;
	var dir_contacto   = document.getElementById("dir_contacto").value;
	
	var region_cliente	= getSelectedValue("region_cliente");
	var ciudad_cliente  = getSelectedValue("cmbCiudades_cliente");
	var region_contacto	= getSelectedValue("region_contacto");
	var ciudad_contacto	= getSelectedValue("cmbCiudades_contacto");
	
	var	divResultado = document.getElementById('resultado');
	var response;
	//--------------------------------------------------------------------------------
	if(valida(nomb_cliente, 5)==true){
	if(valida(rut_cliente, 9)==true){
	if(valida(telef_cliente, 5)==true){
	if(valida(giro_cliente, 5)==true){
	if(valida(dir_cliente, 5)==true){
	if(valida(nomb_contacto, 5)==true){
	if(valida(cargo_contacto, 5)==true){
	if(validaEmail(email_contacto)==true){
	if(valida(telef_contacto, 5)==true){
	if(valida(movil_contacto, 5)==true){
	if(valida(dir_contacto, 5)==true){

	ajax = objetoAjax();
	ajax.open("POST","../procesos/qryUpdateClientInfo.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				if(response==1){Sexy.alert("La informacion del cliente ha sido actualizada satisfactoriamente."); setTimeout(function() {window.location.reload();},3000);}
				if(response==0){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
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
	ajax.send("nomb_cliente="+nomb_cliente+"&rut_cliente="+rut_cliente+"&telef_cliente="+telef_cliente+"&giro_cliente="+giro_cliente+"&sigla_cliente="+sigla_cliente+"&dir_cliente="+dir_cliente+"&reg_cliente="+region_cliente+"&nomb_contacto="+nomb_contacto+"&cargo_contacto="+cargo_contacto+"&email_contacto="+email_contacto+"&telef_contacto="+telef_contacto+"&movil_contacto="+movil_contacto+"&dir_contacto="+dir_contacto+"&reg_contacto="+region_contacto+"&idtb="+idtb+"&ciudad_cliente="+ciudad_cliente+"&ciudad_contacto="+ciudad_contacto);

	}else{Sexy.error("El campo Direccion de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Movil de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Telefono de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Email de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Cargo de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nombre de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Direccion de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Giro de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Telefono de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo RUT de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nombre de cliente, no cumple los criterios de validacion.");}
}

function updateTerminalInfo1()
{
	var id	           = document.getElementById("id_terminal").value;
	var nro_serie  	   = document.getElementById("nro_serie").value;
	var serie_camara   = document.getElementById("serie_camara").value;
	var serie_mic	   = document.getElementById("serie_mic").value;
	var serie_cremoto  = document.getElementById("serie_cremoto").value;
	var ubicacion	   = document.getElementById("ubicacion").value;
	
	var modelo			= getSelectedValue("cmbModelos");
	var cliente			= getSelectedValue("cmbClientes");
	var contratos		= getSelectedValue("cmbContratos");
	var	divResultado = document.getElementById('resultado');
	var response;

	// --------------------------------------------------------------------------------
	if(valida(nro_serie, 5)==true){
	if(valida(serie_camara, 5)==true){
	if(valida(serie_mic, 5)==true){
	if(valida(serie_cremoto, 5)==true){
	if(contratos!= "vacio"){

	ajax = objetoAjax();
	ajax.open("POST","../procesos/qryUpdateTerminalInfo.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				if(response==1){Sexy.alert("La informacion del cliente ha sido actualizada satisfactoriamente."); setTimeout(function() {window.location.reload();},3000);}
				if(response==0){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
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
	ajax.send("id="+id+"&nro_serie="+nro_serie+"&serie_camara="+serie_camara+"&serie_mic="+serie_mic+"&serie_cremoto="+serie_cremoto+"&ubicacion="+ubicacion+"&modelo="+modelo+"&cliente="+cliente+"&contratos="+contratos);
	
	}else{Sexy.error("Asocie un contrato al terminal.");}
	}else{Sexy.error("El campo Nro de Serie C. Remoto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nro de Serie Microfono, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nro de Serie Camara, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nro de Serie, no cumple los criterios de validacion.");}
}

function updateTerminalInfo()
{
	var id	           = document.getElementById("id_terminal").value;
	var nomb_cliente   = document.getElementById("nomb_cliente").value;
	var rut_cliente    = document.getElementById("rut_cliente").value;
	var telef_cliente  = document.getElementById("telef_cliente").value;
	var giro_cliente   = document.getElementById("giro_cliente").value;
	var sigla_cliente   = document.getElementById("sigla_cliente").value;
	var dir_cliente    = document.getElementById("dir_cliente").value;
	var nomb_contacto  = document.getElementById("nomb_contacto").value;
	var cargo_contacto = document.getElementById("cargo_contacto").value;
	var email_contacto = document.getElementById("email_contacto").value;
	var telef_contacto = document.getElementById("telef_contacto").value;
	var movil_contacto = document.getElementById("movil_contacto").value;
	var dir_contacto   = document.getElementById("dir_contacto").value;
	
	var region_cliente	= getSelectedValue("region_cliente");
	var ciudad_cliente  = getSelectedValue("cmbCiudades_cliente");
	var region_contacto	= getSelectedValue("region_contacto");
	var ciudad_contacto	= getSelectedValue("cmbCiudades_contacto");
	
	var	divResultado = document.getElementById('resultado');
	var response;
	//--------------------------------------------------------------------------------
	if(valida(nomb_cliente, 5)==true){
	if(valida(rut_cliente, 9)==true){
	if(valida(telef_cliente, 5)==true){
	if(valida(giro_cliente, 5)==true){
	if(valida(dir_cliente, 5)==true){
	if(valida(nomb_contacto, 5)==true){
	if(valida(cargo_contacto, 5)==true){
	if(validaEmail(email_contacto)==true){
	if(valida(telef_contacto, 5)==true){
	if(valida(movil_contacto, 5)==true){
	if(valida(dir_contacto, 5)==true){

	ajax = objetoAjax();
	ajax.open("POST","../procesos/qryUpdateClientInfo.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				if(response==1){Sexy.alert("La informacion del cliente ha sido actualizada satisfactoriamente."); setTimeout(function() {window.location.reload();},3000);}
				if(response==0){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
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
	ajax.send("nomb_cliente="+nomb_cliente+"&rut_cliente="+rut_cliente+"&telef_cliente="+telef_cliente+"&giro_cliente="+giro_cliente+"&sigla_cliente="+sigla_cliente+"&dir_cliente="+dir_cliente+"&reg_cliente="+region_cliente+"&nomb_contacto="+nomb_contacto+"&cargo_contacto="+cargo_contacto+"&email_contacto="+email_contacto+"&telef_contacto="+telef_contacto+"&movil_contacto="+movil_contacto+"&dir_contacto="+dir_contacto+"&reg_contacto="+region_contacto+"&idtb="+idtb+"&ciudad_cliente="+ciudad_cliente+"&ciudad_contacto="+ciudad_contacto);

	}else{Sexy.error("El campo Direccion de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Movil de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Telefono de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Email de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Cargo de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nombre de contacto, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Direccion de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Giro de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Telefono de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo RUT de cliente, no cumple los criterios de validacion.");}
	}else{Sexy.error("El campo Nombre de cliente, no cumple los criterios de validacion.");}
}


function changeCombo(id, position)
{
	try{
		document.getElementById(id).selectedIndex=position;
	}catch(err){
		alert(err.message);
	}
}

function getNow()
{
	var currentTime = new Date();
	var day   = currentTime.getDate();
	var month = currentTime.getMonth() + 1;
	var year  = currentTime.getFullYear();
	var hour  = currentTime.getHours();
	var min   = currentTime.getMinutes();
	var secs  = currentTime.getSeconds();
	var date  = year+"-"+month+"-"+day+" "+hour+":"+min+":"+secs;
	
	return date;
}

function showMsg(msg)
{
   if (confirm(msg))  
    RefreshPage()
   return " "  
}

function RefreshPage()
{
	window.location.reload();
}

function showCommentsPopUp(id_ticket)
{
	//var stile = "top=10, left=10, width=600, height=800 status=no, menubar=no, toolbar=no scrollbar=no";
	var stile = "top=10, left=10, width=400, height=600 status=no, menubar=no, toolbar=no, location=no, resizable=no";
	var apri = "../procesos/qryCommentsPopUp.php"+"?"+"id_ticket="+id_ticket;
	window.open(apri, "", stile);
}

function nuevoTerminal()
{
	var divResultado   = document.getElementById("Resultado");
	var cmbModelos     = document.getElementById("cmbModelos");
	    indice         = cmbModelos.selectedIndex;
	    valor          = cmbModelos.options[indice].value;
		cmbModelos     = valor;
	
	var nserie         = document.getElementById("nserie").value;
	var nserie_camara  = document.getElementById("nserie_camara").value;
	var nserie_mic     = document.getElementById("nserie_mic").value;
	var nserie_cremoto = document.getElementById("nserie_cremoto").value;
	var ubicacion      = document.getElementById("ubicacion").value;
	var id_terminal    = document.getElementById("id_terminal");
	var response = "";
	
	if(valida(nserie,5)==true){
	if(valida(nserie_camara,5)==true){
	if(valida(nserie_mic,5)==true)	{
	if(valida(nserie_cremoto,5)==true) {
	if(valida(ubicacion,3)==true) {
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryNuevoTerminal.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					response = response.split("|");
					if(response[0]=="OK")
					{
						id_terminal.value = response[1];
						document.getElementById("btnNvoTerminal").disabled = true;
						document.getElementById("btnNvoContrato").disabled = false;
						
						Sexy.alert("El terminal ha sido agregado satisfactoriamente con ID: "+response[1]); 
					}
					if(response[0]=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
					if(response[0]=="ERROR NSERIE"){Sexy.error("El numero de serie ingresado, ya existe.");}
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
		ajax.send("modelo="+cmbModelos+"&nserie="+nserie+"&nserie_camara="+nserie_camara+"&nserie_mic="+nserie_mic+"&nserie_cremoto="+nserie_cremoto+"&ubicacion="+ubicacion);
	}else{Sexy.error("El campo Ubicacion, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo S/Number Control, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo S/Number Microfono, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo S/Number Camara, no cumple con los criterios de validacion.");}
	}else{Sexy.error("El campo S/Number Codec, no cumple con los criterios de validacion.");}
}

function loadComunasByRegion1()
{
	var divResultado = document.getElementById("divComunas1");
	var cmbRegiones  = document.getElementById("cmbRegiones_cliente");
	var indice       = cmbRegiones.selectedIndex;
	var id_region    = cmbRegiones.options[indice].value;

	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryLoadComunasByRegion.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_region="+id_region+"&cmbid=cmbComunas_cliente");
}

function loadComunasByRegion2()
{
	var divResultado = document.getElementById("divComunas2");
	var cmbRegiones  = document.getElementById("cmbRegiones_contacto");
	var indice       = cmbRegiones.selectedIndex;
	var id_region    = cmbRegiones.options[indice].value;

	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryLoadComunasByRegion.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_region="+id_region+"&cmbid=cmbComunas_contacto");
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

function ShowDivCmbTerminales()
{
	showDiv('DivCmbTerminales');
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

function buscarTerminal()
{
	var divResultado = document.getElementById("resultado");
	var nserie       = document.getElementById("nserie_srch").value;
	
	if(valida(nserie,5)==true)
	{
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qrySearchTerminal.php"+"?"+new Date().getTime(),true);
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
		ajax.send("nserie="+nserie);
	}else{
		Sexy.error("El campo S/N no es valido.");
	}
}

function EditTerminal()
{
	var divEditable  = document.getElementById("DatosTerminal");
	var divResultado = document.getElementById("Resultado");
	var nserie       = document.getElementById("nserie_srch").value;
	
	divResultado.innerHTML = "Editando...";

	ajax = objetoAjax();
	ajax.open("POST","../procesos/qryEditTerminal.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divEditable.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{divEditable.innerHTML = ajax.responseText;}
			else if(ajax.status==404)
			{
				divEditable.innerHTML = "La direccion AJAX no existe";
			}else{
				divEditable.innerHTML = "Error: ".ajax.status;
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("nserie="+nserie);
}

function nuevoContratoPolycom()
{
	var divResultado  = document.getElementById("Resultado");
	var id_terminal   = document.getElementById("id_terminal").value;
	var fecha_inicio  = document.getElementById("fecha_inicio").value;
	var fecha_termino = document.getElementById("fecha_termino").value;
	var descripcion   = document.getElementById("descripcion").value;
	
	if(id_terminal!=""){
	if(valida(fecha_inicio,4)==true){
	if(valida(fecha_termino,4)==true){
	if(valida(descripcion,4)==true){
		
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryNuevoContratoPolycom.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					if(response=="OK"){
						document.getElementById("btnNvoContrato").disabled = true;
						document.getElementById("btnAsociar").disabled = false;
						Sexy.alert("El contrato ha sido creado satisfactoriamente.");
					}
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
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
		ajax.send("fecha_inicio="+fecha_inicio+"&fecha_termino="+fecha_termino+"&descripcion="+descripcion+"&id_terminal="+id_terminal);
		
	}else{Sexy.error("El campo Descripcion, no cumple los criterios de validación.");}
	}else{Sexy.error("El campo Fecha Termino, no cumple los criterios de validación.");}
	}else{Sexy.error("El campo Fecha Inicio, no cumple los criterios de validación.");}
	}else{Sexy.error("Debe crear un terminal antes de crear el Contrato con Polycom.");}
}

function updateContrato()
{
	var idtb          		= document.getElementById("id_tb").value;
	var id_contrato   		= document.getElementById("id_contrato").value;
	var cliente       		= document.getElementById("cmbClientes");
	var indice        		= cliente.selectedIndex;
		cliente       		= cliente.options[indice].value;
	var sigla_cliente 		= document.getElementById("sigla_cliente").value;
	var cliente_final 		= document.getElementById("cliente_final").value;
	var sigla_cliente_final = document.getElementById("sigla_cliente_final").value;
	var vigente       		= document.getElementById("vigente");
		indice        		= vigente.selectedIndex;
		vigente       		= vigente.options[indice].value;
	var fecha_inicio  		= document.getElementById("f_inicio").value;
	var fecha_termino 		= document.getElementById("f_termino").value;
	var sla           		= document.getElementById("sla").value;
	var tipo          		= document.getElementById("cmbTipoContrato");
		indice        		= tipo.selectedIndex;
		tipo          		= tipo.options[indice].value;
		
	var divResultado        = document.getElementById("resultado");	
	
	if(valida(cliente_final,5)==true){
	if(valida(fecha_inicio,5)==true){
	if(valida(fecha_termino,5)==true){
	if(sla!=""){
	if(valida(sigla_cliente,3)==true){
	if(valida(sigla_cliente_final,3)==true){
	
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryUpdateContrato.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				// divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
					else{
						response = response.split("|");
						Sexy.alert("El contrato fue creado con ID: "+response[1]+"<br>Espere 5 segundos...");
						setTimeout(function() {window.location.reload();},5000);
					}
				}
				else if(ajax.status==404)
				{
					Sexy.error("La direccion AJAX no existe");
				}else{
					Sexy.error("Error: ".ajax.status);
				}
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("idtb="+idtb+"&id_contrato="+id_contrato+"&cliente="+cliente+"&sigla_cliente="+sigla_cliente+"&cliente_final="+cliente_final+"&sigla_cliente_final="+sigla_cliente_final+"&vigente="+vigente+"&fecha_inicio="+fecha_inicio+"&fecha_termino="+fecha_termino+"&sla="+sla+"&tipo_contrato="+tipo);
	}else{Sexy.error("El Campo Sigla Cliente Final no cumple con la validacion.");}	
	}else{Sexy.error("El Campo Sigla Cliente no cumple con la validacion.");}	
	}else{Sexy.error("El campo SLA no puede estar vacio");}
	}else{Sexy.error("Debe ingresar una fecha con formato valido.");}
	}else{Sexy.error("Debe ingresar una fecha con formato valido.");}
	}else{Sexy.error("El campo Cliente Final, no cumple con los criterios de validacion.");}

}

function updateContratoPolycom()
{
	var id_contrato = document.getElementById("hddn").value;
	var f_inicio    = document.getElementById("f_inicio").value;
	var f_termino   = document.getElementById("f_termino").value;
	var descripcion = document.getElementById("textfield").value;
	var divResultado = document.getElementById("resultado");
	
	if(valida(f_inicio,4)==true){
	if(valida(f_termino,4)==true){
	if(valida(descripcion,4)==true){

		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryUpdateContratoPolycom.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					//alert(response);
					if(response=="OK"){
						Sexy.alert("El contrato ha sido modificado satisfactoriamente.");
						setTimeout(function() {window.close();},3000);
					}
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
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
		ajax.send("fecha_inicio="+f_inicio+"&fecha_termino="+f_termino+"&descripcion="+descripcion+"&id_contrato="+id_contrato);
	
	}else{Sexy.error("El campo Descripcion, no cumple los criterios de validación.");}
	}else{Sexy.error("El campo Fecha Termino, no cumple los criterios de validación.");}
	}else{Sexy.error("El campo Fecha Inicio, no cumple los criterios de validación.");}
}

function UpdateTerminal()
{
	var divResultado  = document.getElementById("Resultado");
	var cmbClientes   = document.getElementById("cmbClientes");
	var indice        = cmbClientes.selectedIndex;
	var cliente       = cmbClientes.options[indice].value;
	
	var cmbTerminales = document.getElementById("cmbTerminales");
		indice        = cmbTerminales.selectedIndex;
	var modelo        = cmbTerminales.options[indice].value;
	
	var nserie         = document.getElementById("nserie").value;
	var nserie_camara  = document.getElementById("nserie_camara").value;
	var nserie_mic     = document.getElementById("nserie_mic").value;
	var nserie_cremoto = document.getElementById("nserie_cremoto").value;
	var ubicacion      = document.getElementById("ubicacion").value;
	var idtb           = document.getElementById("idtb").value;
	
	var response = "";
	
	if(valida(nserie,5)==true){
	if(valida(nserie_camara,5)==true){
	if(valida(nserie_mic,5)==true){
	if(valida(nserie_cremoto,5)==true){
	if(valida(ubicacion,5)==true){
		
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryUpdateTerminal.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					if(response=="OK"){Sexy.alert("La informacion del terminal ha sido actualizada satisfactoriamente."); setTimeout(function() {window.location.reload();},3000);}
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
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
		ajax.send("cliente="+cliente+"&modelo="+modelo+"&nserie="+nserie+"&nserie_camara="+nserie_camara+"&nserie_mic="+nserie_mic+"&nserie_cremoto="+nserie_cremoto+"&ubicacion="+ubicacion+"&idtb="+idtb);
		
	}else{Sexy.error("el campo Ubicacion, no cumple con los criterios de validacion");}
	}else{Sexy.error("el campo S/N Control, no cumple con los criterios de validacion");}
	}else{Sexy.error("el campo S/N Microfono, no cumple con los criterios de validacion");}
	}else{Sexy.error("el campo S/N Camara, no cumple con los criterios de validacion");}
	}else{Sexy.error("el campo S/N Codec, no cumple con los criterios de validacion");}
}


// TICKETS FUNCTIONS

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
		var modelo        = document.getElementById("modelo").value;
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
	if(validaEmail(email_contacto)==true){
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

function CrearNuveoTicketAdmin()
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
	var check           = document.getElementById("check").checked;
	
	if(check==true)
	{
		var id_terminal = 0;
	}else{
		var cmbUsuario   = document.getElementById("cmbTerminales");
		var indice       = cmbUsuario.selectedIndex;
		var valor        = cmbUsuario.options[indice].value;
		var id_terminal  = valor;
	}
	
	var modelo          = document.getElementById("modelo").value;
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
	if(valida(modelo,3)==true){
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
		ajax.send("fecha_creacion="+fecha_creacion+"&id_cliente="+id_cliente+"&nomb_cliente="+nomb_cliente+"&nomb_contacto="+nomb_contacto+"&telef_contacto="+telef_contacto+"&movil_contacto="+movil_contacto+"&email_contacto="+email_contacto+"&dir_contacto="+dir_contacto+"&id_terminal="+id_terminal+"&modelo_terminal="+modelo+"&nserie_terminal="+nserie_terminal+"&nserie_falla="+nserie_falla+"&detalle_falla="+detalle_falla);
	
	}else{Sexy.error("el campo Detalle de Falla, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Numero de Serie con Falla, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Numero de Serie Terminal, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Modelo, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Direccion Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Email Contacto, no cumple con los criterios de validacion.");	}
	}else{Sexy.error("el campo Movil Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Telefono Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Nombre Contacto, no cumple con los criterios de validacion.");}
	}else{Sexy.error("el campo Nombre Empresa, no cumple con los criterios de validacion.");}
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
				
					// divResultado.innerHTML = ajax.responseText;
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

function loadClientInfoByClientId()
{
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var valor        = cmbClientes.options[indice].value;
	var id_cliente   = valor;
	var divResultado = document.getElementById("InfoCliente");
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowTableClientInfo.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_cliente="+id_cliente);
}

function showTerminalesByClienteId()
{
	var divResultado  = document.getElementById("divInfoTerminal");
	var cmbTerminales = document.getElementById("cmbTerminales");
	var indice        = cmbTerminales.selectedIndex;
	var valor         = cmbTerminales.options[indice].value;
	var id_terminal   = valor;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowTableTerminalesInfo.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_terminal="+id_terminal);
}

function toggleEnable()
{
	var cmbTerminales = document.getElementById("cmbTerminales");
	
	if(cmbTerminales.disabled)
	{
		cmbTerminales.disabled = false;
		document.getElementById("modelo").disabled = true;
		document.getElementById("nserie_terminal").disabled = true;
	}else{
		cmbTerminales.disabled = true;
		document.getElementById("modelo").value = "";
		document.getElementById("modelo").disabled = false;
		document.getElementById("nserie_terminal").value = "";
		document.getElementById("nserie_terminal").disabled = false;
	}
}

function showTicketInfo()
{
	document.getElementById("Comentarios").innerHTML = "";
	
	var divResultado = document.getElementById("DatosTicket");
	var cmbTickets = document.getElementById("cmbTickets");
	var indice     = cmbTickets.selectedIndex;
	var valor      = cmbTickets.options[indice].value;
	var id_ticket  = valor;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowTicketInfo.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_ticket="+id_ticket);
}

function showTicketComments()
{
	var divResultado = document.getElementById("Comentarios");
	var cmbTickets = document.getElementById("cmbTickets");
	var indice     = cmbTickets.selectedIndex;
	var valor      = cmbTickets.options[indice].value;
	var id_ticket  = valor;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryShowTicketComments.php"+"?"+new Date().getTime(),true);
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
	ajax.send("id_ticket="+id_ticket);
}

function SendComment()
{
	var id_ticket = document.getElementById("id_ticket").value;
	var origen    = document.getElementById("origen").value;
	var comment   = document.getElementById("comment").value;
	var fecha     = document.getElementById("fecha").value;
	var divResultado = document.getElementById("ResultadoTicketComment");
	
	if(valida(comment, 5)==true){
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryInsertTicketComment.php"+"?"+new Date().getTime(),true);
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
		ajax.send("id_ticket="+id_ticket+"&origen="+origen+"&comment="+comment+"&fecha="+fecha);
	}else{alert("Debe escribir un comentario para enviar.")}
}

function InsertDetalleInterno(id_ticket)
{
	var divResultado = document.getElementById("Resultado");
	var detalle_interno = document.getElementById("detalle_interno").value;
	var response = "";
	
	if(valida(detalle_interno, 5)==true)
	{
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryInsertDetalleInterno.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					// se cambia el estado del ticket 
					if(response=="OK"){RevisarTicket(id_ticket); Sexy.alert("Detalle Interno guardado!");}
					if(response=="NO"){Sexy.error("No se pudo guardar el detalle.");}
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
		ajax.send("id_ticket="+id_ticket+"&detalle_interno="+detalle_interno);
	}else{Sexy.error("Debe ingresar el detalle para poder guardar");}
}

function RevisarTicket(id_ticket)
{
	var divResultado = document.getElementById("Resultado");
	var detalle_interno = document.getElementById("detalle_interno").value;
	var nuevoStatus  = 1;
	var response = "";
	
	if(valida(detalle_interno, 5)==true){
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryChangeStatusTicket.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					if(response=="OK"){Sexy.alert("Ticket en Revision."); setTimeout(function() {window.location.reload();},2000);}
					if(response=="NO"){Sexy.error("No se pudo cambiar el estado.");}
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
		ajax.send("id_ticket="+id_ticket+"&status="+nuevoStatus);
	}else{Sexy.error("Debe escribir un Detalle Interno para cambiar el estado.")}
}

function CerrarTicket(id_ticket)
{
	var divResultado = document.getElementById("Resultado");
	var detalle_interno = document.getElementById("detalle_interno").value;
	var nuevoStatus  = 2;
	var response = "";
	
	if(valida(detalle_interno, 5)==true){
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryChangeStatusTicket.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					if(response=="OK"){Sexy.alert("Ticket Cerrado."); setTimeout(function() {window.location.reload();},2000);}
					if(response=="NO"){Sexy.error("No se pudo cambiar el estado.");}
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
		ajax.send("id_ticket="+id_ticket+"&status="+nuevoStatus);
	}else{Sexy.error("Debe escribir un comentario para cambiar el estado.")}
}

function buscarTicket()
{
	var id_srch = document.getElementById("id_srch").value;
	var divResultado = document.getElementById("DatosTicket");
	
	if(valida(id_srch, 5)==true)
	{
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qrySearchTicket.php"+"?"+new Date().getTime(),true);
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
		ajax.send("id_ticket="+id_srch);
	}else{alert("Debe ingresar un ID para buscar.")}
}

function CopyClientName()
{
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var valor        = cmbClientes.options[indice].value;
	var text         = cmbClientes.options[indice].text;
	document.getElementById("cliente_final").value = text;
	
	document.getElementById("sigla_cliente_final").value = document.getElementById("sigla_cliente").value;
}

function asociaClienteATerminal()
{
	var divResultado = document.getElementById("Resultado");
	
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var id_cliente   = cmbClientes.options[indice].value;
	
	// var cmbTerminal  = document.getElementById("cmbTerminales");
		// indice       = cmbTerminal.selectedIndex;
	// var id_terminal  = cmbTerminal.options[indice].value;
	var id_terminal = document.getElementById("id_terminal").value;
	// alert(id_terminal);
	
	var cmbContrato  = document.getElementById("cmbContratos");
		indice       = cmbContrato.selectedIndex;
	var id_contrato  = cmbContrato.options[indice].value; 
	// alert(id_contrato);
	// alert(id_cliente);
	// alert(id_terminal);
	// alert(id_contrato);
	if(id_contrato!="vacio"){
			
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryAsociaClienteATerminal.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					// divResultado.innerHTML = response;
					// alert(respone);
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
					if(response=="OK"){Sexy.alert("El terminal fue asociado al cliente y al contrato satisfactoriamente.");setTimeout(function() {window.location.reload();},5000);}
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
		ajax.send("id_cliente="+id_cliente+"&id_terminal="+id_terminal+"&id_contrato="+id_contrato);
	}else{Sexy.error("El cliente no posee un contrato asociado");}	
}

function asociarTerminalContrato()
{
	var divResultado = document.getElementById("divResultado");
	
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var id_cliente   = cmbClientes.options[indice].value;
	
	var cmbTerminal  = document.getElementById("cmbTerminales");
		indice       = cmbTerminal.selectedIndex;
	var id_terminal  = cmbTerminal.options[indice].value;
	
	var cmbContrato  = document.getElementById("cmbContratos");
		indice       = cmbContrato.selectedIndex;
	var id_contrato  = cmbContrato.options[indice].value;
	
	//alert(id_cliente);	alert(id_terminal);	alert(id_contrato);
	if(id_terminal!="vacio"){
	if(id_contrato!="vacio"){

		//Sexy.alert("Perfect!");
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryAsociaTerminalContrato.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
			}
			if (ajax.readyState==4) {
				if(ajax.status==200)
				{
					response = ajax.responseText;
					if(response=="NO"){Sexy.error("Un error ha ocurrido en la transaccion. Intentelo nuevamente.");}
					if(response=="OK"){Sexy.alert("El terminal fue asociado al contrato satisfactoriamente.");setTimeout(function() {window.location.reload();},5000);}
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
		ajax.send("id_cliente="+id_cliente+"&id_terminal="+id_terminal+"&id_contrato="+id_contrato);

	}else{Sexy.error("El cliente no posee un contrato asociado");}
	}else{Sexy.error("El cliente no posee terminales asociados");}
	
}

function getSiglaByCliente()
{
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var id_cliente   = cmbClientes.options[indice].value;
	
	ajax = objetoAjax();
	ajax.open("POST","../procesos/qryGetSiglaByCliente.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				document.getElementById("sigla_cliente").value = response;
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("id_cliente="+id_cliente);
}

function CrearContrato()
{
	var divResultado     = document.getElementById("resultado");
	var cmbClientes      = document.getElementById("cmbClientes");
	var indice           = cmbClientes.selectedIndex;
	var cliente          = cmbClientes.options[indice].value;
	
	var cmbTipoContratos = document.getElementById("cmbTipoContratos");
		indice           = cmbTipoContratos.selectedIndex;
	var tipo_contrato    = cmbTipoContratos.options[indice].value;
	
	var cliente_final    = document.getElementById("cliente_final").value;
	var vigencia_si      = document.getElementById("Vigencia_0").checked;
	var vigencia_no      = document.getElementById("Vigencia_1").checked;
	var vigencia         = "";
	var fecha_inicio     = document.getElementById("fecha_inicio").value;
	var fecha_termino    = document.getElementById("fecha_termino").value;
	var sla              = document.getElementById("sla").value;
	var sigla_cliente    = document.getElementById("sigla_cliente").value;
	var sigla_cliente_final = document.getElementById("sigla_cliente_final").value;
	
	var response         = "";
	
	if(vigencia_si==true){vigencia = 1;}else{vigencia = 0;}
	if(valida(cliente_final,5)==true){
	if(valida(fecha_inicio,5)==true){
	if(valida(fecha_inicio,5)==true){
	if(sla!=""){
	if(valida(sigla_cliente,3)==true){
	if(valida(sigla_cliente_final,3)==true){
		
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qryNuevoContrato.php"+"?"+new Date().getTime(),true);
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
						Sexy.alert("El contrato fue creado con ID: "+response[1]+"<br>Espere 5 segundos...");
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
		ajax.send("cliente="+cliente+"&cliente_final="+cliente_final+"&vigente="+vigencia+"&fecha_inicio="+fecha_inicio+"&fecha_termino="+fecha_termino+"&sla="+sla+"&tipo_contrato="+tipo_contrato+"&sigla_cliente="+sigla_cliente+"&sigla_cliente_final="+sigla_cliente_final);
	}else{Sexy.error("El Campo Sigla Cliente Final no cumple con la validacion.");}	
	}else{Sexy.error("El Campo Sigla Cliente no cumple con la validacion.");}	
	}else{Sexy.error("El campo SLA no puede estar vacio");}
	}else{Sexy.error("Debe ingresar una fecha con formato valido.");}
	}else{Sexy.error("Debe ingresar una fecha con formato valido.");}
	}else{Sexy.error("El campo Cliente Final, no cumple con los criterios de validacion.");}
}

function loadContratosByCliente()
{
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var valor        = cmbClientes.options[indice].value;
	var text         = cmbClientes.options[indice].text;
	var divResultado = document.getElementById("DIVcontratos");
	
	ajax = objetoAjax();
	ajax.open("POST","../procesos/qryShowContratos.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				divResultado.innerHTML = ajax.responseText;
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
	ajax.send("id_cliente="+valor);
}

function loadContratosByCliente1()
{	
	var cmbClientes  = document.getElementById("cmbClientes");
	var indice       = cmbClientes.selectedIndex;
	var valor        = cmbClientes.options[indice].value;
	var text         = cmbClientes.options[indice].text;
	var divResultado = document.getElementById("DIVcontratos1");
	
	ajax = objetoAjax();
	ajax.open("POST","../procesos/qryShowContratos1.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
		}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				divResultado.innerHTML = ajax.responseText;
				document.getElementById("update").disabled = false;
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
	ajax.send("id_cliente="+valor);
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

function getSelectedValue(cmb)
{
	var cmb    = document.getElementById(cmb);
	var indice = cmb.selectedIndex;
	return cmb.options[indice].value;
}

function Edit_PopUp(id_contrato)
{
	window.open("../procesos/Edit_PopUp.php?id="+id_contrato, "Edit Form", "width=350,height=450,scrollbars=NO,dependent=YES,resizable=NO")
}

function EditPolycom_PopUp(id_contrato)
{
	window.open("../procesos/EditPolycom_PopUp.php?id="+id_contrato, "Edit Form", "width=450,height=225,scrollbars=NO,dependent=YES,resizable=NO")
}

function PopUp_Contrato(id)
{
	window.open("../procesos/PopUp_Contrato.php?id="+id, "Info Contrato", "width=300,height=400,scrollbars=NO,dependent=YES,resizable=NO")
}

function contar(input) {
//Comprobamos que no pase de 300 caracteres y si pasa, que borre los sobrantes
if (input.value.length >= 300) {
input.value = input.value.substring(0,300);
}
//alamacenamos el resto
var resto = 300 - input.value.length;
 
//imprimimos los caracteres restantes en el span
var final=document.getElementById('letras');
final.innerHTML=resto+"/300 caracteres";
 
}

function imprime_clientes() {
var bName = navigator.appName;
var bVer = parseFloat(navigator.appVersion);
var contenido = document.getElementById("imprimir").innerHTML;
ventana=window.open("/print.php","ventana","width=900,height=500");
ventana.document.open();
ventana.document.write('<html><head><link rel="stylesheet" type="text/css" media="all" href="http://localhost:8888/trajesguzman/wp-content/themes/trajesguzman/style.css" /></head><body style="background-color: #FFFFFF" id="print"><div class="page-id-533">');
ventana.document.write(contenido);
ventana.document.write('</div></body></html>');
ventana.document.close();
ventana.print();
ventana.focus();
}

function buscarContrato()
{
	var divResultado = document.getElementById("imprimir");
	var nserie       = document.getElementById("nserie_srch").value;
	
	if(valida(nserie,5)==true)
	{
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qrySearchContrato.php"+"?"+new Date().getTime(),true);
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
		ajax.send("nserie="+nserie);
	}else{
		Sexy.error("El campo S/N no es valido.");
	}
}

function buscarContrato2()
{
	var divResultado  = document.getElementById("imprimir");
	var cliente       = document.getElementById("cliente_srch").value;
	
	if(valida(cliente,1)==true)
	{
		ajax = objetoAjax();
		ajax.open("POST","../procesos/qrySearchContrato2.php"+"?"+new Date().getTime(),true);
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
		ajax.send("cliente="+cliente);
	}else{
		Sexy.error("El campo  no es valido.");
	}
}

function changeSearchMode2(divA, divB)
{
	var divAa = document.getElementById(divA);
	var divBb = document.getElementById(divA);
	
	if(document.getElementById('op2').checked)
	{
		hideDiv(divA);
		showDiv(divB);

	}else{
		hideDiv(divB);
		showDiv(divA);
	
	}
}

function changeSearchMode3(divA, divB, divC)
{
	var divAa = document.getElementById(divA);
	var divBb = document.getElementById(divA);
	var divCc = document.getElementById(divA);
	
	if(document.getElementById('op2').checked)
	{
		hideDiv(divA);
		showDiv(divB);
		hideDiv(divC);

	}else if(document.getElementById('op3').checked){
		hideDiv(divB);
		hideDiv(divA);
		showDiv(divC);
	
	}else{
		hideDiv(divB);
		showDiv(divA);
		hideDiv(divC);
		
	}
}