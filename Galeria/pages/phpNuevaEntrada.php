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

$subir = new FileUpload("imagenGaleria"); // Crear objeto FileUpload
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

echo $sqlResultado = $gestor->count("email like '" . $email . "'");

    $imagen = new Imagenes("",$email, utf8_encode($titulo), utf8_encode($descripcion), $ruta_nombre_archivo);
    $gestor->insert($imagen);
    $redireccion = $paginaAnterior . "Gallery.php";
    $sesion->sendRedirect($redireccion);
