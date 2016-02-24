<?php
require_once '../clases/AutoCarga.php';

$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUsuario($bd);

/*
    Obtenemos el correo y el código de activación de la url del correo
*/
$clave = Request::get("activate");
$email = Request::get("email");

$claveConfirmacion = $clave; // Guardamos el código de activación de la url

$strPos = strpos($email, "@"); // Cogemos el usuario del correo
$alias = substr($email, 0, $strPos); 

$user = $gestor->get($alias); // Obtenemos el usuario que vamos a activar

$activo = $user->getActivo(); // Obtenemos si está activo

$claveUser = $user->getClave(); // Obtenemos la clave almacenada en la base de datos

$claveGenerada = sha1($claveUser + Constants::SEMILLA); // Generamos el código de activación para compararlo con el que se pasa en el correo

if ($claveGenerada === $claveConfirmacion && $activo == 0) {
    $user->setActivo(1);
    $gestor->setForAdmin($user, $alias);
    $sesion->destroy();
    $sesion->sendRedirect("../index.php");
} else {
    $sesion->destroy();
    $sesion->sendRedirect("../index.php");
}