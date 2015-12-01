<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageGeneros($bd);

$pkNombre = Request::post('pkNombre');
$nombre = Request::post('nombre');

echo "Esto es phpedit el pknombre es: $pkNombre y el nombre es: $nombre";

$genero = new Generos($nombre);
$r = $gestor->set($genero, $pkNombre);

$bd->close();
var_dump($bd->getError());

header("Location:visualizar.php");
