<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageDirectores($bd);

$pkNombre = Request::post('pkNombre');
$nombre = Request::post('nombre');
$nacionalidad = Request::post('nacionalidad');

$director = new Directores($nombre, $nacionalidad);
$r = $gestor->set($director, $pkNombre);

$bd->close();
var_dump($bd->getError());

header("Location:visualizar.php");
