<?php

class ManageDirectores {

    private $bd = null;
    private $tabla = "directores";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($nombre) {
        /*
         * Le pasamos el nombre y tiene que hacer un return de un OBJETO de la clase Directores cuyo nombre coincida con el que le pasamos
         */
        $parametros = array();
        $parametros["nombre"] = $nombre;
        $condicion = "nombre = :nombre";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();

        $directores = new Directores($fila[0], $fila[1]);
        
        return $directores;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($nombre) {
        /*
         * Debe borrar la directores que tenga el nombre pasado
         */
        $parametros = array();
        $parametros["nombre"] = $nombre;

        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteDirectores($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Directores $directores) {
        /*
         * Devolver las filas borradas
         */
        return $this->delete($directores->getnombre());
    }

    function set(Directores $directores, $pkNombre) {
        /*
         * Update de todos los campos Directores menos el nombre y usará el nombre como el where del update
         */
        $parametrosSet = array();
        $parametrosWhere = array();

        $parametrosSet['nombre'] = $directores->getNombre();
        
        $parametrosSet['nacionalidad'] = $directores->getNacionalidad();

        $parametrosWhere['nombre'] = $pkNombre;

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Directores $directores) {
        /*
         * Se le pasa un objeto Directores y lo inserta, debe devolver el nombre del insertado.
         */
        $parametros = array();

        $parametros['nombre'] = $directores->getNombre();
        $parametros['nacionalidad'] = $directores->getNacionalidad();

        return $this->bd->insert($this->tabla, $parametros);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) { //Valor predeterminado -> Constante, si se lo paso, coge el valor.
        $ordenPredeterminado = "$orden, nombre, nacionalidad";

        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "nombre, nacionalidad";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, " $registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $directores = new Directores();
            $directores->set($fila);

            $r[] = $directores;
        }

        return $r; //Devuelve un array de directores.
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "nombre", array(), "nombre");

        $array = array();

        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila [0];
        }

        return $array;
    }

}
