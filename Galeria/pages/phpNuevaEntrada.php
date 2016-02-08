<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageImagenes($bd);
$sesion = new Session();

/* * ** Recogida de datos del formulario *** */

$email = Request::post("pkEmail");
$titulo = Request::post("titulo");
$descripcion = Request::post("descripcion");
$paginaAnterior = Request::post("paginaAnterior");
/* * ** Insercción del usuario en la base de datos *** */
$nombre_archivo = $_FILES["imagenGaleria"]["name"]; //Coger avatar de $_FILES

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

$sqlResultado = $gestor->count("email like '" . $email . "'");

if ($sqlResultado[0] == 0) {
    $imagen = new Imagenes($email, $titulo, $descripcion, $ruta_nombre_archivo);
    echo "el usuario existe";
    $gestor->insert($imagen);
    $redireccion = $paginaAnterior . "Gallery.php";
    //$sesion->sendRedirect($redireccion);
} else {
    echo "el usuario no existe";
    $redireccion = $paginaAnterior . "Gallery.php";
    //$sesion->sendRedirect($redireccion);
}
