<?php

session_start();

require_once '../clases/Google/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('loginusuarios-1194');
$cliente->setClientId('847638643820-m5an69h8iqrm3ueq96fc8qdb1vmrj4fu.apps.googleusercontent.com');
$cliente->setClientSecret('lAw36D_2zPVpmHZPcF6ey7L8');
$cliente->setRedirectUri('https://login-usuario-haruijima-kun.c9users.io/index.php');
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