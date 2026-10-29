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
	var insertar 		= document.getElementById("insertar");
	var insertar2 		= document.getElementById("insertar2");
	var insertar3 		= document.getElementById("insertar3");
	var actualizar 		= document.getElementById("actualizar");
	var actualizar2 	= document.getElementById("actualizar2");
	var actualizar3		= document.getElementById("actualizar3");
	
	
	if(insertar.checked){
		Insertar();
		}
	if(insertar2.checked){
		Insertar2();
		}
	if(insertar3.checked){
		Insertar3();
		}
	if(actualizar.checked){
		Actualizar();
		}
	if(actualizar2.checked){
		Actualizar2();
		}
	if(actualizar3.checked){
		Actualizar3();
		}
}

function Insertar()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","insertar.php"+"?"+new Date().getTime(),true);
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

function Insertar2()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","insertar_mantencion.php"+"?"+new Date().getTime(),true);
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

function Insertar3()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","insertar_transporte.php"+"?"+new Date().getTime(),true);
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

function Actualizar()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","actualizar.php"+"?"+new Date().getTime(),true);
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

function Actualizar2()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","actualizar_mantencion.php"+"?"+new Date().getTime(),true);
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

function Actualizar3()
{
	var divResultado = document.getElementById('Step1');
                
	ajax=objetoAjax();
	ajax.open("POST","actualizar_transporte.php"+"?"+new Date().getTime(),true);
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

function poponload1(id){
	
window.open("update.php?id="+id, "Actualizar","status = 1, height = 645, width = 655, scrollbars=1, resizable = 0" );
							
}
function poponload2(id){
	
window.open("visor.php?id="+id, "Actualizar","status = 1, height = 500, width = 650, scrollbars=1, resizable = 0" );
							
}

function poponload3(id){
	
window.open("update_mantencion.php?id="+id, "Actualizar","status = 1, height = 500, width = 655, scrollbars=1, resizable = 0" );
							
}

function poponload4(id){
	
window.open("update_transporte.php?id="+id, "Actualizar","status = 1, height = 530, width = 500, scrollbars=1, resizable = 0" );
							
}


function update() {
	
	var id	 		= document.getElementById("id").value;
	var nombre 		= document.getElementById("nombre").value;
	var part 		= document.getElementById("part").value;
	
	var precio 		= document.getElementById("precio").value;
	
	
	var file_name = formulario.archivo.value;
    var tipos = new Array(".gif",".jpg",".png", "bmp");
    var valido = false;
    var extension = (file_name.substring(file_name.lastIndexOf("."))).toLowerCase();
	
	
							for(var i=0;i<tipos.length;i++){
								if(tipos[i]==extension)
                						{
                    					valido=true;
                    							break;
                						}
            							}
             						if(valido){

	
					var divResultado = document.getElementById('Step1');
		ajax=objetoAjax();
		ajax.open("POST",""+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								//response = ajax.responseText;
								//divResultado.innerHTML = response;
								formulario.submit();
								//location.href='mantenedor.php';
									
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
ajax.send("nombre="+nombre+"&part="+part+"&descripcion="+descripcion+"&precio="+precio+"&file_name="+file_name+"&tipos="+tipos+"&valido="+valido+"&extension="+extension);	
				
								
										}else{
                							alert("Ingrese archivos de imagen con formato "+tipos.join(", "));
            								}	
}

function validar(formulario, archivo){
	
	var nombre 		= document.getElementById("nombre").value;
	var part 		= document.getElementById("part").value;
	var descripcion	= document.getElementById("descripcion").value;
	var precio 		= document.getElementById("precio").value;
	var precio2 	= document.getElementById("precio2").value;
	var precio3 	= document.getElementById("precio3").value;
	var precio4 	= document.getElementById("precio4").value;
	
	
	var file_name = formulario.archivo.value;
    var tipos = new Array(".gif",".jpg",".png", "bmp");
    var valido = false;
    var extension = (file_name.substring(file_name.lastIndexOf("."))).toLowerCase();
	
	if(nombre!=""){
		if(part!=""){
			
				if(descripcion!=""){
					
						if(precio!=""){
							
							for(var i=0;i<tipos.length;i++){
								if(tipos[i]==extension)
                						{
                    					valido=true;
                    							break;
                						}
            							}
             						if(valido){
		
		var divResultado = document.getElementById('Step1');
		ajax=objetoAjax();
		ajax.open("POST",""+"?"+new Date().getTime(),true);
		ajax.onreadystatechange=function() {
						if (ajax.readyState==1){
							divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
							}
						if (ajax.readyState==4) {
							if(ajax.status==200)
							{
								//response = ajax.responseText;
								//divResultado.innerHTML = response;
								formulario.submit();
								//location.href='mantenedor.php';
									
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
ajax.send("nombre="+nombre+"&part="+part+"&descripcion="+descripcion+"&precio="+precio+"&file_name="+file_name+"&tipos="+tipos+"&valido="+valido+"&extension="+extension);	
				
								
										}else{
                							alert("Ingrese archivos de imagen con formato "+tipos.join(", "));
            								}
										
									}else{
										alert("Ingrese precio del producto");
										}
								
							}else{
								alert("Ingrese descripción del producto");
								}
						
					}else{
						alert("Ingrese part-number del producto");
						}
				}else{
					alert("Ingrese nombre del producto");
					}
		
}

function validar1(){
	
	var nombre 		= document.getElementById("nombre").value;
	var part 		= document.getElementById("part").value;
	var categoria	= document.getElementById("categoria");
	var indice      = categoria.selectedIndex;
		categoria	= categoria.options[indice].value;
	var part2 		= document.getElementById("part2").value;
	var descripcion	= document.getElementById("descripcion").value;
	var moneda		= document.getElementById("moneda");
	var indice1     = moneda.selectedIndex;
		moneda		= moneda.options[indice1].value;
	var precio 		= document.getElementById("precio").value;
	
	
	if(nombre!=""){
		if(part!=""){
				if(part2!=""){
					if(descripcion!=""){
						if(precio!=""){
						
		var divResultado = document.getElementById('Step1');
		ajax=objetoAjax();
		ajax.open("POST","subir_mantencion.php"+"?"+new Date().getTime(),true);
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
ajax.send("nombre="+nombre+"&part="+part+"&categoria="+categoria+"&descripcion="+descripcion+"&part2="+part2+"&moneda="+moneda+"&precio="+precio);	
				
								
												
									}else{
										alert("Ingrese precio de la mantención");
										}
									}else{
										alert("Ingrese descripción de la mantención");
										}
						}else{
							alert("Ingrese part-number asociado al producto");
							}		
					}else{
						alert("Ingrese part-number de mantención");
						}
				}else{
					alert("Ingrese nombre de mantención");
					}
		
}

function validar2(){
	
	var zona 		= document.getElementById("zona").value;
	var base 		= document.getElementById("base").value;
	var tarifa1		= document.getElementById("tarifa1").value;
	var tarifa2		= document.getElementById("tarifa2").value;
	var tarifa3		= document.getElementById("tarifa3").value;
	var entrega		= document.getElementById("entrega").value;
	
	
	if(zona!=""){
		if(base!=""){
				if(tarifa1!=""){
						if(tarifa2!=""){
								if(tarifa3!=""){
									if(entrega!=""){
						
		var divResultado = document.getElementById('Step1');
		ajax=objetoAjax();
		ajax.open("POST","subir_transporte.php"+"?"+new Date().getTime(),true);
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
ajax.send("zona="+zona+"&base="+base+"&tarifa1="+tarifa1+"&tarifa2="+tarifa2+"&tarifa3="+tarifa3+"&entrega="+entrega);	
				
										
									}else{
										alert("Ingrese tiempo de entrega");
										}
									}else{
										alert("Ingrese tarifa de monitor");
										}
						}else{
							alert("Ingrese tarifa de codec");
							}		
					}else{
						alert("Ingrese tarifa de carro móvil");
						}
				}else{
					alert("Ingrese lugar base");
					}
			}else{
				alert("Ingrese zona donde se encuentra");
				}
		
}

function validar_update(){
	
	var id	 		= document.getElementById("id").value;
	var nombre 		= document.getElementById("nombre").value;
	var part 		= document.getElementById("part").value;
	var categoria	= document.getElementById("categoria");
	var indice      = categoria.selectedIndex;
		categoria	= categoria.options[indice].value;
	var part2 		= document.getElementById("part2").value;
	var descripcion	= document.getElementById("descripcion").value;
	var moneda		= document.getElementById("moneda");
	var indice1     = moneda.selectedIndex;
		moneda		= moneda.options[indice1].value;
	var precio 		= document.getElementById("precio").value;
	
							
		var divResultado = document.getElementById('Step1');
		ajax=objetoAjax();
		ajax.open("POST","subir_update_mantencion.php"+"?"+new Date().getTime(),true);
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
ajax.send("nombre="+nombre+"&part="+part+"&id="+id+"&categoria="+categoria+"&descripcion="+descripcion+"&part2="+part2+"&moneda="+moneda+"&precio="+precio);	
				
							
}

function validar_update1(){
	
	var id	 		= document.getElementById("id").value;
	var zona 		= document.getElementById("zona").value;
	var base 		= document.getElementById("base").value;
	var tarifa1 	= document.getElementById("tarifa1").value;
	var tarifa2 	= document.getElementById("tarifa2").value;
	var tarifa3 	= document.getElementById("tarifa3").value;
	var entrega 	= document.getElementById("entrega").value;
	var tarifa4 	= document.getElementById("tarifa4").value;
	var tarifa5 	= document.getElementById("tarifa5").value;
	var tarifa6 	= document.getElementById("tarifa6").value;
	var entrega2 	= document.getElementById("entrega2").value;
	var tarifa7 	= document.getElementById("tarifa7").value;
	var tarifa8 	= document.getElementById("tarifa8").value;
	var tarifa9 	= document.getElementById("tarifa9").value;
	var entrega3 	= document.getElementById("entrega3").value;
	
	
							
		var divResultado = document.getElementById('Step1');
		ajax=objetoAjax();
		ajax.open("POST","subir_update_transporte.php"+"?"+new Date().getTime(),true);
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
ajax.send("zona="+zona+"&base="+base+"&id="+id+"&tarifa1="+tarifa1+"&tarifa2="+tarifa2+"&tarifa3="+tarifa3+"&entrega="+entrega+"&tarifa4="+tarifa4+"&tarifa5="+tarifa5+"&tarifa6="+tarifa6+"&entrega2="+entrega2+"&tarifa7="+tarifa7+"&tarifa8="+tarifa8+"&tarifa9="+tarifa9+"&entrega3="+entrega3);	
				
							
}

function contar(input) {
//Comprobamos que no pase de 800 caracteres y si pasa, que borre los sobrantes
if (input.value.length >= 800) {
input.value = input.value.substring(0,800);
}
//alamacenamos el resto
var resto = 800 - input.value.length;
 
//imprimimos los caracteres restantes en el span
var final=document.getElementById('letras');
final.innerHTML=resto+"/800 caracteres";
 
}

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789,.";
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

function soloLetras1(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789,%";
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

function limpia() {
    var val = document.getElementById("miInput").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("miInput").value = '';
    }
}

function load_tablas(){

var productos		= document.getElementById("productos");
var indice      	= productos.selectedIndex;
	productos		= productos.options[indice].value;
var div				= document.getElementById("muestra_contenido_ajax").innerHTML;
	 	
xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200) {
document.getElementById("muestra_contenido_ajax").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","tabla_dinamica.php?productos="+productos+"&div="+div, true);
xmlhttp.send();

}

function borrar(id) {
	
	var obj = document.getElementById(id);
	var objPadre = obj.parentNode;
	objPadre.removeChild(obj);
	obj = document.createElement("tbody");
	obj.id = id;
	objPadre.appendChild(obj);
	return false;
	
	}


function guardar(id) {
	
	var cantidad		= document.getElementById("cantidad").value;
	var precio			= document.getElementById("precio").value;
	var margen			= document.getElementById("margen").value;
	
	ajax=objetoAjax();
			ajax.open("POST","guardar.php"+"?"+new Date().getTime(),true);
			ajax.onreadystatechange=function() {
				if (ajax.readyState==1){
					divResultado.innerHTML = "<img src='espera.gif' align='center'> Aguarde por favor...";
					}
				if (ajax.readyState==4) {
					if(ajax.status==200)
					{
						response = ajax.responseText;
						// divResultado.innerHTML = response;
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
			ajax.send("id="+id+"&cantidad="+cantidad+"&precio="+precio+"&margen="+margen);	
		
        }
  


