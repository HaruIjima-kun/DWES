<?php

require '../clases/AutoCarga.php';
/*
 * Creamos los objetos necesarios.
 */
$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

/*
 * Cogemos los datos que envía el formulario por POST
 */

$userSesion = $sesion->getUser();

$aliasNuevo = Request::post("alias");
$emailNuevo = Request::post("emailEdit");
$passNueva = Request::post("passwordEdit");
$fechaalta = $userSesion->getFechaAlta();
$admin = Request::post("check_admin");
$personal = Request::post("check_personal");
$activo = Request::post("check_activo");
$pkAlias = $userSesion->getAlias();

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

/*
 * Comprobación de si se ha introducido una contraseña nueva
 */

if (!isset($passNueva)) {
    $passEncriptada = $userSesion->getClave();
    //echo "Contraseña antigua: " . $passEncriptada . "<br/><br/>";
} else {
    $passEncriptada = sha1($passNueva);
    //echo "Contraseña nueva: " . $passEncriptada . "<br/><br/>";
}

/*
 * Procedemos a subir el avatar
 */

$nombre_archivo = $_FILES["avatarNuevo"]["name"]; //Coger avatar de $_FILES

$destino = "../dist/img/";
/*
 * Comprueba si el archivo ha sido seteado, si no, coge el que tiene del objeto
 * usuario de la sesion.
 */

if (!$nombre_archivo == "") {
    echo $ruta_nombre_archivo = $destino . $nombre_archivo;
} else {
    $avatarUsuario = $userSesion->getAvatar();
    $ruta_nombre_archivo = $avatarUsuario;
}

/*
 * Comprobamos si ha editado el alias
 */

$subir = new FileUpload("avatarNuevo"); // Crear objeto FileUpload
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
    //echo "Archivo subido";
} else {
    //echo 'Archivo no subido';
}

$usuario = new Usuario($emailNuevo, $passEncriptada, $aliasNuevo, $fechaalta, $admin, $personal, $activo, $ruta_nombre_archivo);
//echo $usuario->getJson();
//echo "<br/><br/>antes de setear<br/><br/>";
$gestor->setForAdmin($usuario, $pkAlias);


$sqlUsuario = $gestor->get($aliasNuevo);

$sqlEmail = $sqlUsuario->getEmail();            // Email
$sqlAlias = $sqlUsuario->getAlias();            // Alias
$sqlPass = $sqlUsuario->getClave();             // Clave
$sqlFechaRegistro = $sqlUsuario->getFechaalta(); // Fecha alta
$sqlAdmin = $sqlUsuario->getAdministrador();    // Admin?
$sqlPersonal = $sqlUsuario->getPersonal();      // Personal?
$sqlActivo = $sqlUsuario->getActivo();          // Activo?
$sqlAvatar = $sqlUsuario->getAvatar();          // Avatar

$usuario2 = new Usuario($sqlEmail, $sqlPass, $sqlAlias, $sqlFechaRegistro, $sqlAdmin, $sqlPersonal, $sqlActivo, $sqlAvatar);
//var_dump($usuario2);
$sesion->setUser($usuario2);
$sesion->sendRedirect("phpControl.php");

