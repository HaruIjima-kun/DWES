<?php

require '../clases/AutoCarga.php';
$sesion = new Session();

$bd = new DataBase();
$gestor = new ManageUsuario($bd);

$emailTabla = Request::post("deleteTable");
$procedencia = Request::post("procedencia");

$userDelete = $gestor->delete($emailTabla);

$sesion->sendRedirect($procedencia . ".php");
