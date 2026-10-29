function objetoAjax(){
	var xmlhttp = false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				xmlhttp = false;
			}
	}
	if (!xmlhttp && typeof XMLHttpRequest!= 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function GenReporteQoEMaster()
{
	divResultado = document.getElementById('resultado');
	dato = document.getElementById("fecha").value;

	if (dato=="")
	{
		alert("Debe ingresar una fecha para generar el reporte");
	}
	else
	{
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryReporteQoEMaster.php",true);
		divResultado.innerHTML = '<img src="../resources/anim.gif">';
		ajax.onreadystatechange=function()
		{
			if (ajax.readystate==4)
			{
				divResultado.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("fecha="+dato);
	}
}

function GenReporteMonitoreo()
{
	divResultado = document.getElementById('resultado');
	dato = document.getElementById("fecha").value;

	if (dato=="")
	{
		alert("Debe ingresar una fecha para generar el reporte");
	}
	else
	{
		ajax=objetoAjax();
		ajax.open("POST","../procesos/qryReporteMonitoreo.php",true);
		divResultado.innerHTML = '<img src="../resources/anim.gif">';
		ajax.onreadystatechange=function()
		{
			if (ajax.readystate==4)
			{
				divResultado.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("fecha="+dato);
	}
}

function GenReporteQoEMasterCOU()
{
	divResultado = document.getElementById('resultado');
	dato = document.getElementById("fecha").value;

	if (dato=="")
	{
		alert("Debe ingresar una fecha para generar el reporte");
	}
	else
	{
		ajax=objetoAjax();
		ajax.open("POST","../procesos/COU_qryReporteQoEMaster.php",true);
		divResultado.innerHTML = '<img src="../resources/anim.gif">';
		ajax.onreadystatechange=function()
		{
			if (ajax.readystate==4)
			{
				divResultado.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("fecha="+dato);
	}
}

function GenReporteLlamadas0()
{
	divResultado = document.getElementById('resultado');
	month = document.getElementById("mes").value;
	year = document.getElementById("year").value;
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryReporteLlamadas.php",true);
	divResultado.innerHTML = '<img src="../resources/anim.gif">';
	ajax.onreadystatechange=function()
	{
		if (ajax.readystate==4)
		{
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("mes="+month+"&year="+year);
}

function GenReporteLlamadas1()
{
	divResultado = document.getElementById('resultado');
	month = document.getElementById("mes").value;
	year = document.getElementById("year").value;
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryReporteLlamadasPeer.php",true);
	divResultado.innerHTML = '<img src="../resources/anim.gif">';
	ajax.onreadystatechange=function()
	{
		if (ajax.readystate==4)
		{
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("mes="+month+"&year="+year);
}

function GenReporteLlamadasTasA()
{
	divResultado = document.getElementById('resultado');
	month = document.getElementById("mes").value;
	year = document.getElementById("year").value;
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryReporteLlamadasPeerTasacionA.php",true);
	divResultado.innerHTML = '<img src="../resources/anim.gif">';
	ajax.onreadystatechange=function()
	{
		if (ajax.readystate==4)
		{
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("mes="+month+"&year="+year);
}

function GenReporteLlamadasTasB()
{
	divResultado = document.getElementById('resultado');
	month = document.getElementById("mes").value;
	year = document.getElementById("year").value;
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryReporteLlamadasPeerTasacionB.php",true);
	divResultado.innerHTML = '<img src="../resources/anim.gif">';
	ajax.onreadystatechange=function()
	{
		if (ajax.readystate==4)
		{
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("mes="+month+"&year="+year);
}

function GenReporteLlamadasIng()
{
	var divResultado = document.getElementById('resultado');
		var month    = document.getElementById("mes").value;
		var year     = document.getElementById("year").value;
	var index        = document.getElementById("clientes").selectedIndex;
		var client   = document.getElementById("clientes").options[index].text;
	
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryReporteLlamadasPeerIngenieria.php",true);
	divResultado.innerHTML = '<img src="../resources/anim.gif">';
	ajax.onreadystatechange=function()
	{
		if (ajax.readystate==4)
		{
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("mes="+month+"&year="+year+"&client="+client);
}


function GenReporteLlamadasCOU()
{
	divResultado = document.getElementById('resultado');
	month = document.getElementById("meses").value;
	year = document.getElementById("year").value;
	ajax=objetoAjax();
	ajax.open("POST","../procesos/COU_qryReporteLlamadas.php",true);
	divResultado.innerHTML = '<img src="../resources/anim.gif">';
	ajax.onreadystatechange=function()
	{
		if (ajax.readystate==4)
		{
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("mes="+month+"&year="+year);
}

function GenReporteSitiosMensual()
{
	divResultado = document.getElementById('resultado');
	month = document.getElementById("mes").value;
	year = document.getElementById("year").value;
	ajax=objetoAjax();
	ajax.open("POST","../procesos/qryReporteSitiosMensual.php",true);
	divResultado.innerHTML = '<img src="../resources/anim.gif">';
	ajax.onreadystatechange=function()
	{
		if (ajax.readystate==4)
		{
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("mes="+month+"&year="+year);
}

function Exportar()
{
	$(document).ready(function() {
	$(".botonExcel").click(function(event) {
	$("#datos_a_enviar").val( $("<div>").append( $("#tabla2").eq(0).clone()).html());
	$("#FormularioExportacion").submit();
	});
	});
}
