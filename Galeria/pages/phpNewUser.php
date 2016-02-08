<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

/* * ** Recogida de datos del formulario *** */

$alias = Request::post("alias");
$email = Request::post("email");
$pass = Request::post("password");
$admin = Request::post("check_admin");
$personal = Request::post("check_personal");
$activo = Request::post("check_activo");


/*
 * Comprobación de los datos pasados en los checkbox 
 */
if ($admin === null) {
    $admin = 0;
} else if ($admin === "on") {
    $admin = 1;
}

if ($personal === null) {
    $personal = 0;
} else if ($personal === "on") {
    $personal = 1;
}

if ($activo === null) {
    $activo = 0;
} else if ($activo === "on") {
    $activo = 1;
}

/* * ** Encriptación de la contraseña *** */

$passEncriptada = sha1($pass);

/* * ** Insercción del usuario en la base de datos *** */
$nombre_archivo = $_FILES["avatar"]["name"]; //Coger avatar de $_FILES

$destino = "../img/";

if ($nombre_archivo == null) {
    $nombre_archivo = "avatar04.jpg";
}

$ruta_nombre_archivo = $destino . $nombre_archivo;

$subir = new FileUpload("avatar"); // Crear objeto FileUpload
$subir->setNombre($nombre_archivo); // Seteamos el nombre del archivo
$subir->setDestino($destino); // Seteamos el directorio del archivo

$subir->setTamanio(70000000); // Seteamos el tamaño del archivo (para grandes, lo hago pero se puede borrar)
/*
  $img_portada = $subir->getDestino() . "" . $nombre_archivo;
  echo "img portada: " . $img_portada . "<br/>";
 */
/*
 * Hacemos la subida del archivo 
 */
if ($subir->upload()) {
    echo "Archivo subido";
} else {
    echo 'Archivo no subido';
}

$sqlResultado = $gestor->count("alias like '" . $alias . "'");

if ($sqlResultado[0] == 0) {
    $usuario = new Usuario($email, $passEncriptada, $alias, "", $admin, $personal, $activo, $ruta_nombre_archivo);

    $gestor->insert($usuario);
    $sesion->sendRedirect("adminNew.php");
} else {
    $sesion->sendRedirect("adminNew.php");
}
