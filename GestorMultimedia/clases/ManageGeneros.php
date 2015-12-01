<?php

class ManageGeneros {

    private $bd = null;
    private $tabla = "generos";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($nombre) {
        /*
         * Le pasamos el nombre y tiene que hacer un return de un OBJETO de la clase Generos
         *  cuyo nombre coincida con el que le pasamos.
         */
        $parametros = array();
        $parametros["nombre"] = $nombre;

        $condicion = "nombre = :nombre";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();

        $generos = new Generos($fila[0]);

        return $generos;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        /*
         * Devuelve las filas afectadas
         */
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($nombre) {
        /*
         * Debe borrar el género que tenga el nombre pasado
         */

        $parametros = array();
        $parametros["nombre"] = $nombre;

        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteGeneros($parametros) {
        /*
         * Borra los géneros pasados.
         */
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Generos $generos) {
        /*
         * Devolver las filas borradas
         */
        return $this->delete($generos->getNombre());
    }

    function set(Generos $generos, $pkNombre) {
        /*
         * Update de todos los campos nombre.
         */

        $parametrosSet = array();
        $parametrosWhere = array();

        $parametrosSet['nombre'] = $generos->getNombre();
        echo "pkNombre: $pkNombre";
        $parametrosWhere['nombre'] = $pkNombre;

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Generos $generos) {
        /*
         * Se le pasa un objeto generos y lo inserta, debe devolver el nombre del insertado.
         */

        $parametros = array();

        $parametros['nombre'] = $generos->getNombre();

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
            $generos = new Generos();
            $generos->set($fila);

            $r[] = $generos;
        }

        return $r; //Devuelve un array de generos.
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
