<?php

require '../clases/AutoCarga.php';

header('Contet-Type: application/json');

$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

$email = Request::req("email");
$clave = Request::req("clave");

$sqlUsuario = $gestor->get($email);

$sqlEmail = $sqlUsuario->getEmail();
$sqlPass = $sqlUsuario->getPassword();
$sqlNombre = $sqlUsuario->getNombre();

$condicion = 'email like "' . $email . '"';
$existe = $gestor->count($condicion);

$ok = json_encode(
    array(
        'email' => true,
        'nombreProfesor' => $sqlNombre,
        'emailProfesor' => $sqlEmail
    )
);

$no = json_encode(array('email' => false));

if ($existe == 1) {
    echo $ok;

    if ($clave == $sqlPass) {
        $usuario = new Usuario($sqlEmail, $sqlPass, $sqlNombre);
        $sesion->setUser($usuario);
    } else {
        $sesion->destroy();
    }
} else {
    echo $no;
    $sesion->destroy();
}