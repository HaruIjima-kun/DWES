<?php

class DiscoDuro {

    private $id, $capacidad, $fabricante;

    function __construct($id = null, $capacidad = null, $fabricante = null) {
        $this->id = $id;
        $this->capacidad = $capacidad;
        $this->fabricante = $fabricante;
    }

    function getId() {
        return $this->id;
    }

    function getCapacidad() {
        return $this->capacidad;
    }

    function getFabricante() {
        return $this->fabricante;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCapacidad($capacidad) {
        $this->capacidad = $capacidad;
    }

    function setFabricante($fabricante) {
        $this->fabricante = $fabricante;
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
