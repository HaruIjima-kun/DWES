<?php

require '../clases/AutoCarga.php';

$nomUser = Request::post("usuario");
$password = Request::post("pass");
$sesion = new Session();

echo "usuario: $nomUser y la contraseña es: $password";

if ($nomUser == "admin" && $password == "admin") {
    $sesion->set("nombreUsuario", $nomUser);
    $sesion->set("contraseniaUsuario", $password);
    $sesion->sendRedirect("administrarTablas.php");
} else {
    $sesion->destroy();
    $sesion->sendRedirect("iniciarSesion.php");
}
