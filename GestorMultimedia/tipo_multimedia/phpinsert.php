<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageTipoMultimedia($bd);

$nombre = Request::post('nombre');

echo "REQUEST DE POST -> id: $nombre";

$tipos = new TipoMultimedia($nombre);

echo "<br/>Objeto DISCO " . $tipos->getJson() . "<br/>";

$r = $gestor->insert($tipos);

$bd->close();
var_dump($bd->getError());

//header("Location:visualizar.php");




