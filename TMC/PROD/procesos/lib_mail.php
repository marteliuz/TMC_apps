<?php
$uniqueid = uniqid('np');


$admin = "operaciones@touchmedia.cl";
$from    = "contacto@touchmedia.cl";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: multipart/alternative;boundary=" . $uniqueid. "\r\n";
//$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= "From: No-Reply <$from>" . "\r\n";

function sendEmail($to, $id_ticket, $cliente)
{
	//Admin
	$subject = "Nuevo Ticket ".$id_ticket.".";
	//**MODIFICACION 2013/08/23
	// se cambia direccion de correo del admin
	
	//send("mramirez@touchmedia.cl", $subject, "Se ha recibido una nueva solicitud de servicio con ID: ".$id_ticket." del cliente ".$cliente.".");
	send("soporte@touchmedia.cl", $subject, "Se ha recibido una nueva solicitud de servicio con ID: ".$id_ticket." del cliente ".$cliente.".");
	//
	//
	//
	//cliente
	//
	//
	//
	$subject = "Solicitud de servicio recibida.";
	$message = "";
 
	$message .= "\r\n\r\n--" . $uniqueid. "\r\n";
	$message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
	$message .= "Hemos recibido su solicitud de servicio con ID: ".$id_ticket.". \nPersonal de nuestra compañia se contactará con usted a la brevedad. \n\n\n Atentamente,\n Equipo de Touchmedia Consulting.";
	 
	$message .= "\r\n\r\n--" . $uniqueid. "\r\n";
	$message .= "Content-type: text/html;charset=utf-8\r\n\r\n";
	$message .= "<head><style type='text/css'>
<!--
body
{
	background-repeat: no-repeat;

}
.text_body 
{
	font-size: 14px;
	position: absolute;
	left: 57px;
	top: 303px;
	width: 642px;
	height: 577px;
}
-->
</style>
</head>
<body background='../resourses/_background_ticket.jpg'>
<div id='text_body' class='text_body'>
  <p>
    Estimado ". $cliente .":
    <br /><br />
    Gracias por confiar en Touchmedia.
    <br /> 
    Su sataisfaccion con el servicio de es muy importante para nosotros.
    </br>
    Caso abierto [fecha] [hora], numero de incidente ".$id_ticket." fue creado por Mesa de Ayuda con el siguiente resumen:
    <br />
    <br />
    [detalle_ticket]
    <br />
    <br />
    Gracias por su tiempo y atención.
  </p>
</div>
</body>
</html>";
	 
	$message .= "\r\n\r\n--" . $uniqueid. "--";
	
	
	send($to, $subject, $message);
}

function send($to, $subject, $message)
{
	mail($to,$subject,$message,$headers);
}
?>