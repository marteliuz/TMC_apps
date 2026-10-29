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

function seguimiento(id){
	
	var situacion_cotizacion		= document.getElementById("situacion_cotizacion"+id);
	var indice    					= situacion_cotizacion.selectedIndex;
	situacion_cotizacion	 		= situacion_cotizacion.options[indice].value;
	var situacion_orden_compra 		= document.getElementById("situacion_orden_compra"+id);
	var indice1    					= situacion_orden_compra.selectedIndex;
	situacion_orden_compra	 		= situacion_orden_compra.options[indice1].value;
	var situacion_factura			= document.getElementById("situacion_factura"+id);
    var indice2    					= situacion_factura.selectedIndex;
	situacion_factura	 			= situacion_factura.options[indice2].value;
	var grupo 						= document.getElementsByName("fact");
	
	var divResultado = document.getElementById('resultado');
	
	for (i = 0; lcheck = grupo[i]; i++) {
  
	ajax=objetoAjax();
	ajax.open("POST","seguimiento_2.php"+"?"+new Date().getTime(),true);
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
	ajax.send("situacion_cotizacion="+situacion_cotizacion+"&situacion_orden_compra="+situacion_orden_compra+"&situacion_factura="+situacion_factura+"&id="+id+"&check="+lcheck.value);	
	}				
}

function facturar(){
	
	var grupo 			= document.getElementsByName("fact");
	
	for (i = 0; lcheck = grupo[i]; i++) {
        if (lcheck.checked) {
           alert("Ha checkeado, si ud guarda la situación automáticamente se enviará un correo al área de facturación para que comience a realizar factura del proyecto");

			}
		}
	}	
		
function filtrar(){
	
	var rut			 	= document.getElementById("rut");
	var indice1         = rut.selectedIndex;
		rut			 	= rut.options[indice1].value;	
	var cliente		 	= document.getElementById("cliente");
	var indice          = cliente.selectedIndex;
		cliente 		= cliente.options[indice].value;	
	var vendedor 		= document.getElementById("vendedor");
	var indice2         = vendedor.selectedIndex;
		vendedor	 	= vendedor.options[indice2].value;
	var situacion 			= document.getElementById("situacion");
	var indice3         	= situacion.selectedIndex;
		situacion	 		= situacion.options[indice3].value;
	var situacion_compra	= document.getElementById("situacion_compra");
	var indice4	        	= situacion_compra.selectedIndex;
		situacion_compra	= situacion_compra.options[indice4].value;
	var situacion_factura	= document.getElementById("situacion_factura");
	var indice5	        	= situacion_factura.selectedIndex;
		situacion_factura	= situacion_factura.options[indice5].value;
	
	var where="";
	
	if (rut!=""){
	if(where==""){
				 where= "WHERE Rut_Empresa ='"+rut+"'";
				  }else{
                   where = where+" OR Rut_Empresa ='"+rut+"'";
                }
	}
	
	if (cliente!=""){
		if(where==""){
				 where= "WHERE Nombre_Empresa ='"+cliente+"'";
				  }else{
                   where = where+" OR Nombre_Empresa ='"+cliente+"'";
                }
	}
	
	if (vendedor!=""){
		if(where==""){
				 where= "WHERE Vendedor ='"+vendedor+"'" ;
				  }else{
                   where = where+" AND Vendedor ='"+vendedor+"'";
                }
	}
	
	if (situacion>0){
		if(where==""){
				 where= "WHERE Situacion_Cotizacion ='"+situacion+"'" ;
				  }else{
                   where = where+" AND Situacion_Cotizacion ='"+situacion+"'";
                }
	}
	
	if (situacion_compra>0){
		if(where==""){
				 where= "WHERE Situacion_Orden_Compra ='"+situacion_compra+"'" ;
				  }else{
                   where = where+" AND Situacion_Orden_Compra ='"+situacion_compra+"'";
                }
	}
	
	if (situacion_factura>0){
		if(where==""){
				 where= "WHERE Situacion_Factura ='"+situacion_factura+"'" ;
				  }else{
                   where = where+" AND Situacion_Factura ='"+situacion_factura+"'";
                }
	}

	
	var divResultado = document.getElementById("normal");
	
	ajax=objetoAjax();
	ajax.open("POST","seguimiento.php"+"?"+new Date().getTime(),true);
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
	ajax.send("rut="+rut+"&cliente="+cliente+"&vendedor="+vendedor+"&where="+where);
									
}

function filtrarfact(){
	
	var rut			 	= document.getElementById("rut");
	var indice1         = rut.selectedIndex;
		rut			 	= rut.options[indice1].value;	
	var cliente		 	= document.getElementById("cliente");
	var indice          = cliente.selectedIndex;
		cliente 		= cliente.options[indice].value;	
	var vendedor 		= document.getElementById("vendedor");
	var indice2         = vendedor.selectedIndex;
		vendedor	 	= vendedor.options[indice2].value;
	var situacion 			= document.getElementById("situacion");
	var indice3         	= situacion.selectedIndex;
		situacion	 		= situacion.options[indice3].value;
	var situacion_compra	= document.getElementById("situacion_compra");
	var indice4	        	= situacion_compra.selectedIndex;
		situacion_compra	= situacion_compra.options[indice4].value;
	var situacion_factura	= document.getElementById("situacion_factura");
	var indice5	        	= situacion_factura.selectedIndex;
		situacion_factura	= situacion_factura.options[indice5].value;
	
	var where="";
	
	if (rut!=""){
	if(where==""){
				 where= "WHERE Rut_Empresa ='"+rut+"'";
				  }else{
                   where = where+" OR Rut_Empresa ='"+rut+"'";
                }
	}
	
	if (cliente!=""){
		if(where==""){
				 where= "WHERE Nombre_Empresa ='"+cliente+"'";
				  }else{
                   where = where+" OR Nombre_Empresa ='"+cliente+"'";
                }
	}
	
	if (vendedor!=""){
		if(where==""){
				 where= "WHERE Vendedor ='"+vendedor+"'" ;
				  }else{
                   where = where+" AND Vendedor ='"+vendedor+"'";
                }
	}
	
	if (situacion>0){
		if(where==""){
				 where= "WHERE Situacion_Cotizacion ='"+situacion+"'" ;
				  }else{
                   where = where+" AND Situacion_Cotizacion ='"+situacion+"'";
                }
	}
	
	if (situacion_compra>0){
		if(where==""){
				 where= "WHERE Situacion_Orden_Compra ='"+situacion_compra+"'" ;
				  }else{
                   where = where+" AND Situacion_Orden_Compra ='"+situacion_compra+"'";
                }
	}
	
	if (situacion_factura>0){
		if(where==""){
				 where= "WHERE Situacion_Factura ='"+situacion_factura+"'" ;
				  }else{
                   where = where+" AND Situacion_Factura ='"+situacion_factura+"'";
                }
	}

	
	var divResultado = document.getElementById("normal");
	
	ajax=objetoAjax();
	ajax.open("POST","seguimiento1.php"+"?"+new Date().getTime(),true);
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
	ajax.send("rut="+rut+"&cliente="+cliente+"&vendedor="+vendedor+"&where="+where);
									
}

function filtrarcom(){
	
	var rut			 	= document.getElementById("rut");
	var indice1         = rut.selectedIndex;
		rut			 	= rut.options[indice1].value;	
	var cliente		 	= document.getElementById("cliente");
	var indice          = cliente.selectedIndex;
		cliente 		= cliente.options[indice].value;	
	var vendedor 		= document.getElementById("vendedor");
	var indice2         = vendedor.selectedIndex;
		vendedor	 	= vendedor.options[indice2].value;
	var situacion 			= document.getElementById("situacion");
	var indice3         	= situacion.selectedIndex;
		situacion	 		= situacion.options[indice3].value;
	var situacion_compra	= document.getElementById("situacion_compra");
	var indice4	        	= situacion_compra.selectedIndex;
		situacion_compra	= situacion_compra.options[indice4].value;
	var situacion_factura	= document.getElementById("situacion_factura");
	var indice5	        	= situacion_factura.selectedIndex;
		situacion_factura	= situacion_factura.options[indice5].value;
	
	var where="";
	
	if (rut!=""){
	if(where==""){
				 where= "WHERE Rut_Empresa ='"+rut+"'";
				  }else{
                   where = where+" OR Rut_Empresa ='"+rut+"'";
                }
	}
	
	if (cliente!=""){
		if(where==""){
				 where= "WHERE Nombre_Empresa ='"+cliente+"'";
				  }else{
                   where = where+" OR Nombre_Empresa ='"+cliente+"'";
                }
	}
	
	if (vendedor!=""){
		if(where==""){
				 where= "WHERE Vendedor ='"+vendedor+"'" ;
				  }else{
                   where = where+" AND Vendedor ='"+vendedor+"'";
                }
	}
	
	if (situacion>0){
		if(where==""){
				 where= "WHERE Situacion_Cotizacion ='"+situacion+"'" ;
				  }else{
                   where = where+" AND Situacion_Cotizacion ='"+situacion+"'";
                }
	}
	
	if (situacion_compra>0){
		if(where==""){
				 where= "WHERE Situacion_Orden_Compra ='"+situacion_compra+"'" ;
				  }else{
                   where = where+" AND Situacion_Orden_Compra ='"+situacion_compra+"'";
                }
	}
	
	if (situacion_factura>0){
		if(where==""){
				 where= "WHERE Situacion_Factura ='"+situacion_factura+"'" ;
				  }else{
                   where = where+" AND Situacion_Factura ='"+situacion_factura+"'";
                }
	}

	
	var divResultado = document.getElementById("normal");
	
	ajax=objetoAjax();
	ajax.open("POST","seguimiento2.php"+"?"+new Date().getTime(),true);
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
	ajax.send("rut="+rut+"&cliente="+cliente+"&vendedor="+vendedor+"&where="+where);
									
}

function mostrar(){
	location.href="seguimiento.php"
	
}

function mostrarfact(){
	location.href="seguimiento1.php"
	
}

function mostrarcom(){
	location.href="seguimiento2.php"
	
}


function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789,-";
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

function contar1(input) {
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

function rechazado(id){
	
	var descripcion	= document.getElementById("descripcion").value;
	
	var divResultado = document.getElementById('resultado');
	
	ajax=objetoAjax();
	ajax.open("POST","rechazado2.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
			}
		if (ajax.readyState==4) {
			if(ajax.status==200)
			{
				response = ajax.responseText;
				//divResultado.innerHTML = response;
				alert(descripcion);
				alert(id);
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
	ajax.send("descripcion="+descripcion+"&sid="+id);	
					
}

function poponload(id){
	
window.open("editar.php?id="+id, "Editar","status = 1, height = 620, width = 550, scrollbars=1, resizable = 0" );
			
				
}

function poponloadfact(id){
	
window.open("adj_fact.php?id="+id, "adjuntar factura","status = 1, height = 400, width = 750, scrollbars=1, resizable = 0" );
			
				
}

