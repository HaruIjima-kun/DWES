<?php
require 'clases/AutoCarga.php';
$control = new Controlador();
$sesion = new Session();
//$control->handle();

if($sesion->isLogged()){
    $control->metodo1();
} else {
    $control->handle();
}
