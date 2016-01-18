<?php

class QueryString {

    private $params;

    function __construct() {
        /*
         * La forma más intuitiva de hacer el constructor de esta clase, es recoger
         * en un array la variable $_GET, el cual es un array asociativo con todos
         * los elementos de un QueryString (url).
         */
        $this->params = $_GET;
    }

    function get($nombre) {
        /*
         * Le pasamos el nombre del parámetro y devuelve el valor.
         */
        return $_GET["$nombre"];
    }

    function getParamsWithout($parametrosDelete) {
        /*
         * Elimina los parámetros indicados.
         */
        return $this->getParams(array(), $parametrosDelete);
    }

    function getParams($parametrosAdd = array(), $parametrosDelete = array()) {
        /*
         * Pasamos dos arrays, uno con todos los parámetros que queremos añadir,
         * y otro con todos los parámetros que deseamos quitar del QueryString
         */
        //Para borrar un índice de un array es unset
        $copia = $this->params;
        
        foreach ($parametrosDelete as $parametro => $valor) {
            unset($copia[$parametro]);
        }

        foreach ($parametrosAdd as $$parametro => $valor) {
            $copia[$parametro] = $valor;
        }
        $r = "";

        foreach ($copia as $parametro => $valor) {
            $r .= $parametro . "=" . urlencode($valor) . "&";
        }

        return substr($r, 0, -1);
    }

    function set($nombre, $valor) {
        /*
         * Añadimos nuevos parámetros, asignándole el nombre del parámetro y el valor del mismo.
         */
    }

    function delete($nombre) {
        /*
         * Borra elementos del QueryString.
         */
    }

    function __toString() {
        /*
         * Devuelve la cadena QueryString sin interrogación (es decir, la url, y todos concatenados con &
         */
    }

}
