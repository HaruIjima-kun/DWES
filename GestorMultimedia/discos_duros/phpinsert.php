<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageDiscoDuro($bd);

$id = Request::post('id');
$capacidad = Request::post('capacidad');
$fabricante = Request::post('fabricante');

echo "REQUEST DE POST -> id: $id capacidad: $capacidad fabricante: $fabricante";

$discosDuros = new DiscoDuro($id, $capacidad, $fabricante);

echo "<br/>Objeto DISCO " . $discosDuros->getJson() . "<br/>";

$r = $gestor->insert($discosDuros);

$bd->close();
var_dump($bd->getError());

header("Location:visualizar.php");




