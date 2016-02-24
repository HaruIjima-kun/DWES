<?php

require '../clases/AutoCarga.php';

header('Contet-Type: application/json');

$sesion = new Session();

$no = json_encode(array('insert' => -1));

if ($sesion->isLogged()) {
    $bd = new DataBase();
    $gestor = new ManageReserva($bd);
    
    $dia = Request::req("dia");
    $hora = Request::req("hora");
    $nombre = Request::req("nombre");
    $email = Request::req("email");
    
    $condicion = 'dia like "' . $dia . '" and hora like "' . $hora . '" and nombre like "' . $nombre . '"';
    
    $condicionExistencia = 'dia like "' . $dia . '" and hora like "' . $hora . '"';
    
    $existe = $gestor->count($condicion);
    $existeDuplicado = $gestor->count($condicionExistencia);
    if ($existe == 0 && $existeDuplicado == 0) {
        $reserva = new Reservas("", $nombre, $dia, $hora);
        $r = $gestor->insert($reserva);
        $bd->close();
        
        $respuesta = '{"insert":' . $r . '}';
    
        echo $respuesta;
    } else {
        echo $no;
    }
} else {
    echo $no;
}