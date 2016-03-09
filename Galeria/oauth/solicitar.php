<?php

session_start();

require_once '../clases/Google/autoload.php';

$cliente = new Google_Client();

$cliente->setApplicationName('APPLICATION-NAME');
$cliente->setClientId('CLIENT-ID');
$cliente->setClientSecret('CLIENT-SECRET');
$cliente->setRedirectUri('REDIRECT-URI');
$cliente->setScopes('https://mail.google.com/');
$cliente->setAccessType('offline');

if (!$cliente->getAccessToken()) {
   $auth = $cliente->createAuthUrl(); //solicitud
   header("Location:$auth");
}