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

if (isset($_GET['code'])) {
   $cliente->authenticate($_GET['code']);
   $_SESSION['token'] = $cliente->getAccessToken();
   $archivo = "token.conf";
   $fh = fopen($archivo, 'w') or die("error");
   fwrite($fh, $cliente->getAccessToken()); //almacenamiento del token
   fclose($fh);
}