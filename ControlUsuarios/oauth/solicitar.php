<?php

session_start();

require_once '../clases/Google/autoload.php';

$cliente = new Google_Client();

$cliente->setApplicationName('loginusuarios-1194');
$cliente->setClientId('847638643820-l22lm2h5fbcifofdmfu7jr4ejh5jq5fg.apps.googleusercontent.com');
$cliente->setClientSecret('rCdSjbWLUKt7PnMbNHcwnJ-E');
$cliente->setRedirectUri('http://localhost');
$cliente->setScopes('https://mail.google.com/');
$cliente->setAccessType('offline');

if (!$cliente->getAccessToken()) {
   $auth = $cliente->createAuthUrl(); //solicitud
   header("Location:$auth");
}