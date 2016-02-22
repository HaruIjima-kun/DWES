<?php

class ManageReserva {

    private $bd = null;
    private $tabla = "reservas";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($nombre) {
        $parametros = array();
        $parametros["nombre"] = $nombre;
        $condicion = "nombre = :nombre";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();

        $reserva = new Reservas($fila[0], $fila[1], $fila[2], $fila[3]);

        return $reserva;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($id_reserva) {
        $parametros = array();
        $parametros["id_reserva"] = $id_reserva;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteReserva($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Reservas $reserva) {
        /*
         * Devuelve las filas borradas
         */
        return $this->delete($reserva->getId_reserva());
    }
    
    function insert(Reservas $reserva) {
        $parametros = array();

        $parametros['nombre'] = $reserva->getNombre();
        $parametros['dia'] = $reserva->getDia();
        $parametros['hora'] = $reserva->getHora();
        
        return $this->bd->insert($this->tabla, $parametros);
    }
    
    function set(Reservas $reserva, $pkReserva) {
        $parametros = $reserva->getArray();

        $parametrosWhere = array();

        $parametrosWhere['id_reserva'] = $pkReserva;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "nombre", array(), "nombre");

        $array = array();

        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila [0];
        }

        return $array;
    }
    
    function getList($pagina = 1, $orden = "", $nrpp = Constant::NRPP) {
        //Valor predeterminado -> Constante, si se lo paso, coge el valor.

        $ordenPredeterminado = "$orden, id_reserva, nombre, dia, hora";

        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "id_reserva, nombre, dia, hora";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, "$registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $reserva = new Reservas();
            $reserva->set($fila);

            $r[] = $reserva;
        }
        return $r;
    }
    
    function getListJson($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        $lista = $this->getList($pagina, $orden, $nrpp, $condicion, $parametros);
        $r = "[ ";
        foreach ($lista as $objeto){
            $r .= $objeto->getJson() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

}
