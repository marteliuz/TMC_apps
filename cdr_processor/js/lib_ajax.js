//@date        : 2014/08/23
//@autor       : Marteliuz
//@Modified by : Paulo Ossandon
//@Date        : 2014/12/24

// JavaScript Document

function objetoAjax() {
    xmlhttp=false;
    this.AjaxFailedAlert = "Su navegador no soporta las funcionalidades de este sitio y podría experimentarlo de forma diferente a la que fue pensada. Por favor habilite javascript en su navegador para verlo normalmente.\n";
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

function checklogin(){
	divResultado = document.getElementById('response');
	username = document.getElementById("username").value;
	password = document.getElementById("password").value;
	
	if (username && password != ""){
		ajax=objetoAjax();
		//Called file ckecklogin.php - extract response
		ajax.open("POST","../cdr_processor/procedures/checklogin.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==1){
				divResultado.innerHTML = '<img src="../cdr_processor/resources/loading.gif">';
			}
			if (ajax.readyState==4) {
				if(ajax.status==200){
				
					response = ajax.responseText;
					if(response=="YES"){
						//Called file selectafile.php
						window.location = "../cdr_processor/procedures/selectafile.php";
					}
					if(response=="NO"){
						alertify.error("Lo siento, no reconozco quien eres");
						document.getElementById("username").value="";
						document.getElementById("password").value="";
						document.getElementById("username").focus();
					}
					
				}else if(ajax.status==404){
					alertify.log("La direccion AJAX no existe");
				}else{
					alertify.log("Error: ".ajax.status);
				}
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("username="+username+"&password="+password);
	}else{
		alertify.error("Mmmm... no podrás ingresar si no me dices quien eres");
		document.getElementById("username").value="";
		document.getElementById("password").value="";
		document.getElementById("username").focus();
	}
}

function clearDivs(){
	document.getElementById('controls').value = "";
	document.getElementById('table').value = "";
}

// MODIFIED
function PromptCliente() {
	alertify.prompt("¿Cual es el nombre del cliente?", function (e, str) {
		if (e) {
			str = str.trim();
			if (str != null && str.length >= 3 && str.length <= 20) {
				// comprobacion de existencia
				ajax=objetoAjax();
				ajax.open("POST","../procedures/qryCheckCliente.php",true);
				ajax.onreadystatechange=function() {
					if (ajax.readyState==4) {
						if(ajax.status==200){
							response = ajax.responseText;
							//alert(response);
							if (response=="YES") {
                                showBasicStats();
							} else if (response=="NOT"){
								showBasicStats();
								Promptlogo();
							}else{
                                  alertify.error(response);
							};

						}else if(ajax.status==404){
							alertify.log("La direccion AJAX no existe");
						}else{
							alertify.log("Error: ".ajax.status);
						}
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("str="+str);
			} else {
				alertify.error("Ingrese un nombre valido");
				PromptCliente();
			}
		} else {
			alertify.confirm("¿Esta seguro que desea cancelar? <br> Va a perder los datos de este reporte... ", function (e) {
				if (e) {
					// user clicked "ok"
					location.reload();//Recargar la pagina
				} else {
					// user clicked "cancel"
					PromptCliente();
				}
			});
		}
	}, "");
}

//MODIFIED
function Promptlogo(){
	window.open("../procedures/pop.php", " _blank", "toolbar=no, location=no, scrollbars=no, resizable=no, top=200, left=200, width=900, height=400");
}

//MODIFIED
function goBack(){
	window.close();
}

//MODIFIED
function uploadImg(){
	
		divResultado = document.getElementById('response');
		
		upload_input = document.getElementById('archivo');
		file = upload_input.files[0];
		
		ajax=objetoAjax();
		// Called file uploap.php for load file cvs
		ajax.open("POST","../procedures/uploadImg.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				if(ajax.status==200){
					response = ajax.responseText;
					if(response=="OK"){
						goBack();
					}
					if(response=="ErrorType"){
						alertify.error("Vamos! Si sabes que archivo necesito...");
					}
					if(response=="ErrorSize"){
						alertify.error("El archivo es muy pequeño para procesarlo...");
					}

					}else if(ajax.status==404){
					alertify.log("La direccion AJAX no existe");
				}else{
					alertify.log("Error: ".ajax.status);
				}
			}
		}
		ajax.setRequestHeader("Cache-Control", "no-cache");
		ajax.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		ajax.setRequestHeader("X-File-Name", file.name);

		ajax.send(file);
}

function upload(){
	alertify.log("Dame un minuto...");
	
	document.getElementById('controls').innerHTML = "";
	document.getElementById('table').innerHTML = "";
	
	divResultado = document.getElementById('response');
	
	upload_input = document.getElementById('archivo');
	file = upload_input.files[0];
	
	ajax=objetoAjax();
	//Called file uploap.php for load file cvs
	ajax.open("POST","../procedures/upload.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			if(ajax.status==200){
			
				response = ajax.responseText;
				
				if(response=="OK"){

					PromptCliente();
		
					alertify.log("Ya hice lo que tenía que hacer, continuemos...");

				}

				if(response=="ErrorType"){
					alertify.error("Vamos! Si sabes que archivo necesito...");
				}
				if(response=="ErrorSize"){
					alertify.error("El archivo es muy pequeño para procesarlo...");
				}

				}else if(ajax.status==404){
				alertify.log("La direccion AJAX no existe");
			}else{
				alertify.log("Error: ".ajax.status);
			}
		}
	}
	ajax.setRequestHeader("Cache-Control", "no-cache");
	ajax.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	ajax.setRequestHeader("X-File-Name", file.name);

	ajax.send(file);
}

//MODIFIED
function showClienteMinsal(){
	alertify.log("comprobacion de existencia...");
	divResultado = document.getElementById('response');
	upload_input = document.getElementById('archivo');
	file = upload_input.files[0];
	ajax = objetoAjax();
	ajax.open("POST","../procedures/qryCheckClienteMinsal.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			if(ajax.status==200){
				response = ajax.responseText;
				//alert(response);
				    if (response=="10") 
				    {
				    	showControlsRep();
				    } 
				    else if (response=="20")
				    {
						showControls();
					}else{
                                  alertify.error(response);
                        };
			}else if(ajax.status==404){
				alertify.log("La direccion AJAX no existe");
			}else{
				alertify.log("Error: ".ajax.status);
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}

function showControls(){
	divResultado = document.getElementById('controls');	
	ajax=objetoAjax();
	//Called file showControls.php 
	ajax.open("POST","../procedures/showControls.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			if(ajax.status==200){
				response = ajax.responseText;
				divResultado.innerHTML = response;
			}else if(ajax.status==404){
				alertify.log("La direccion AJAX no existe");
			}else{
				alertify.log("Error: ".ajax.status);
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}

//MODIFIED
function showControlsRep(){
	divResultado = document.getElementById('controlsReport');	
	ajax=objetoAjax();
	//Called file showControls.php 
	ajax.open("POST","../procedures/showControlsReport.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			if(ajax.status==200){
				response = ajax.responseText;
				divResultado.innerHTML = response;
			}else if(ajax.status==404){
				alertify.log("La direccion AJAX no existe");
			}else{
				alertify.log("Error: ".ajax.status);
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}

//MODIFIED
function showCars(){
	alertify.log("Generando reporte...");
	window.open("reportMinsal.php");
}

//MODIFIED
function refresh(){
	location.reload();
}

function showTable(){
	alertify.log("Preparando la tabla <br>esto podría tardar un poquito...");
	divResultado = document.getElementById('table');
	ajax=objetoAjax();
	//Called file showTable.php
	ajax.open("POST","../procedures/showTable.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			if(ajax.status==200){		
				response = ajax.responseText;
				divResultado.innerHTML = response;				
			}else if(ajax.status==404){
				alertify.log("La direccion AJAX no existe");
			}else{
				alertify.log("Error: ".ajax.status);
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}

function showBasicStats(){
	alertify.log("Calculando las estadísticas...");
	divResultado = document.getElementById('table');
	
	ajax=objetoAjax();
	//Called file showControls.php
	//ajax.open("POST","/cdr_processor/cdr_processor/dash.php"+"?"+new Date().getTime(),true);
	ajax.open("POST","../procedures/basic_stats.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = '<img src="../resources/loading.gif">';
		}
		if (ajax.readyState==4) {
			if(ajax.status==200){
			
				response = ajax.responseText;
				divResultado.innerHTML = response;
				showClienteMinsal();
				
			}else if(ajax.status==404){
				alertify.log("La direccion AJAX no existe");
			}else{
				alertify.log("Error: ".ajax.status);
			}
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(null);
}

function showReport(){
	alertify.log("Generando reporte...");
	window.open("report.php");
}

function showLog(){
	window.open("../file_storage/cdr_process.log", "_blank", "toolbar=no, location=no, scrollbars=yes, resizable=no, top=200, left=200, width=900, height=400");
}

function logout(){
	alertify.confirm("¿Ya se va? :( ", function (e) {
	if (e) {
		ajax=objetoAjax();
		//Called file logout.php
		ajax.open("POST","../procedures/logout.php"+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				if(ajax.status==200){
				
					response = ajax.responseText;
					if(response=="OK"){
						window.location ="../index.php";
					}
					if(response=="ERROR"){ 	
						alertify.error("D'oh! Algo sucedió...");
					}
				}
			}
		}
			ajax.send(null);
		}
	});
}

function saluda(){
	
today = new Date() 
if(today.getMinutes() < 10){ 
pad = "0"} 
else 
pad = ""; 
if((today.getHours() >=6) && (today.getHours() <=9)){ 
	return "Buenos días "; 
} 
if((today.getHours() >=10) && (today.getHours() <=11)){ 
	return "Buenos días "; 
} 
if((today.getHours() >=12) && (today.getHours() <=19)){ 
	return "Buenas tardes "; 
} 
if((today.getHours() >=20) && (today.getHours() <=23)){ 
	return "Buenas noches "; 
} 
if((today.getHours() >=0) && (today.getHours() <=3)){ 
	return "Buenas noches "; 
} 
if((today.getHours() >=4) && (today.getHours() <=5)){ 
	return "Buenas noches "; 
} 
}

function clearDB(){
	divResultado = document.getElementById('response');
	ajax=objetoAjax();
	//Called file clearBD.php
	ajax.open("POST","../procedures/clearDB.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = '<img src="../resources/loading.gif">';
		}
		if (ajax.readyState==4) {
			if(ajax.status==200){
				response = ajax.responseText;
				divResultado.innerHTML = response;
			}else if(ajax.status==404){
				divResultado.innerHTML = "La direccion AJAX no existe";
			}else{
				divResultado.innerHTML = "Error: ".ajax.status;
			}
		}
	}
	ajax.send(null);
}