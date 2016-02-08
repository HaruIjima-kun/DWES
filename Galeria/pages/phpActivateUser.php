<?php
require_once '../clases/AutoCarga.php';

$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUsuario($bd);

$claveConfirmacion = sha1($password + Constants::SEMILLA);

$clave = Request::get("activate");
$email = Request::get("email");


$strPos = strpos($email, "@");
$alias = substr($email, 0, $strPos);

$user = $gestor->get($alias);

$activo = $user->getActivo();

$claveUser = $user->getClave();

$claveGenerada = sha1($claveUser + Constants::SEMILLA);

if ($claveGenerada === $claveConfirmacion && $activo == 0) {
    $user->setActivo(1);
    $gestor->setForAdmin($user, $alias);
    $sesion->destroy();
    $sesion->sendRedirect("../index.php");
    //$usuario = new Usuario($email, $passEncriptada, $alias);
    //$sesion->setUser($usuario);
} else {
    $sesion->destroy();
    $sesion->sendRedirect("../index.php");
}