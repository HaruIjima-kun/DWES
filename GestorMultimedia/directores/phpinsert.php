<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageDirectores($bd);

$nombre = Request::post('nombre');
$nacionalidad = Request::post('nacionalidad');

$directores = new Directores($nombre, $nacionalidad);

$r = $gestor->insert($directores);

$bd->close();
var_dump($bd->getError());

header("Location:visualizar.php");




