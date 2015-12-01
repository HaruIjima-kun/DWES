<?php

class Multimedia {

    private $id, $titulo, $titulo_original, $anio, $numero_capitulos, $numero_ovas, $genero,
            $duracion_capitulo, $duracion_total, $director, $f_estreno, $temporadas, $tipo,
            $img_portada, $hdd;

    function __construct($id = "", $titulo = "", $titulo_original = "", $anio = "", $numero_capitulos = "", $numero_ovas = "", $genero = "", $duracion_capitulo = "", $duracion_total = "", $director = "", $f_estreno = "", $temporadas = "", $tipo = "", $img_portada = "", $hdd = "") {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->titulo_original = $titulo_original;
        $this->anio = $anio;
        $this->numero_capitulos = $numero_capitulos;
        $this->numero_ovas = $numero_ovas;
        $this->genero = $genero;
        $this->duracion_capitulo = $duracion_capitulo;
        $this->duracion_total = $duracion_total;
        $this->director = $director;
        $this->f_estreno = $f_estreno;
        $this->temporadas = $temporadas;
        $this->tipo = $tipo;
        $this->img_portada = $img_portada;
        $this->hdd = $hdd;
    }

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getTitulo_original() {
        return $this->titulo_original;
    }

    function getAnio() {
        return $this->anio;
    }

    function getNumero_capitulos() {
        return $this->numero_capitulos;
    }

    function getNumero_ovas() {
        return $this->numero_ovas;
    }

    function getGenero() {
        return $this->genero;
    }

    function getDuracion_capitulo() {
        return $this->duracion_capitulo;
    }

    function getDuracion_total() {
        return $this->duracion_total;
    }

    function getDirector() {
        return $this->director;
    }

    function getF_estreno() {
        return $this->f_estreno;
    }

    function getTemporadas() {
        return $this->temporadas;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getImg_portada() {
        return $this->img_portada;
    }

    function getHdd() {
        return $this->hdd;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setTitulo_original($titulo_original) {
        $this->titulo_original = $titulo_original;
    }

    function setAnio($anio) {
        $this->anio = $anio;
    }

    function setNumero_capitulos($numero_capitulos) {
        $this->numero_capitulos = $numero_capitulos;
    }

    function setNumero_ovas($numero_ovas) {
        $this->numero_ovas = $numero_ovas;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setDuracion_capitulo($duracion_capitulo) {
        $this->duracion_capitulo = $duracion_capitulo;
    }

    function setDuracion_total($duracion_total) {
        $this->duracion_total = $duracion_total;
    }

    function setDirector($director) {
        $this->director = $director;
    }

    function setF_estreno($f_estreno) {
        $this->f_estreno = $f_estreno;
    }

    function setTemporadas($temporadas) {
        $this->temporadas = $temporadas;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setImg_portada($img_portada) {
        $this->img_portada = $img_portada;
    }

    function setHdd($hdd) {
        $this->hdd = $hdd;
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
