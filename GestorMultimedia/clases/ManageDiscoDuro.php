<?php

class ManageDiscoDuro {

    private $bd = null;
    private $tabla = "disco_duro";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($id) {
        /*
         * Le pasamos el ID y tiene que hacer un return de un OBJETO de la clase discoDuro cuyo id coincida con el que le pasamos
         */

        $parametros = array();
        $parametros["id"] = $id;

        $condicion = "id = :id";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);


        $fila = $this->bd->getRow();

        $discosDuros = new DiscoDuro($fila[0], $fila[1], $fila[2]);

        return $discosDuros;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($id) {
        /*
         * Debe borrar el disco duro que tenga el id pasado
         */

        $parametros = array();
        $parametros["id"] = $id;

        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteDiscosDuros($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(DiscoDuro $discosDuros) {
        /*
         * Devolver las filas borradas
         */
        return $this->delete($discosDuros->getId());
    }

    function set(DiscoDuro $discosDuros, $pkId) {
        /*
         * Update de todos los campos DiscoDuro menos el ID y usará el ID como el where del update
         */
        $parametrosSet = array();
        $parametrosWhere = array();
        
        $parametrosSet['id'] = $discosDuros->getId();
        $parametrosSet['capacidad'] = $discosDuros->getCapacidad();
        $parametrosSet['fabricante'] = $discosDuros->getFabricante();
        echo "pkId en set: $pkId <br/>";
        $parametrosWhere['id'] = $pkId;

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(DiscoDuro $discosDuros) {
        /*
         * Se le pasa un objeto DiscoDuro y lo inserta, debe devolver el ID del insertado.
         */

        $parametros = array();

        $parametros['id'] = $discosDuros->getId();
        $parametros['capacidad'] = $discosDuros->getCapacidad();
        $parametros['fabricante'] = $discosDuros->getFabricante();

        return $this->bd->insert($this->tabla, $parametros);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        //Valor predeterminado -> Constante, si se lo paso, coge el valor.

        $ordenPredeterminado = "$orden, id, capacidad, fabricante";

        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "id, capacidad, fabricante";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, " $registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $discosDuros = new DiscoDuro();
            $discosDuros->set($fila);

            $r[] = $discosDuros;
        }

        return $r;
        //Devuelve un array de DiscoDuro.
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "id", array(), "id");

        $array = array();

        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila [0];
        }

        return $array;
    }

}
