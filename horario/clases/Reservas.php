<?php

class Reservas {

    private $id_reserva, $nombre, $dia, $hora;

    function __construct($id_reserva = "", $nombre = "", $dia = "", $hora = "") {
        $this->id_reserva = $id_reserva;
        $this->nombre = $nombre;
        $this->dia = $dia;
        $this->hora = $hora;
    }

    function getId_reserva() {
        return $this->id_reserva;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDia() {
        return $this->dia;
    }

    function getHora() {
        return $this->hora;
    }

    function setId_reserva($id_reserva) {
        $this->id_reserva = $id_reserva;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDia($dia) {
        $this->dia = $dia;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    public function getJson() {
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":' . json_encode($valor) . ',';
        }
        $r = substr($r, 0, -1);
        $r .='}';
        return $r;
    }
    
    function set($valores, $inicio = 0) {
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i + $inicio];
            $i++;
        }
    }

}
