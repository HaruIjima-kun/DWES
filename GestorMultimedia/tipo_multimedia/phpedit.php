<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageTipoMultimedia($bd);

$pkNombre = Request::post('pkNombre');
$nombre = Request::post('nombre');

echo "Esto es phpedit el pknombre es: $pkNombre y el nombre es: $nombre";

$tipo = new TipoMultimedia($nombre);
$r = $gestor->set($tipo, $pkNombre);

$bd->close();
var_dump($bd->getError());

header("Location:visualizar.php");
