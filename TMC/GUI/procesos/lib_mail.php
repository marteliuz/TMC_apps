<?php
$admin = "operaciones@touchmedia.cl";
$from    = "contacto@touchmedia.cl";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= "From: No-Reply <$from>" . "\r\n";

function sendEmail($to, $id_ticket, $cliente)
{
	//Admin
	$subject = "Nuevo Ticket ".$id_ticket.".";
	send("mramirez@touchmedia.cl", $subject, "Se ha recibido una nueva solicitud de servicio con ID: ".$id_ticket." del cliente ".$cliente.".");
	
	//cliente
	$subject = "Solicitud de servicio recibida.";
	send($to, $subject, "Hemos recibido su solicitud de servicio con ID: ".$id_ticket.". \nPersonal de nuestra compañia se contactará con usted a la brevedad. \n\n\n Atentamente,\n Equipo de Touchmedia Consulting.");
}

function send($to, $subject, $message)
{
	mail($to,$subject,$message,$headers);
}
?>