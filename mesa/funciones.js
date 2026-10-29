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
	var red = document.getElementById("red");
	var audio = document.getElementById("audio");
	var video = document.getElementById("video");
	
	if(red.checked){
		ProRed();
		ClearSteps();
		}
	if(audio.checked){
		SinVideoAudio();
		ClearSteps();
		}
	if(video.checked){
		SinVideoAudio();
		ClearSteps();	
	}
}

function ProRed()
{
	var divResultado = document.getElementById('Step6');
                
	ajax=objetoAjax();
	ajax.open("POST","Red.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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

function SinVideoAudio()
{
	var divResultado = document.getElementById('Step9');
                
	ajax=objetoAjax();
	ajax.open("POST","vsx_hdx.html"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
function Step3()
{
	var audio = document.getElementById("audio");
	var video = document.getElementById("video");
	var hdx   = document.getElementById("RadioGroup_0");
	var vsx   = document.getElementById("RadioGroup_1");
	
	
	if(audio.checked && hdx.checked){
		Cataudiohdx();
		ClearSteps2()
		}
	if(audio.checked && vsx.checked){
		Cataudiovsx();
		ClearSteps2()
		}
	if(video.checked && hdx.checked){
		Catvideohdx();
		ClearSteps2()
	}
	if (video.checked && vsx.checked)
	{
		Catvideovsx();
		ClearSteps2()
		}
	
}
function Cataudiohdx()
{
	var divResultado = document.getElementById('Step3');
                
	ajax=objetoAjax();
	ajax.open("POST","cat_audio_hdx.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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

function Cataudiovsx()
{
	var divResultado = document.getElementById('Step3');
                
	ajax=objetoAjax();
	ajax.open("POST","cat_audio_vsx.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
function Catvideohdx()
{
	var divResultado = document.getElementById('Step3');
                
	ajax=objetoAjax();
	ajax.open("POST","cat_video_hdx.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
function Catvideovsx()
{
	var divResultado = document.getElementById('Step3');
                
	ajax=objetoAjax();
	ajax.open("POST","cat_video_vsx.php"+"?"+new Date().getTime(),true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==1){
			divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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

function detector() {
	
	var seleccion	= document.getElementsByName("seleccion");
   for (i=0; i<seleccion.length; i++) {
     if (seleccion[i].checked) {
         var sel= seleccion[i].value;
		{ 
		  var divResultado = document.getElementById('Step4');
                
                ajax=objetoAjax();
                ajax.open("POST","res_pro.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion="+seleccion+"&sel="+sel);
}

	 }
  }
ClearSteps1()  
}

function detector1() {
	 
	var seleccion	= document.getElementsByName("seleccion1");
   for (i=0; i<seleccion.length; i++) {
     if (seleccion[i].checked) {
       var sel=seleccion[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step6');
                
                ajax=objetoAjax();
                ajax.open("POST","sin_audio_hdx_cat1.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion="+seleccion+"&sel="+sel);
}

	 }
   }
   ClearSteps1()
}

function detector2() {
	 
	var seleccion	= document.getElementsByName("seleccion2");
   for (i=0; i<seleccion.length; i++) {
     if (seleccion[i].checked) {
       var sel=seleccion[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step6');
                
                ajax=objetoAjax();
                ajax.open("POST","sin_audio_vsx_cat1.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion="+seleccion+"&sel="+sel);
}

	 }
   }
   ClearSteps1()
}

function detector3() {
	 
	var seleccion	= document.getElementsByName("seleccion3");
   for (i=0; i<seleccion.length; i++) {
     if (seleccion[i].checked) {
       var sel=seleccion[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step6');
                
                ajax=objetoAjax();
                ajax.open("POST","sin_video_hdx_cat1.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion="+seleccion+"&sel="+sel);
}

	 }
   }
   ClearSteps1()
}

function detector4() {
	 
	var seleccion	= document.getElementsByName("seleccion4");
   for (i=0; i<seleccion.length; i++) {
     if (seleccion[i].checked) {
       var sel=seleccion[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step6');
                
                ajax=objetoAjax();
                ajax.open("POST","sin_video_vsx_cat1.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion="+seleccion+"&sel="+sel);
}

	 }
   }
   ClearSteps1()
}

function detector5() {
	 
	var seleccion1	= document.getElementsByName("seleccion5");
   for (i=0; i<seleccion1.length; i++) {
     if (seleccion1[i].checked) {
       var sel1=seleccion1[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step7');
                
                ajax=objetoAjax();
                ajax.open("POST","pro_audio_hdx.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion1="+seleccion1+"&sel1="+sel1);
}

	 }
   }
}

function detector6() {
	 
	var seleccion1	= document.getElementsByName("seleccion6");
   for (i=0; i<seleccion1.length; i++) {
     if (seleccion1[i].checked) {
       var sel1=seleccion1[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step7');
                
                ajax=objetoAjax();
                ajax.open("POST","pro_audiovsx.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion1="+seleccion1+"&sel1="+sel1);
}

	 }
   }
}

function detector7() {
	 
	var seleccion1	= document.getElementsByName("seleccion7");
   for (i=0; i<seleccion1.length; i++) {
     if (seleccion1[i].checked) {
       var sel1=seleccion1[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step7');
                
                ajax=objetoAjax();
                ajax.open("POST","pro_videohdx.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion1="+seleccion1+"&sel1="+sel1);
}

	 }
   }
}

function detector8() {
	 
	var seleccion1	= document.getElementsByName("seleccion8");
   for (i=0; i<seleccion1.length; i++) {
     if (seleccion1[i].checked) {
       var sel1=seleccion1[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step7');
                
                ajax=objetoAjax();
                ajax.open("POST","pro_videovsx.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion1="+seleccion1+"&sel1="+sel1);
}

	 }
   }
}

function detector9() {
	 
	var seleccion1	= document.getElementsByName("seleccion9");
   for (i=0; i<seleccion1.length; i++) {
     if (seleccion1[i].checked) {
       var sel1=seleccion1[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step8');
                
                ajax=objetoAjax();
                ajax.open("POST","sol_audiohdx.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion1="+seleccion1+"&sel1="+sel1);
}

	 }
   }
}

function detector10() {
	 
	var seleccion1	= document.getElementsByName("seleccion10");
   for (i=0; i<seleccion1.length; i++) {
     if (seleccion1[i].checked) {
       var sel1=seleccion1[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step8');
                
                ajax=objetoAjax();
                ajax.open("POST","sol_audiovsx.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion1="+seleccion1+"&sel1="+sel1);
}

	 }
   }
}

function detector11() {
	 
	var seleccion1	= document.getElementsByName("seleccion11");
   for (i=0; i<seleccion1.length; i++) {
     if (seleccion1[i].checked) {
       var sel1=seleccion1[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step8');
                
                ajax=objetoAjax();
                ajax.open("POST","sol_videohdx.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion1="+seleccion1+"&sel1="+sel1);
}

	 }
   }
}

function detector12() {
	 
	var seleccion1	= document.getElementsByName("seleccion12");
   for (i=0; i<seleccion1.length; i++) {
     if (seleccion1[i].checked) {
       var sel1=seleccion1[i].value;
		
	{ 
		  var divResultado = document.getElementById('Step8');
                
                ajax=objetoAjax();
                ajax.open("POST","sol_videovsx.php"+"?"+new Date().getTime(),true);
                ajax.onreadystatechange=function() {
                if (ajax.readyState==1){
                               divResultado.innerHTML = "<img src='../resources/anim.gif' align='center'> Aguarde por favor...";
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
                ajax.send("seleccion1="+seleccion1+"&sel1="+sel1);
}

	 }
   }
}

function ClearSteps()
{
	var divStep3 = document.getElementById("Step3");
	divStep3.innerHTML = "";
	var divStep4 = document.getElementById("Step4");
	divStep4.innerHTML = "";
	var divStep6 = document.getElementById("Step6");
	divStep6.innerHTML = "";
	var divStep7 = document.getElementById("Step7");
	divStep7.innerHTML = "";
	var divStep9 = document.getElementById("Step9");
	divStep9.innerHTML = "";
}
function ClearSteps1()
{
	var divStep7 = document.getElementById("Step7");
	divStep7.innerHTML = "";
}

function ClearSteps2()
{
	
	var divStep4 = document.getElementById("Step4");
	divStep4.innerHTML = "";
	var divStep6 = document.getElementById("Step6");
	divStep6.innerHTML = "";
	var divStep7 = document.getElementById("Step7");
	divStep7.innerHTML = "";
}