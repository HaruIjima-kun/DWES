<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageMultimedia($bd);

$pkNombre = Request::post('pkId');
$id = Request::post('id');
$titulo = Request::post('titulo');
$titulo_original = Request::post('titulo_original');
$anio = Request::post('anio');
$numero_capitulos = Request::post('numero_capitulos');
$numero_ovas = Request::post('numero_ovas');
$genero = Request::post('genero');
$duracion_capitulo = Request::post('duracion_capitulo');
$duracion_total = Request::post('duracion_total');
$director = Request::post('director');
$f_estreno = Request::post('f_estreno');
$temporadas = Request::post('temporadas');
$tipo = Request::post('tipo');
$hdd = Request::post('hdd');
echo "<br/>DolarPost: ";
var_dump($_POST);
echo "<br/>DolarFiles: ";
var_dump($_FILES);
echo "<br/>";

$nombre_archivo = $_FILES["img_portada"]["name"];
$subir = new FileUpload("img_portada");
$subir->setNombre($nombre_archivo);
echo "<br/>archivin: " . $subir->getNombre() . "<br/>";
$subir->setDestino("../imgPortada/");
echo "<br/>archivin: " . $subir->getDestino() . "<br/>";

$subir->setTamanio(70000000);

$img_portada = $subir->getDestino() . "" . $nombre_archivo;
echo "img portada: " . $img_portada . "<br/>";

//echo "Esto es phpedit el pknombre es: $pkNombre y el nombre es: $nombre";

$multimedia = new Multimedia($id, $titulo, $titulo_original, $anio, $numero_capitulos, $numero_ovas, $genero, $duracion_capitulo, $duracion_total, $director, $f_estreno, $temporadas, $tipo, $img_portada, $hdd);
$r = $gestor->insert($multimedia);

$bd->close();
var_dump($bd->getError());

if ($subir->upload()) {
    header("Location:visualizar.php");
    exit();
} else {
    echo 'Archivo no subido';
}

header("Location:visualizar.php");



