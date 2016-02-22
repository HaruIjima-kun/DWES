<?php

require '../clases/AutoCarga.php';

header('Contet-Type: application/json');

$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageReserva($bd);
$profesor = new ManageUsuario($bd);

$no = json_encode(array('updateHorario' => -1));

$r = $gestor->getListJson();
$res = $profesor->getListJson();

$bd->close();

$respuesta = '{"updateHorario":' . $r . '}';

echo $respuesta;

