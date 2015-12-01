<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageDiscoDuro($bd);

$pkId = Request::post('pkId');
echo $pkId . "<br/>";
$id = Request::post('id');
echo $id . "<br/>";
$capacidad = Request::post('capacidad');
$fabricante = Request::post('fabricante');

$discoDuro = new DiscoDuro($id, $capacidad, $fabricante);
$r = $gestor->set($discoDuro, $pkId);

$bd->close();
echo "Var dump de error: ";
var_dump($bd->getError());

header("Location:visualizar.php");
