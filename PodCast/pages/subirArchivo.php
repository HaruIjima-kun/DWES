<?php

require '../clases/FileUpload.php';
require '../clases/AutoCarga.php';
require '../clases/Request.php';

$sesion = new Session();
$nombre = $sesion->getUser();
$nombreArchivo = $_FILES["subir_archivo"]["name"];
$subir = new FileUpload("subir_archivo");
$categoria = Request::post("categoria");
$nombreArchivo = str_replace("'", "", $nombreArchivo);
$nombreArchivo = str_replace("_", " ", $nombreArchivo);
$nombreArchivo = str_replace(".mp3", "", $nombreArchivo);
$nombreArchivo = $nombreArchivo . "_" . $categoria;
$subir->setPolitica(CONSERVAR);
$subir->setNombre($nombreArchivo);
$subir->setDestino("../usuarios/$nombre/");
$subir->setTamanio(70000000);
$subir->addTipo("mp3");

$fichero = "../usuarios/$nombre/$nombreArchivo";

if ($subir->upload()) {
    $sesion->sendRedirect("aplicacion.php");
    exit();
} else {
    echo 'Archivo no subido';
}



