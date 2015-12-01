<?php

class ManageTipoMultimedia {

    private $bd = null;
    private $tabla = "tipo_multimedia";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($nombre) {
        /*
         * Le pasamos el nombre y tiene que hacer un return de un OBJETO de la clase TipoMultimedia cuyo nombre coincida con el que le pasamos
         */

        $parametros = array();
        $parametros["nombre"] = $nombre;

        $condicion = "nombre = :nombre";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);


        $fila = $this->bd->getRow();

        $tipoMultimedia = new TipoMultimedia($fila[0]);

        //$ciudad->set($fila);

        return $tipoMultimedia;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($nombre) {
        /*
         * Debe borrar la ciudad que tenga el nombre pasado
         */

        $parametros = array();
        $parametros["nombre"] = $nombre;

        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteTiposMultimedia($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(TipoMultimedia $tipoMultimedia) {
        /*
         * Devolver las filas borradas
         */
        return $this->delete($tipoMultimedia->getNombre());
    }

    function set(TipoMultimedia $tipoMultimedia, $pkNombre) {
        /*
         * Update de todos los campos city menos el ID y usará el ID como el where del update
         */
        $parametrosSet = array();
        $parametrosWhere = array();

        $parametrosSet['nombre'] = $tipoMultimedia->getNombre();

        $parametrosWhere['nombre'] = $pkNombre;

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(TipoMultimedia $tipoMultimedia) {
        /*
         * Se le pasa un objeto city y lo inserta, debe devolver el ID del insertado.
         */
        $parametros = array();

        $parametros['nombre'] = $tipoMultimedia->getNombre();

        return $this->bd->insert($this->tabla, $parametros);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        //Valor predeterminado -> Constante, si se lo paso, coge el valor.
        $ordenPredeterminado = "$orden, nombre";

        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "nombre";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, " $registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $tipoMultimedia = new TipoMultimedia();
            $tipoMultimedia->set($fila);

            $r[] = $tipoMultimedia;
        }

        return $r; //Devuelve un array de tipo de multimedia.
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
