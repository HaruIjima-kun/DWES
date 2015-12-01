<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageGeneros($bd);

$nombre = Request::post('nombre');

echo "REQUEST DE POST -> id: $nombre";

$generos = new Generos($nombre);

echo "<br/>Objeto DISCO " . $generos->getJson() . "<br/>";

$r = $gestor->insert($generos);

$bd->close();
var_dump($bd->getError());

header("Location:visualizar.php");




