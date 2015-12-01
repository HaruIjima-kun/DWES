<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageDirectores($bd);

$nombre = Request::get('nombre');
$gestor->delete($nombre);

$bd->close();

header("Location:visualizar.php");
