// JavaScript Document

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

function Step1()
{
	var inv		 		= document.getElementById("inv");
	var inv_usado 		= document.getElementById("inv_usado");
	var editar_inv 		= document.getElementById("modificar_inv");
	var editar_inv_us 	= document.getElementById("modificar_inv_us");
	var control 		= document.getElementById("control");
	var ver_inv			= document.getElementById("ver_inv");
	var ver_inv_us 		= document.getElementById("ver_inv_us");
	var bus				= document.getElementById("bus");
	var modificar		= document.getElementById("modificar");
	var bus_hist		= document.getElementById("bus_hist");
	
	if(inv.checked){
		Inventario();
		ClearSteps();
		}
	if(inv_usado.checked){
		Inv_Usado();
		ClearSteps();
		}
	if(editar_inv.checked){
		Editar_Inv();
		ClearSteps();
		}
	if(editar_inv_us.checked){
		Editar_Inv_Us();
		ClearSteps();
		}
	if(control.checked){
		Control();
		ClearSteps();
	    }
	if(ver_inv.checked){
		Ver_Inv();
		ClearSteps();
		}
	if(ver_inv_us.checked){
		Ver_Inv_Us();
		ClearSteps();
		}
	if(bus.checked){
		Bus();
		ClearSteps();
	    }
	if(modificar.checked){
	Modificar();
	ClearSteps();
	}
	
	if(bus_hist.checked){
		Bus_Hist();
		ClearSteps();
	    }
}

function Inventario()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","inventario.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Inv_Usado()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","inv_usado.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Editar_Inv()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","editar_inv.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Editar_Inv_Us()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","editar_inv_us.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Control()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","control_inicio.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Ver_Inv()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","ver_inv.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Ver_Inv_Us()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","ver_inv_us.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Bus()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","busqueda_avanzada.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}

function Bus_Hist()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","busqueda_hist_avanzada.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}

function Modificar()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","modificar_inv_us.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function ClearSteps()
{
	var divStep1 = document.getElementById("Step1");
	divStep1.innerHTML = "";
	var divStep3 = document.getElementById("Step3");
	divStep3.innerHTML = "";
}

function imprime() {
var bName = navigator.appName;
var bVer = parseFloat(navigator.appVersion);
var contenido = document.getElementById("Step1").innerHTML;
ventana=window.open("/print.php","ventana","width=900,height=500");
ventana.document.open();
ventana.document.write('<html><head><link rel="stylesheet" type="text/css" media="all" href="http://localhost:8888/trajesguzman/wp-content/themes/trajesguzman/style.css" /></head><body style="background-color: #FFFFFF" id="print"><div class="page-id-533">');
ventana.document.write(contenido);
ventana.document.write('</div></body></html>');
ventana.document.close();
ventana.print();
ventana.focus();
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




function Step2()
{
	var ver_inv1		= document.getElementById("ver_inv1");
	var ver_inv_us1 	= document.getElementById("ver_inv_us1");
	var bus1			= document.getElementById("bus1");
	var bus_hist1		= document.getElementById("bus_hist1");
	
	if(ver_inv1.checked){
		Ver_Inv1();
		ClearSteps();
		}
	if(ver_inv_us1.checked){
		Ver_Inv_Us1();
		ClearSteps();
		}
	if(bus1.checked){
		Bus1();
		ClearSteps();
		}
	if(bus_hist1.checked){
		Bus_Hist1();
		ClearSteps()
		}
		
}
function Ver_Inv1()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","ver_inv_visitante.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Ver_Inv_Us1()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","ver_inv_us_visitante.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Bus1()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","busqueda_avanzada_visitante.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Bus_Hist1()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","busqueda_hist_avanzada_visitante.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function eleccion(){
	
	var tipo 		= document.getElementById("tipo");
	var indice3     = tipo.selectedIndex;
	tipo	 		= tipo.options[indice3].value;
	var despacho 	= document.getElementById("despacho").value;
	var serie 		= document.getElementById("serie").value;
	serie.trim();
	var nombre 		= document.getElementById("nombre").value;
	var categoria	= document.getElementById("categoria");
	var indice      = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
	var marca 		= document.getElementById("marca");
	var indice1     = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
	var moneda 		= document.getElementById("moneda");
	var indice4     = moneda.selectedIndex;
	moneda	 		= moneda.options[indice4].value;
	var valor 		= document.getElementById("valor").value;
	var fecha 		= document.getElementById("dateArrival").value;
	var descripcion = document.getElementById("textarea").value;
	var lugar 		= document.getElementById("lugar");
	var indice2     = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
	var ingreso		= document.getElementById("ingreso").value;
	var codigo		= document.getElementById("codigo").value;
	
	var divResultado = document.getElementById('resultado');
	
	if(despacho!=""){
		if(nombre!=""){
			if(fecha!=""){
				if(lugar>0){
					if(ingreso!=""){	
					ajax=objetoAjax();
					ajax.open("POST","agregar_inv.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								//divResultado.innerHTML = response;
								
								alert(response);
									
									
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
					ajax.send("tipo="+tipo+"&despacho="+despacho+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&moneda="+moneda+"&valor="+valor+"&fecha="+fecha+"&descripcion="+descripcion+"&lugar="+lugar+"&ingreso="+ingreso+"&codigo="+codigo);	
							
				}else{
					alert("Ingrese Nombre del Encargado")
				}	
				}else{
					alert("Ingrese Lugar donde se almacenará el producto")
				}
			}else{
				alert("Ingrese Fecha")
			}
		}else{
			alert("Ingrese Nombre del Producto")
		}
	}else{
		alert("Ingrese Número de Guía de Despacho");
	}
}

function retirar(){
	
	var despacho		= document.getElementById("despacho").value;
	var factura			= document.getElementById("factura").value;
	var cliente			= document.getElementById("cliente");
	var indice          = cliente.selectedIndex;
		cliente 		= cliente.options[indice].value;
	var fecha			= document.getElementById("dateArrival").value;
	var encargadosalida	= document.getElementById("encargadosalida").value;
	var categoria	 	= document.getElementById("categoria");
	var indice2         = categoria.selectedIndex;
		categoria 		= categoria.options[indice2].value;
	var nombre			= document.getElementById("nombre").value;	
	var despacho1		= document.getElementById("despacho1").value;
	var serie			= document.getElementById("serie").value;
	
	var where="";
	
	if (categoria>0){
		if(where==""){
				 where= "WHERE Categoría = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoría =  '"+categoria+"'";
                }
	}

	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+nombre+"%"+"'"+"|| '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+nombre+"%"+"'"+"|| '"+"%"+nombre+"%"+"'";
                }
	}
	
	if (despacho1!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho LIKE '"+despacho1+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho LIKE '"+despacho1+"%"+"'";
                }
	}
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'";
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}
	
	var divResultado = document.getElementById('Step3');
	
	if(despacho!=""){
		if(fecha!=""){
			if(encargadosalida!=""){
					ajax=objetoAjax();
					ajax.open("POST","retirar_inv.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("despacho="+despacho+"$factura="+factura+"&cliente="+cliente+"&fecha="+fecha+"&encargadosalida="+encargadosalida+"&categoria="+categoria+"&despacho1="+despacho1+"&nombre="+nombre+"&where="+where);	

				}else{
					alert("Ingrese Nombre del Encargado")
				}
			}else{
				alert("Ingrese Fecha")
			}
	}else{
		alert("Ingrese Número de Guía de Despacho");
	}
}
function control1(){
	
	var encargado1	 	= document.getElementById("encargado1").value;
	var fecha1			= document.getElementById("fecha1").value;
	var check			= document.getElementById("checkbox");
	var lugar 			= document.getElementById("lugar");
	var indice	     	= lugar.selectedIndex;
	lugar	 			= lugar.options[indice].value;

	
	var divResultado = document.getElementById('Step3');
	
	
			
			if(encargado1!=""){
				if(fecha1!=""){
					if(lugar>0){
					if(check.checked) {
		correcto=1;}
		else {window.location="inicio1.php";}
					ajax=objetoAjax();
						ajax.open("POST","control.php"+"?"+new Date().getTime(),true);
							ajax.onreadystatechange=function() {
								if (ajax.readyState==1){
								divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								//divResultado.innerHTML = response;
								if (response =="OK"){
									alert("Los datos fueron ingresados correctamente");
									limpiar1();}
									else{
										alert("Se produjo un error al ingresar los datos");
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
					ajax.send("correcto="+correcto+"&encargado1="+encargado1+"&fecha1="+fecha1+"&lugar="+lugar);	
			}else{
			alert("Ingrese Bodega donde se encuentra producto");
		}
	}else{
		alert("Ingrese Fecha");
	}
}else{
	alert("Ingrese Nombre Encargado");
		}
	function limpiar1(){
	
	document.getElementById("encargado1").value= "";
	document.getElementById("fecha1").value= "";
	document.getElementById("checkbox").checked = false;
	}
}

function convertirAFecha(fecha){
var n=fecha.split("/");

day = n[0];  
month = n[1];  
year = n[2];

var fecha_final=year+"-"+month+"-"+day;



return fecha_final;
}
	
function busqueda(){
	
	var tipoguia	 	= document.getElementById("tipo");
	var indice1         = tipoguia.selectedIndex;
		tipoguia	 	= tipoguia.options[indice1].value;	
	var despacho		= document.getElementById("despacho1").value;
	var serie		 	= document.getElementById("serie").value;
	var nombre		 	= document.getElementById("nombre").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;	
	var marca 			= document.getElementById("marca");
	var indice2         = marca.selectedIndex;
	marca	 			= marca.options[indice2].value;
	var fecha			= document.getElementById("dateArrival").value;
	var tipobodega		= document.getElementById("lugar");
	var indice3         = tipobodega.selectedIndex;
		tipobodega	 	= tipobodega.options[indice3].value;
	var ingreso			= document.getElementById("ingreso").value;
	
	var where="";
	
	

	if (tipoguia>0){
	if(where==""){
				 where= "WHERE Tipo_Guia ='"+tipoguia+"'";
				  }else{
                   where = where+" AND Tipo_Guia ='"+tipoguia+"'";
                }
	}
	
	if (despacho!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho LIKE '"+despacho+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho LIKE '"+despacho+"%"+"'";
                }
	}
	
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'" ;
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}
	
	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+"%"+nombre+"%"+"'"
                }
	}
	
	if (categoria>0){
		
	if(where==""){
				 where= "WHERE Categoría = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoría =  '"+categoria+"'";
                }
	}
	
	if (marca>0){
		if(where==""){
				 where= "WHERE Marca = '"+marca+"'";
				  }else{
                   where = where+" AND Marca = '"+marca+"'";
                }
	}
	
	if (fecha!=""){
		if(where==""){
				 where= "WHERE Fecha_Ingreso = '"+convertirAFecha(fecha)+"'";
				  }else{
                   where = where+" AND Fecha_Ingreso = '"+convertirAFecha(fecha)+"'";
                }
	}

	if (tipobodega>0){
	if(where==""){
				 where= "WHERE Lugar = '"+tipobodega+"'";
				  }else{
                   where = where+" AND Lugar = '"+tipobodega+"'";
                }
	}
	if (ingreso!=""){
		if(where==""){
				 where= "WHERE Encargado_Ingreso LIKE '"+"%"+ingreso+"%"+"'";
				  }else{
                   where = where+" AND Encargado_Ingreso LIKE '"+"%"+ingreso+"%"+"'";
                }
	}
	
	var divResultado = document.getElementById('Step3');
	ajax=objetoAjax();
	ajax.open("POST","busqueda.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send("tipoguia="+tipoguia+"&despacho="+despacho+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&fecha="+fecha+"&tipobodega="+tipobodega+"&ingreso="+ingreso+"&where="+where);
								

}

function busqueda_visita(){
	
	var tipoguia	 	= document.getElementById("tipo");
	var indice1         = tipoguia.selectedIndex;
		tipoguia	 	= tipoguia.options[indice1].value;	
	var despacho		= document.getElementById("despacho1").value;
	var serie		 	= document.getElementById("serie").value;
	var nombre		 	= document.getElementById("nombre").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;	
	var marca 			= document.getElementById("marca");
	var indice2         = marca.selectedIndex;
	marca	 			= marca.options[indice2].value;
	var fecha			= document.getElementById("dateArrival").value;
	var tipobodega		= document.getElementById("lugar");
	var indice3         = tipobodega.selectedIndex;
		tipobodega	 	= tipobodega.options[indice3].value;
	var ingreso			= document.getElementById("ingreso").value;
	
	var where="";
	
	

	if (tipoguia>0){
	if(where==""){
				 where= "WHERE Tipo_Guia ='"+tipoguia+"'";
				  }else{
                   where = where+" AND Tipo_Guia ='"+tipoguia+"'";
                }
	}
	
	if (despacho!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho LIKE '"+despacho+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho LIKE '"+despacho+"%"+"'";
                }
	}
	
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'" ;
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}
	
	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+"%"+nombre+"%"+"'"
                }
	}
	
	if (categoria>0){
		
	if(where==""){
				 where= "WHERE Categoría = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoría =  '"+categoria+"'";
                }
	}
	
	if (marca>0){
		if(where==""){
				 where= "WHERE Marca = '"+marca+"'";
				  }else{
                   where = where+" AND Marca = '"+marca+"'";
                }
	}
	
	if (fecha!=""){
		if(where==""){
				 where= "WHERE Fecha_Ingreso = '"+convertirAFecha(fecha)+"'";
				  }else{
                   where = where+" AND Fecha_Ingreso = '"+convertirAFecha(fecha)+"'";
                }
	}

	if (tipobodega>0){
	if(where==""){
				 where= "WHERE Lugar = '"+tipobodega+"'";
				  }else{
                   where = where+" AND Lugar = '"+tipobodega+"'";
                }
	}
	if (ingreso!=""){
		if(where==""){
				 where= "WHERE Encargado_Ingreso LIKE '"+"%"+ingreso+"%"+"'";
				  }else{
                   where = where+" AND Encargado_Ingreso LIKE '"+"%"+ingreso+"%"+"'";
                }
	}
	
	var divResultado = document.getElementById('Step3');
	ajax=objetoAjax();
	ajax.open("POST","busqueda_visitante.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send("tipoguia="+tipoguia+"&despacho="+despacho+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&fecha="+fecha+"&tipobodega="+tipobodega+"&ingreso="+ingreso+"&where="+where);
								

}

function busqueda1(){
	
	var tipoguia	 	= document.getElementById("tipo");
	var indice1         = tipoguia.selectedIndex;
		tipoguia	 	= tipoguia.options[indice1].value;	
	var despacho		= document.getElementById("despacho1").value;
	var despacho1		= document.getElementById("despacho2").value;
	var factura			= document.getElementById("factura").value;
	var serie		 	= document.getElementById("serie").value;
	var nombre		 	= document.getElementById("nombre").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;	
	var marca 			= document.getElementById("marca");
	var indice2         = marca.selectedIndex;
		marca	 		= marca.options[indice2].value;
	var fecha			= document.getElementById("dateArrival").value;
	var tipobodega		= document.getElementById("lugar");
	var indice3         = tipobodega.selectedIndex;
		tipobodega	 	= tipobodega.options[indice3].value;
	var ingreso			= document.getElementById("ingreso").value;
	var fecha1			= document.getElementById("dateArrival1").value;
	var ingreso1		= document.getElementById("ingreso1").value
	var cliente			= document.getElementById("cliente");
	var indice4         = cliente.selectedIndex;
		cliente 		= cliente.options[indice4].value;	
	
	var where="";
	
	

	if (tipoguia>0){
	if(where==""){
				 where= "WHERE Tipo_Guia ='" +tipoguia+"'";
				  }else{
                   where = where+" AND Tipo_Guia ='" +tipoguia+"'";
                }
	}
	
	if (despacho!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho LIKE '"+despacho+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho LIKE '"+despacho+"%"+"'";
                }
	}
	if (despacho1!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho_Retiro LIKE '"+despacho1+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho_Retiro LIKE '"+despacho1+"%"+"'";
                }
	}
	
	if (factura!=""){
		if(where==""){
				 where= "WHERE Factura_Venta LIKE '"+factura+"%"+"'";
				  }else{
                   where = where+" AND Factura_Venta LIKE '"+factura+"%"+"'";
                }
	}
	
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'";
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}
	
	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+"%"+nombre+"%"+"'";
                }
	}
	
	if (categoria>0){
		
	if(where==""){
				 where= "WHERE Categoria = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoria =  '"+categoria+"'";
                }
	}
	
	if (marca>0){
		if(where==""){
				 where= "WHERE Marca = '"+marca+"'";
				  }else{
                   where = where+" AND Marca = '"+marca+"'";
                }
	}
	
	if (fecha!=""){
		if(where==""){
				 where= "WHERE Fecha_Ingreso = '"+convertirAFecha(fecha)+"'";
				  }else{
                   where = where+" AND Fecha_Ingreso = '"+convertirAFecha(fecha)+"'";
                }
	}

	if (tipobodega>0){
	if(where==""){
				 where= "WHERE Lugar = '"+tipobodega+"'";
				  }else{
                   where = where+" AND Lugar = '"+tipobodega+"'";
                }
	}
	if (ingreso!=""){
		if(where==""){
				 where= "WHERE Encargado_Ingreso LIKE '"+"%"+ingreso+"%"+"'";
				  }else{
                   where = where+" AND Encargado_Ingreso LIKE '"+"%"+ingreso+"%"+"'";
                }
	}
	if (fecha1!=""){
		if(where==""){
				 where= "WHERE Fecha_Salida = '"+convertirAFecha(fecha1)+"'";
				  }else{
                   where = where+" AND Fecha_Salida = '"+convertirAFecha(fecha1)+"'";
                }
	}
	
	if (ingreso1!=""){
		if(where==""){
				 where= "WHERE Encargado_Salida LIKE '"+"%"+ingreso1+"%"+"'";
				  }else{
                   where = where+" AND Encargado_Salida LIKE '"+"%"+ingreso1+"%"+"'";
                }
	}
	if (cliente>0){
		if(where==""){
				 where= "WHERE Cliente = '"+cliente+"'";
				  }else{
                   where = where+" AND Cliente = '"+cliente+"'";
                }
	}
	var divResultado = document.getElementById('Step3');
	ajax=objetoAjax();
	ajax.open("POST","busqueda_hist.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send("tipoguia="+tipoguia+"&despacho="+despacho+"&despacho1="+despacho1+"&factura="+factura+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&fecha="+fecha+"&tipobodega="+tipobodega+"&ingreso="+ingreso+"&fecha1="+fecha1+"&ingreso1="+ingreso1+"&cliente="+cliente+"&where="+where);
								

}

function busqueda1_visita(){
	
	var tipoguia	 	= document.getElementById("tipo");
	var indice1         = tipoguia.selectedIndex;
		tipoguia	 	= tipoguia.options[indice1].value;	
	var despacho		= document.getElementById("despacho1").value;
	var despacho1		= document.getElementById("despacho2").value;
	var factura			= document.getElementById("factura").value;
	var serie		 	= document.getElementById("serie").value;
	var nombre		 	= document.getElementById("nombre").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;	
	var marca 			= document.getElementById("marca");
	var indice2         = marca.selectedIndex;
	marca	 			= marca.options[indice2].value;
	var fecha			= document.getElementById("dateArrival").value;
	var tipobodega		= document.getElementById("lugar");
	var indice3         = tipobodega.selectedIndex;
		tipobodega	 	= tipobodega.options[indice3].value;
	var ingreso			= document.getElementById("ingreso").value;
	var fecha1			= document.getElementById("dateArrival1").value;
	var ingreso1		= document.getElementById("ingreso1").value
	var cliente			= document.getElementById("cliente");
	var indice4         = cliente.selectedIndex;
		cliente 		= cliente.options[indice4].value;	
	
	var where="";
	
	

	if (tipoguia>0){
	if(where==""){
				 where= "WHERE Tipo_Guia ='" +tipoguia+"'";
				  }else{
                   where = where+" AND Tipo_Guia ='" +tipoguia+"'";
                }
	}
	
	if (despacho!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho LIKE '"+despacho+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho LIKE '"+despacho+"%"+"'";
                }
	}
	if (despacho1!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho_Retiro LIKE '"+despacho1+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho_Retiro LIKE '"+despacho1+"%"+"'";
                }
	}
	
	if (factura!=""){
		if(where==""){
				 where= "WHERE Factura_Venta LIKE '"+factura+"%"+"'";
				  }else{
                   where = where+" AND Factura_Venta LIKE '"+factura+"%"+"'";
                }
	}
	
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'";
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}
	
	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+"%"+nombre+"%"+"'";
                }
	}
	
	if (categoria>0){
		
	if(where==""){
				 where= "WHERE Categoria = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoria =  '"+categoria+"'";
                }
	}
	
	if (marca>0){
		if(where==""){
				 where= "WHERE Marca = '"+marca+"'";
				  }else{
                   where = where+" AND Marca = '"+marca+"'";
                }
	}
	
	if (fecha!=""){
		if(where==""){
				 where= "WHERE Fecha_Ingreso = '"+convertirAFecha(fecha)+"'";
				  }else{
                   where = where+" AND Fecha_Ingreso = '"+convertirAFecha(fecha)+"'";
                }
	}

	if (tipobodega>0){
	if(where==""){
				 where= "WHERE Lugar = '"+tipobodega+"'";
				  }else{
                   where = where+" AND Lugar = '"+tipobodega+"'";
                }
	}
	if (ingreso!=""){
		if(where==""){
				 where= "WHERE Encargado_Ingreso LIKE '"+"%"+ingreso+"%"+"'";
				  }else{
                   where = where+" AND Encargado_Ingreso LIKE '"+"%"+ingreso+"%"+"'";
                }
	}
	if (fecha1!=""){
		if(where==""){
				 where= "WHERE Fecha_Salida = '"+convertirAFecha(fecha1)+"'";
				  }else{
                   where = where+" AND Fecha_Salida = '"+convertirAFecha(fecha1)+"'";
                }
	}
	
	if (ingreso1!=""){
		if(where==""){
				 where= "WHERE Encargado_Salida LIKE '"+"%"+ingreso1+"%"+"'";
				  }else{
                   where = where+" AND Encargado_Salida LIKE '"+"%"+ingreso1+"%"+"'";
                }
	}
	if (cliente>0){
		if(where==""){
				 where= "WHERE Cliente LIKE '"+cliente+"'";
				  }else{
                   where = where+" AND Cliente LIKE '"+cliente+"'";
                }
	}
	var divResultado = document.getElementById('Step3');
	ajax=objetoAjax();
	ajax.open("POST","busqueda_hist_visitante.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send("tipoguia="+tipoguia+"&despacho="+despacho+"&despacho1="+despacho1+"&factura="+factura+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&fecha="+fecha+"&tipobodega="+tipobodega+"&ingreso="+ingreso+"&fecha1="+fecha1+"&ingreso1="+ingreso1+"&cliente="+cliente+"&where="+where);
								

}

function Step4(){
	
	var inv2		 	= document.getElementById("inv2");
	var inv_usado2	 	= document.getElementById("inv_usado2");

	if(inv2.checked){
		Inventario2();
		ClearSteps1();
		}
	if(inv_usado2.checked){
		Inv_Usado2();
		ClearSteps1();
	}
}
function Inventario2()
{
	var divResultado = document.getElementById('Step4');
                
	ajax=objetoAjax();
	ajax.open("POST","inventario_control.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function Inv_Usado2()
{
	var divResultado = document.getElementById('Step4');
                
	ajax=objetoAjax();
	ajax.open("POST","inv_usado_control.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send();	
}
function ClearSteps1()
{
	var divStep5 = document.getElementById("Step5");
	divStep5.innerHTML = "";
}

function seleccion() {
	var grupo 			= document.getElementsByName("chckbx");
	var nro_guia		= document.getElementById("despacho").value;
	var factura			= document.getElementById("factura").value;
	var cliente			= document.getElementById("cliente");
	var indice2         = cliente.selectedIndex;
		cliente 		= cliente.options[indice2].value;
	var f_salida 		= document.getElementById("dateArrival").value;
	var encargado 		= document.getElementById("encargadosalida").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;
	
	for (i = 0; lcheck = grupo[i]; i++) {
        if (lcheck.checked) {
            //alert(lcheck.value);
			//Ajax, envio de parametros
			
			ajax=objetoAjax();
			ajax.open("POST","agregar_inv_us.php"+"?"+new Date().getTime(),true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==1){
					divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
					}
				if (ajax.readyState==4) {
					if(ajax.status==200)
					{
						response = ajax.responseText;
						//divResultado.innerHTML = response;
						alert(response);
						
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
			ajax.send("nro_guia="+nro_guia+"&factura="+factura+"&cliente="+cliente+"&f_salida="+f_salida+"&encargado="+encargado+"&categoria="+categoria+"&id="+lcheck.value);	
		
        }
    }
}


function retirar_control(){
	
	var despacho		= document.getElementById("despacho").value;
	var factura			= document.getElementById("factura").value;
	var cliente			= document.getElementById("cliente");
	var indice          = cliente.selectedIndex;
		cliente 		= cliente.options[indice].value;
	var fecha			= document.getElementById("dateArrival").value;
	var encargadosalida	= document.getElementById("encargadosalida").value;
	var encargado1		= document.getElementById("encargado1").value;
	var fecha1			= document.getElementById("fecha1").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;
	var nombre			= document.getElementById("nombre").value;	
	var despacho1		= document.getElementById("despacho1").value;
	var serie			= document.getElementById("serie").value;
	
	var where="";
	
	if (categoria>0){
		if(where==""){
				 where= "WHERE Categoría = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoría =  '"+categoria+"'";
                }
	}

	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+"%"+nombre+"%"+"'";
                }
	}
	
	if (despacho1!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho LIKE '"+despacho1+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho LIKE '"+despacho1+"%"+"'";
                }
	}
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'";
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}
	
	var divResultado = document.getElementById('Step5');
	
	if(despacho!=""){
		if(fecha!=""){
			if(encargadosalida!=""){
				if(encargado1!=""){
					if(fecha1!=""){
					ajax=objetoAjax();
					ajax.open("POST","retirar_inv_control.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("despacho="+despacho+"&factura="+factura+"&cliente="+cliente+"&fecha="+fecha+"&encargadosalida="+encargadosalida+"&encargado1="+encargado1+"&fecha1="+fecha1+"&categoria="+categoria+"&despacho1="+despacho1+"&nombre="+nombre+"&where="+where);	
									}else{
							alert("Ingrese Fecha de Control");
								}
							}else{
						alert("Ingrese Nombre del Encargado de Control");
							}
				}else{
					alert("Ingrese Nombre del Encargado")
				}
			}else{
				alert("Ingrese Fecha")
			}
	}else{
		alert("Ingrese Número de Guía de Despacho");
	}
}
function eleccion_control(){
	
	var tipo 		= document.getElementById("tipo");
	var indice3     = tipo.selectedIndex;
	tipo	 		= tipo.options[indice3].value;
	var despacho 	= document.getElementById("despacho").value;
	var serie 		= document.getElementById("serie").value;
	var nombre 		= document.getElementById("nombre").value;
	var categoria	= document.getElementById("categoria");
	var indice      = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
	var marca 		= document.getElementById("marca");
	var indice1     = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
	var moneda 		= document.getElementById("moneda");
	var indice4     = moneda.selectedIndex;
	moneda	 		= moneda.options[indice4].value;
	var valor 		= document.getElementById("valor").value;
	var fecha 		= document.getElementById("dateArrival").value;
	var descripcion = document.getElementById("textarea").value;
	var lugar 		= document.getElementById("lugar");
	var indice2     = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
	var ingreso		= document.getElementById("ingreso").value;
	var encargado1		= document.getElementById("encargado1").value;
	var fecha1			= document.getElementById("fecha1").value;
	
	var divResultado = document.getElementById('resultado');
	
	if(despacho!=""){
		if(nombre!=""){
			if(fecha!=""){
				if(ingreso!=""){
					if(lugar!="0"){
						if(encargado1!=""){
							if(fecha1!=""){
					ajax=objetoAjax();
					ajax.open("POST","agregar_inv_control.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								//divResultado.innerHTML = response;
								if (response =="OK"){
									alert("Los datos fueron ingresados correctamente");
									
									}
									else{
										alert("Se produjo un error al ingresar los datos");
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
					ajax.send("tipo="+tipo+"&despacho="+despacho+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&moneda="+moneda+"&valor="+valor+"&fecha="+fecha+"&descripcion="+descripcion+"&lugar="+lugar+"&ingreso="+ingreso+"&encargado1="+encargado+"&fecha1="+fecha1);	
								}else{
							alert("Ingrese Fecha de Control");
								}
							}else{
						alert("Ingrese Nombre del Encargado de Control");
							}
							}else{
					alert("Ingrese Lugar donde se almacenará el producto")
				}
				}else{
					alert("Ingrese Nombre del Encargado")
				}
			}else{
				alert("Ingrese Fecha")
			}
		}else{
			alert("Ingrese Nombre del Producto")
		}
	}else{
		alert("Ingrese Número de Guía de Despacho");
	}
}
function seleccion_control() {
	var grupo 			= document.getElementsByName("chckbx");
	var nro_guia		= document.getElementById("despacho").value;
	var factura			= document.getElementById("factura").value;
	var cliente			= document.getElementById("cliente");
	var indice2         = cliente.selectedIndex;
		cliente 		= cliente.options[indice2].value;
	var f_salida 		= document.getElementById("dateArrival").value;
	var encargado 		= document.getElementById("encargadosalida").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;
	
	for (i = 0; lcheck = grupo[i]; i++) {
        if (lcheck.checked) {
            //alert(lcheck.value);
			//Ajax, envio de parametros
			
			ajax=objetoAjax();
			ajax.open("POST","agregar_inv_us_control.php"+"?"+new Date().getTime(),true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==1){
					divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
					}
				if (ajax.readyState==4) {
					if(ajax.status==200)
					{
						response = ajax.responseText;
						alert(response);
									
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
			ajax.send("nro_guia="+nro_guia+"&factura="+factura+"&cliente="+cliente+"&f_salida="+f_salida+"&encargado="+encargado+"&categoria="+categoria+"&id="+lcheck.value);	
		
        }
    }
}
function modificar_inv_us(){
	
	var fecha			= document.getElementById("dateArrival").value;
	var encargadoingreso= document.getElementById("encargadoingreso").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;
	var nombre			= document.getElementById("nombre").value;	
	var despacho1		= document.getElementById("despacho1").value;
	var serie			= document.getElementById("serie").value;
	
	
	var where="";
	
	if (categoria>0){
		if(where==""){
				 where= "WHERE Categoria = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoria = '"+categoria+"'";
                }
	}

	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+"%"+nombre+"%"+"'";
                }
	}
	
	if (despacho1!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho_Retiro LIKE '"+despacho1+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho_Retiro LIKE '"+despacho1+"%"+"'";
                }
	}
	
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'";
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}
	
	var divResultado = document.getElementById('Step3');
	
		if(fecha!=""){
			if(encargadoingreso!=""){
					ajax=objetoAjax();
					ajax.open("POST","retirar_inv_us.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("fecha="+fecha+"&encargadoingreso="+encargadoingreso+"&categoria="+categoria+"&despacho1="+despacho1+"&nombre="+nombre+"&where="+where);	

				}else{
					alert("Ingrese Nombre del Encargado")
				}
			}else{
				alert("Ingrese Fecha")
			}
}

function seleccion1() {
	var grupo 			= document.getElementsByName("chckbx");
	var f_salida 		= document.getElementById("dateArrival").value;
	var encargado 		= document.getElementById("encargadoingreso").value;
	var categoria	 	= document.getElementById("categoria");
	var indice          = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;
	
	for (i = 0; lcheck = grupo[i]; i++) {
        if (lcheck.checked) {
            //alert(lcheck.value);
			//Ajax, envio de parametros
			
			ajax=objetoAjax();
			ajax.open("POST","re_agregar_inv.php"+"?"+new Date().getTime(),true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==1){
					divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
					}
				if (ajax.readyState==4) {
					if(ajax.status==200)
					{
						response = ajax.responseText;
									alert(response);
									
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
			ajax.send("f_salida="+f_salida+"&encargado="+encargado+"&categoria="+categoria+"&id="+lcheck.value);	
		
        }
    }
}

function poponload(id){
	
window.open("modificar_inv_hist.php?id="+id, "Modificar","status = 1, height = 660, width = 660, scrollbars=1, resizable = 0" );
			
				
}

function editar() {
	
	var id	 		= document.getElementById("id").value;
	var tipo 		= document.getElementById("tipo");
	var indice3     = tipo.selectedIndex;
	tipo	 		= tipo.options[indice3].value;
	var guia 		= document.getElementById("guia").value;
	var guia1 		= document.getElementById("guia1").value;
	var factura 	= document.getElementById("factura").value;
	var serie 		= document.getElementById("serie").value;
	var nombre 		= document.getElementById("nombre").value;
	var categoria	= document.getElementById("categoria");
	var indice      = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
	var marca 		= document.getElementById("marca");
	var indice1     = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
	var moneda 		= document.getElementById("moneda");
	var indice4     = moneda.selectedIndex;
	moneda	 		= moneda.options[indice4].value;
	var valor 		= document.getElementById("valor").value;
	var fecha 		= document.getElementById("fecha").value;
	var descripcion = document.getElementById("descripcion").value;
	var lugar 		= document.getElementById("lugar");
	var indice2     = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
	var encargado 	= document.getElementById("encargado").value;
	var encargado1 	= document.getElementById("encargado1").value;
	var fecha1		= document.getElementById("fecha1").value;
	var fecha2		= document.getElementById("fecha2").value;
	var encargado2 	= document.getElementById("encargado2").value;
	var cliente 	= document.getElementById("cliente");
	var indice5     = cliente.selectedIndex;
	cliente	 		= cliente.options[indice5].value;
	
	
				
					ajax=objetoAjax();
					ajax.open("POST","modificar.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								//divResultado.innerHTML = response;
								alert(response);
								window.location.reload();
							
									
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
					ajax.send("id="+id+"&tipo="+tipo+"&guia="+guia+"&guia1="+guia1+"&factura="+factura+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&moneda="+moneda+"&valor="+valor+"&fecha="+fecha+"&descripcion="+descripcion+"&lugar="+lugar+"&encargado="+encargado+"&encargado1="+encargado1+"&fecha1="+fecha1+"&fecha2="+fecha2+"&encargado2="+encargado2+"&cliente="+cliente);	
	

}

function poponload1(id){
	
window.open("modificar_inv.php?id="+id, "Modificar","status = 1, height = 550, width = 450, scrollbars=1, resizable = 0" );
			
				
}


function editar1() {
	
	var id	 		= document.getElementById("id").value;
	var tipo 		= document.getElementById("tipo");
	var indice3     = tipo.selectedIndex;
	tipo	 		= tipo.options[indice3].value;
	var guia 		= document.getElementById("guia").value;
	var serie 		= document.getElementById("serie").value;
	var nombre 		= document.getElementById("nombre").value;
	var categoria	= document.getElementById("categoria");
	var indice      = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
	var marca 		= document.getElementById("marca");
	var indice1     = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
	var moneda 		= document.getElementById("moneda");
	var indice4     = moneda.selectedIndex;
	moneda	 		= moneda.options[indice4].value;
	var valor 		= document.getElementById("valor").value;
	var fecha 		= document.getElementById("fecha").value;
	var descripcion = document.getElementById("descripcion").value;
	var lugar 		= document.getElementById("lugar");
	var indice2     = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
	var encargado 	= document.getElementById("encargado").value;
	var encargado1 	= document.getElementById("encargado1").value;
	var fecha1 		= document.getElementById("fecha1").value;

	
					ajax=objetoAjax();
					ajax.open("POST","modificar1.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								//divResultado.innerHTML = response;
								alert(response);
								window.location.reload();
							
									
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
					ajax.send("id="+id+"&tipo="+tipo+"&guia="+guia+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&moneda="+moneda+"&valor="+valor+"&fecha="+fecha+"&descripcion="+descripcion+"&lugar="+lugar+"&encargado="+encargado+"&encargado1="+encargado1+"&fecha1="+fecha1);	

}

function poponload2(id){
	
window.open("modificar_inv_control.php?id="+id, "Modificar","status = 1, height = 550, width = 450, scrollbars=1, resizable = 0" );
			
}

function editar2() {
	
	var id	 		= document.getElementById("id").value;
	var tipo 		= document.getElementById("tipo");
	var indice3     = tipo.selectedIndex;
	tipo	 		= tipo.options[indice3].value;
	var guia 		= document.getElementById("guia").value;
	var serie 		= document.getElementById("serie").value;
	var nombre 		= document.getElementById("nombre").value;
	var categoria	= document.getElementById("categoria");
	var indice      = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
	var marca 		= document.getElementById("marca");
	var indice1     = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
	var moneda 		= document.getElementById("moneda");
	var indice4     = moneda.selectedIndex;
	moneda	 		= moneda.options[indice4].value;
	var valor 		= document.getElementById("valor").value;
	var fecha 		= document.getElementById("fecha").value;
	var descripcion = document.getElementById("descripcion").value;
	var lugar 		= document.getElementById("lugar");
	var indice2     = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
	var encargado 	= document.getElementById("encargado").value;
	var encargado1 	= document.getElementById("encargado1").value;
	var fecha1 		= document.getElementById("fecha1").value;

	
					ajax=objetoAjax();
					ajax.open("POST","modificar2.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								//divResultado.innerHTML = response;
								alert(response);
								window.location.reload();
							
									
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
					ajax.send("id="+id+"&tipo="+tipo+"&guia="+guia+"&serie="+serie+"&nombre="+nombre+"&categoria="+categoria+"&marca="+marca+"&moneda="+moneda+"&valor="+valor+"&fecha="+fecha+"&descripcion="+descripcion+"&lugar="+lugar+"&encargado="+encargado+"&encargado1="+encargado1+"&fecha1="+fecha1);	

}


function filtrar (){
var categoria	 	= document.getElementById("categoria");
var indice          = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
var marca 			= document.getElementById("marca");
var indice1         = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
var lugar 			= document.getElementById("lugar");
var indice2         = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
var cliente		 	= document.getElementById("cliente");
var indice3         = cliente.selectedIndex;
	cliente 		= cliente.options[indice3].value;	
	
	
	
	var divResultado = document.getElementById('Step1');
	
ajax=objetoAjax();
					ajax.open("POST","ver_inv_us_filtro.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("categoria="+categoria+"&marca="+marca+"&lugar="+lugar+"&cliente="+cliente);	

}

function filtrar_visita (){
var categoria	 	= document.getElementById("categoria");
var indice          = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
var marca 			= document.getElementById("marca");
var indice1         = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
var lugar 			= document.getElementById("lugar");
var indice2         = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
var cliente		 	= document.getElementById("cliente");
var indice3         = cliente.selectedIndex;
	cliente 		= cliente.options[indice3].value;	
	
	
	
	var divResultado = document.getElementById('Step1');
	
ajax=objetoAjax();
					ajax.open("POST","ver_inv_us_filtro_visitante.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("categoria="+categoria+"&marca="+marca+"&lugar="+lugar+"&cliente="+cliente);	

}

function filtrar1 (){
var categoria	 	= document.getElementById("categoria");
var indice          = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
var marca 			= document.getElementById("marca");
var indice1         = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
var lugar 			= document.getElementById("lugar");
var indice2         = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
	
	
	var divResultado = document.getElementById('Step1');
	
ajax=objetoAjax();
					ajax.open("POST","ver_inv_filtro.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("categoria="+categoria+"&marca="+marca+"&lugar="+lugar);	

}
function filtrar1_visita (){
var categoria	 	= document.getElementById("categoria");
var indice          = categoria.selectedIndex;
	categoria 		= categoria.options[indice].value;
var marca 			= document.getElementById("marca");
var indice1         = marca.selectedIndex;
	marca	 		= marca.options[indice1].value;
var lugar 			= document.getElementById("lugar");
var indice2         = lugar.selectedIndex;
	lugar	 		= lugar.options[indice2].value;
	
	
	var divResultado = document.getElementById('Step1');
	
ajax=objetoAjax();
					ajax.open("POST","ver_inv_filtro_visitante.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("categoria="+categoria+"&marca="+marca+"&lugar="+lugar);	

}
function seleccion_editar_inv (){
	var categoria	 	= document.getElementById("categoria");
	var indice	        = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;
	var nombre			= document.getElementById("nombre").value;	
	var despacho		= document.getElementById("despacho").value;
	var lugar	 		= document.getElementById("lugar");
	var indice1	        = lugar.selectedIndex;
		lugar 			= lugar.options[indice1].value;
	var serie			= document.getElementById("serie").value;		
		
	var where="";
	
	if (categoria>0){
		if(where==""){
				 where= "WHERE Categoría = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoría =  '"+categoria+"'";
                }
	}

	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+"%"+nombre+"%"+"'";
                }
	}
	
	if (despacho!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho LIKE '"+despacho+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho LIKE '"+despacho+"%"+"'";
                }
	}
	
	if (lugar>0){
		if(where==""){
				 where= "WHERE Lugar = '"+lugar+"'";
				  }else{
                   where = where+" AND Lugar =  '"+lugar+"'";
                }
	}
	
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'";
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}

	
	var divResultado = document.getElementById('Step3');
	ajax=objetoAjax();
					ajax.open("POST","ver_editar_inv.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("despacho="+despacho+"&categoria="+categoria+"&nombre="+nombre+"&where="+where);	
}

function seleccion_editar_inv_us (){
	var categoria	 	= document.getElementById("categoria");
	var indice	        = categoria.selectedIndex;
		categoria 		= categoria.options[indice].value;
	var nombre			= document.getElementById("nombre").value;	
	var despacho		= document.getElementById("despacho").value;
	var serie			= document.getElementById("serie").value;	
	
	var where="";
	
	if (categoria>0){
		if(where==""){
				 where= "WHERE Categoria = '"+categoria+"'";
				  }else{
                   where = where+" AND Categoria =  '"+categoria+"'";
                }
	}

	if (nombre!=""){
		if(where==""){
				 where= "WHERE Nombre LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" AND Nombre LIKE '"+"%"+nombre+"%"+"'";
                }
	}
	
	if (despacho!=""){
		if(where==""){
				 where= "WHERE Guia_Despacho_Retiro LIKE '"+despacho+"%"+"'";
				  }else{
                   where = where+" AND Guia_Despacho_Retiro LIKE '"+despacho+"%"+"'";
                }
	}
	if (serie!=""){
		if(where==""){
				 where= "WHERE Nro_Serie LIKE '"+serie+"'";
				  }else{
                   where = where+" AND Nro_Serie LIKE '"+serie+"'";
                }
	}
	
	var divResultado = document.getElementById('Step3');
	ajax=objetoAjax();
					ajax.open("POST","ver_editar_inv_us.php"+"?"+new Date().getTime(),true);
					ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								response = ajax.responseText;
								divResultado.innerHTML = response;
									
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
					ajax.send("despacho="+despacho+"&categoria="+categoria+"&nombre="+nombre+"&where="+where);	
}

function busqueda_cliente(){
	
	var nombre		 	= document.getElementById("nombre_cliente").value;
	var rut			 	= document.getElementById("rut_cliente").value;

	
	var where="";
	
	if (nombre!=""){
		if(where==""){
				 where= "WHERE Clientes LIKE '"+"%"+nombre+"%"+"'";
				  }else{
                   where = where+" OR Clientes LIKE '"+"%"+nombre+"%"+"'";
                }
	}
	
	if (rut!=""){
		if(where==""){
				 where= "WHERE Rut_Clientes LIKE '"+rut+"'" ;
				  }else{
                   where = where+" OR Rut_Clientes LIKE '"+rut+"'";
                }
	}
	
	
	var divResultado = document.getElementById('clientes');
	ajax=objetoAjax();
	ajax.open("POST","ver_clientes2.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
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
	ajax.send("nombre="+nombre+"&rut="+rut+"&where="+where);
								

}

function contar(input) {
//Comprobamos que no pase de 200 caracteres y si pasa, que borre los sobrantes
if (input.value.length >= 200) {
input.value = input.value.substring(0,200);
}
//alamacenamos el resto
var resto = 200 - input.value.length;
 
//imprimimos los caracteres restantes en el span
var final=document.getElementById('letras');
final.innerHTML=resto+"/200 caracteres";
 
}



function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789,";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
   if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}


function completar(){
	
	var codigo 	= document.getElementById("codigo").value;
	
	// alert(codigo);
var divResultado = document.getElementById('form');
	ajax=objetoAjax();
	ajax.open("POST","lectura_codigo.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				divResultado.innerHTML = response;
				var splitt = response.split(";");
				
				document.getElementById('nombre').value = splitt[0];
				document.getElementById('categoria').value = splitt[1];;
				document.getElementById('marca').value = splitt[2];
				document.getElementById('moneda').value = splitt[3];
				document.getElementById('valor').value = splitt[4];
				
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
	ajax.send("codigo="+codigo);
								

}