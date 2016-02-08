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

if(isset($_SESSION["procedencia"]) && $sesion->get("procedencia") === "editView"){
    $aliasNuevo = Request::post("aliasEdit");
    $emailNuevo = Request::post("emailEdit");
    $passNueva = Request::post("passwordEdit");
    $fechaalta = Request::post("pkFechaAlta");
    $admin = Request::post("check_admin");
    $personal = Request::post("check_personal");
    $activo = Request::post("check_activo");
    $pkAlias = Request::post("pkAlias");
    $pkEmail = Request::post("pkEmail");
    
    $passwordBD = $gestor->get($pkAlias);
    $password = $passwordBD->getClave();
} else {
    //Si es el propio usuario, coge estos datos
    $aliasNuevo = Request::post("aliasEdit");
    $emailNuevo = Request::post("emailEdit");
    $passNueva = Request::post("passwordEdit");
    $fechaalta = $userSesion->getFechaAlta();
    $admin = Request::post("check_admin");
    $personal = Request::post("check_personal");
    $activo = Request::post("check_activo");
    $pkAlias = $userSesion->getAlias();
    
    /*
        echo "Email " . $emailNuevo . "<br> Contraseña: " . $passEncriptada . "<br> Alias " . $aliasNuevo . "<br> Fecha de alta: " . 
        $fechaalta . "<br> Administrador: " . $admin . "<br> Personal: " . $personal . "<br> Activo: " . $activo . "<br> Ruta de la imagen: " . $ruta_nombre_archivo;
    */
}
echo "<br><br>";

/*
 * Comprobación de los datos pasados en los checkbox 
 */
 
// Administrador
if ($admin === null) {
    $admin = 0;
} else if ($admin === "on") {
    $admin = 1;
}

// Personal
if ($personal === null) {
    $personal = 0;
} else if ($personal === "on") {
    $personal = 1;
}

// Activo
if ($activo === null) {
    $activo = 0;
} else if ($activo === "on") {
    $activo = 1;
}

/*
* Comprobación de si se ha introducido una contraseña nueva
*/
if (!isset($passNueva)) {
    $passwordBD = $gestor->get($pkAlias);
    $password = $passwordBD->getClave();
    $passEncriptada = $password;
    //echo "Contraseña antigua: " . $passEncriptada . "<br/><br/>";
} else {
    $passEncriptada = sha1($passNueva);
    //echo "Contraseña nueva: " . $passEncriptada . "<br/><br/>";
}

/*
 * Procedemos a subir el avatar
 */

$nombre_archivo = $_FILES["avatarNuevo"]["name"]; //Coger avatar de $_FILES

$destino = "../img/";
/*
 * Comprueba si el archivo ha sido seteado, si no, coge el que tiene del objeto
 * usuario de la sesion.
 */

if (!$nombre_archivo == "") {
    $ruta_nombre_archivo = $destino . $nombre_archivo;
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
    echo "<br/>Archivo subido<br/>";
} else {
    echo '<br/>Archivo no subido<br/>';
}

/*
 * Preparamos el objeto con los datos nuevos para actualizar el usuario. 
*/
$usuario = new Usuario($emailNuevo, $passEncriptada, $aliasNuevo, $fechaalta, $admin, $personal, $activo, $ruta_nombre_archivo);

if(isset($_SESSION["procedencia"]) && $sesion->get("procedencia") === "editView"){
    var_dump($usuario);
    echo "<br> Ha entrado en el usuario de la tabla<br>";
    $gestor->setForAdmin($usuario, $pkAlias);
    $sesion->sendRedirect("phpControl.php");
} else {
    var_dump($usuario);
    $gestor->setForAdmin($usuario, $pkAlias);
    echo "<br> Ha entrado en el usuario<br>";
    $sqlUsuario = $gestor->get($aliasNuevo);
    $sqlEmail = $sqlUsuario->getEmail();            // Email
    $sqlAlias = $sqlUsuario->getAlias();            // Alias
    $sqlPass = $sqlUsuario->getClave();             // Clave
    $sqlFechaRegistro = $sqlUsuario->getFechaalta(); // Fecha alta
    $sqlAdmin = $sqlUsuario->getAdministrador();    // Admin
    $sqlPersonal = $sqlUsuario->getPersonal();      // Personal
    $sqlActivo = $sqlUsuario->getActivo();          // Activo
    $sqlAvatar = $sqlUsuario->getAvatar();          // Avatar
    
    $usuario2 = new Usuario($sqlEmail, $sqlPass, $sqlAlias, $sqlFechaRegistro, $sqlAdmin, $sqlPersonal, $sqlActivo, $sqlAvatar);
    $sesion->setUser($usuario2);
    $sesion->sendRedirect("phpControl.php");

}