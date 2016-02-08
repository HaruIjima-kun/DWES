<?php

require 'AutoCarga.php';

class Paginacion {

    private $registros, $rpp, $paginaActual;

    function __construct($registros, $rpp = Constants::NRPP, $paginaActual = 1) {
        if ($rpp === null) {
            $rpp = Constants::NRPP;
        }
        if ($paginaActual === null) {
            $paginaActual = 1;
        }

        $this->registros = $registros;
        $this->rpp = $rpp;
        $this->paginaActual = $paginaActual;
    }

    function getRegistros() {
        return $this->registros;
    }

    function getRpp() {
        return $this->rpp;
    }

    function getPaginaActual() {
        return $this->paginaActual;
    }

    function getPrimera() {
        return 1;
    }

    function getAnterior() {
        // return max(1, $this->paginaActual-1); Esta es la forma correcta
        return $this->paginaActual - 1;
    }

    function getSelect($id, $name = null) {
        /*
         * Selecciona el número de registros por página.
         * Construye el botón básicamente, o el Select (options)
         */

        if ($name === null) {
            $name = $id;
        }

        $array = array(10 => "10", 50 => "50", 100 => "100");
        return Util::getSelect($name, $array, $this->rpp, false, "", $id);
    }

    function getSiguiente() {
        //return min($this->getPaginas(), $this->paginaActual+1);
        return $this->paginaActual + 1;
    }

    function getPaginas() {
        return ceil($this->registros / $this->rpp);
    }

    function setRegistros($registros) {
        $this->registros = $registros;
    }

    function setRpp($rpp) {
        $this->rpp = $rpp;
    }

    function setPaginaActual($paginaActual) {
        $this->paginaActual = $paginaActual;
    }

    function getEnlacesPaginas($rango, $enlace, $nombreParametroPagina, $pagina = 0) {
        
    }
    
    
}
