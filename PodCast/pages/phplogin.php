<?php

require '../clases/AutoCarga.php';

$listaUsuarios = array(
    "admin" => "admin"
);

$nomUser = Request::post("usuario");
$password = Request::post("pass");
$sesion = new Session();

if (isset($listaUsuarios[$nomUser]) && $listaUsuarios[$nomUser] == $password) {
    $usuario = new Usuario($nomUser);
    $sesion->setUser($usuario);
    $sesion->sendRedirect("aplicacion.php");
} else {
    $sesion->destroy();
    $sesion->sendRedirect("../index.php");
}
