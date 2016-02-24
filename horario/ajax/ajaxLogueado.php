<?php

require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$logueado = $sesion->isLogged();
//$ok = json_encode(array('email' => true));
$no = json_encode(array('email' => false));

if ($logueado) {
    $usuario = $sesion->getUser();

    $nombre = $usuario->getNombre();
    $email = $usuario->getEmail();
    
    $ok = json_encode(
        array(
            'email' => true,
            'nombreProfesor' => $nombre,
            'emailProfesor' => $email
        )
    );
    echo $ok;
} else {
    echo $no;
}