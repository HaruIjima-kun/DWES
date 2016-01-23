<?php
require '../clases/AutoCarga.php';

$sesion = new Session();
session_start();

$usuario = $sesion->getUser();

$correoUser = $email->getEmail();
$passwordUser = $passEncriptada->getClave();
$aliasUser = $alias->getAlias();

$origen = "haru.kun.92@gmail.com";
$alias = "Pepe Perez";
$destino = "jamartinmolina@gmail.com";
$asunto = "Correo de activación";
$mensaje = "Esto es un correo de prueba.";

require_once '../clases/Google/autoload.php';
require_once '../clases/class.phpmailer.php';  //las últimas versiones también vienen con autoload

$cliente = new Google_Client();

$cliente->setApplicationName('loginusuarios-1194');
$cliente->setClientId('847638643820-l22lm2h5fbcifofdmfu7jr4ejh5jq5fg.apps.googleusercontent.com');
$cliente->setClientSecret('rCdSjbWLUKt7PnMbNHcwnJ-E');
$cliente->setRedirectUri('http://localhost');
$cliente->setScopes('https://mail.google.com/');
$cliente->setAccessType('offline');

if ($cliente->getAccessToken()) {
    $service = new Google_Service_Gmail($cliente);
    try {
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->From = $origen;
        $mail->FromName = $alias;
        $mail->AddAddress($destino);
        $mail->AddReplyTo($origen, $alias);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->preSend();
        $mime = $mail->getSentMIMEMessage();
        $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
        $mensaje = new Google_Service_Gmail_Message();
        $mensaje->setRaw($mime);
        $service->users_messages->send('me', $mensaje);
    } catch (Exception $e) {
        print($e->getMessage());
    }
    echo "Correo enviado correctamente";
} else {
    echo "Correo NO enviado";
}


function crearURL(){
    
}
?>