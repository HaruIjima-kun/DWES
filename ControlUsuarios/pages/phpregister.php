<?php

/*
 * En este fichero, se procede a coger el email y la contraseña del usuario,
 * el alias se extrae del email y se procede a realizar el filtrado,
 * si el usuario existe en la base de datos, se produce una acción (aviso),
 * y si el usuario no existe en la base de datos, lo introduce con activo = 0,
 * y sin ser personal ni administrador.
 * 
 * Aquí se debería de implementar lo de enviar el correo de activación.
 */

require '../clases/Google/autoload.php';
require '../clases/PHPMailer.php';
require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);

/* * ** Recogida de datos del formulario *** */

$email = Request::post("email");
$password = Request::post("password");

$strPos = strpos($email, "@");

$alias = substr($email, 0, $strPos); //El alias se extrae del correo electrónico


/* * ** Encriptación de la contraseña *** */

$passEncriptada = sha1($password);

/* * ** Insercción del usuario en la base de datos *** */

$sqlResultado = $gestor->count("alias like '" . $alias . "'");

$sesion = new Session();

if ($sqlResultado[0] == 0) {
    $usuario = new Usuario($email, $passEncriptada, $alias);
    $sesion->setUser($usuario);
    $gestor->insert($usuario);

    $claveActivacion = sha1($password + Constants::SEMILLA);

    $correo = new Correo();

    $destino = $email;

    $asunto = "Activación de su cuenta";
    $mensaje = "Este es un correo de activación.
    
    Diríjase a la siguiente URL para activar su cuenta: https://login-usuario-haruijima-kun.c9users.io/pages/activateUser.php?activate=$claveActivacion&email=$email";


    $correo->setDestino($destino);
    $correo->setAsunto($asunto);
    $correo->setMensaje($mensaje);

    $correo->send();
} else {
    $sesion->destroy();
    $sesion->sendRedirect("../index.php");
}


    
    
