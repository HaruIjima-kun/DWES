<?php

require '../clases/AutoCarga.php';

header('Contet-Type: application/json');

$sesion = new Session();

$no = json_encode(array('delete' => -1));

if ($sesion->isLogged()) {
    $bd = new DataBase();
    $gestor = new ManageReserva($bd);
    
    $id_reserva = Request::req("id_reserva");
    
   $condicion = '`id_reserva` like ' . $id_reserva . '';
    
    $existe = $gestor->count($condicion);
    
    if ($existe == 1) {
        $r = $gestor->delete($id_reserva);
        $bd->close();
        
        $respuesta = '{"delete":' . $r . '}';
    
        echo $respuesta;
    } else {
        echo $no;
        
    }
} else {
    echo $no;
}

