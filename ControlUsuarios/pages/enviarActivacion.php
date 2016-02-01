<?php

require '../clases/Google/autoload.php';
require '../clases/PHPMailer.php';
require '../clases/AutoCarga.php';

$correo = new Correo();

$destino = "ejemplo@example.com";

$destino = Request::post("");

$asunto = "Activación de su cuenta";
$mensaje = "Este es un correo de activación.";


$correo->setDestino($destino);
$correo->setAsunto($asunto);
$correo->setMensaje($mensaje);

$correo->send();
