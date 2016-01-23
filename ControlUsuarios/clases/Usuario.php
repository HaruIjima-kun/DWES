<?php

class Usuario {

    private $email, $clave, $alias, $fechaalta, $activo, $administrador, $personal, $avatar;

    function __construct($email = "", $clave = "", $alias = "", $fechaalta = "", $administrador = "0", $personal = "0", $activo = "0", $avatar = "../dist/img/avatar2.png") {
        $this->email = $email;
        $this->clave = $clave;
        $this->alias = $alias;
        $this->fechaalta = $fechaalta;
        $this->administrador = $administrador;
        $this->personal = $personal;
        $this->activo = $activo;
        $this->avatar = $avatar;
    }

    function getEmail() {
        return $this->email;
    }

    function getClave() {
        return $this->clave;
    }

    function getAlias() {
        return $this->alias;
    }

    function getFechaalta() {
        return $this->fechaalta;
    }

    function getActivo() {
        return $this->activo;
    }

    function getAdministrador() {
        return $this->administrador;
    }

    function getPersonal() {
        return $this->personal;
    }

    function getAvatar() {
        return $this->avatar;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setAlias($alias) {
        $this->alias = $alias;
    }

    function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }

    function setPersonal($personal) {
        $this->personal = $personal;
    }

    function setAvatar($avatar) {
        $this->avatar = $avatar;
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
