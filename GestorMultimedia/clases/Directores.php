<?php

class Directores {

    private $nombre;
    private $nacionalidad;

    function __construct($nombre = "", $nacionalidad = "") {
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNacionalidad() {
        return $this->nacionalidad;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    public function getJson() {
        $r = '{';

        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":"' . $valor . '",';
        }
        
        $r = substr($r, 0, -1);
        $r .= '}';
        
        return $r;
    }

    function set($valores, $inicio = 0) {
        $i = 0;
        
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i + $inicio];
            $i++;
        }
    }

    public function __toString() {
        $r = '';
        
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        
        return $r . "<br/>";
    }

}
