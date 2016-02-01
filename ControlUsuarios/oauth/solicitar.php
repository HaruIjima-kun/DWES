<?php

session_start();

require_once '../clases/Google/autoload.php';

$cliente = new Google_Client();

$cliente->setApplicationName('');
$cliente->setClientId('');
$cliente->setClientSecret('');
$cliente->setRedirectUri('');
$cliente->setScopes('https://mail.google.com/');
$cliente->setAccessType('offline');

if (!$cliente->getAccessToken()) {
   $auth = $cliente->createAuthUrl(); //solicitud
   header("Location:$auth");
}