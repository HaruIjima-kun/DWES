<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageDiscoDuro($bd);

$id = Request::get('id');
$gestor->delete($id);

$bd->close();

header("Location:visualizar.php");
