<?php

class Imagenes {

    private $id, $email, $titulo, $descripcion, $imagen;

    function __construct($id = "", $email = "", $titulo = "", $descripcion = "", $imagen = "") {
        $this->id = $id;
        $this->email = $email;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
    }
    
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getImagen() {
        return $this->imagen;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getJson() {
        $r = '{';

        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":' . json_encode($valor) . ',';
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }

    public function __toString() {
        $r = '';
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return $r . "<br/>";
    }

    function set($valores, $inicio = 0) {
        $i = 0;

        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i + $inicio];
            $i++;
        }
    }

}
