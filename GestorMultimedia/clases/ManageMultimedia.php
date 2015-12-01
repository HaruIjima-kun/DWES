<?php

class ManageMultimedia {

    private $bd = null;
    private $tabla = "multimedia";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($id) {
        /*
         * Le pasamos el ID y tiene que hacer un return de un OBJETO de la clase Multimedia cuyo id coincida con el que le pasamos
         */

        $parametros = array();
        $parametros["id"] = $id;

        $condicion = "id = :id";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();

        $multimedia = new Multimedia($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6], $fila[7], $fila[8], $fila[9], $fila[10], $fila[11], $fila[12], $fila[13], $fila[14]);

        return $multimedia;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($id) {
        /*
         * Debe borrar el registro que tenga el ID pasado
         */

        $parametros = array();
        $parametros["id"] = $id;

        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteMultimedias($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Multimedia $multimedia) {
        /*
         * Devolver las filas borradas
         */
        return $this->delete($multimedia->getId());
    }

    function set(Multimedia $multimedia) {
        /*
         * Update de todos los campos multimedia menos el ID y usará el ID como el where del update
         */
        $parametrosSet = array();
        $parametrosWhere = array();

        $parametrosSet['titulo'] = $multimedia->getTitulo();
        $parametrosSet['titulo_original'] = $multimedia->getTitulo_original();
        $parametrosSet['anio'] = $multimedia->getAnio();
        $parametrosSet['numero_capitulos'] = $multimedia->getNumero_capitulos();
        $parametrosSet['numero_ovas'] = $multimedia->getNumero_ovas();
        $parametrosSet['genero'] = $multimedia->getGenero();
        $parametrosSet['duracion_capitulo'] = $multimedia->getDuracion_capitulo();
        $parametrosSet['duracion_total'] = $multimedia->getDuracion_total();
        $parametrosSet['director'] = $multimedia->getDirector();
        $parametrosSet['f_estreno'] = $multimedia->getF_estreno();
        $parametrosSet['temporadas'] = $multimedia->getTemporadas();
        $parametrosSet['tipo'] = $multimedia->getTipo();
        $parametrosSet['img_portada'] = $multimedia->getImg_portada();
        $parametrosSet['hdd'] = $multimedia->getHdd();

        $parametrosWhere['id'] = $multimedia->getId();

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Multimedia $multimedia) {
        /*
         * Se le pasa un objeto multimedia y lo inserta, debe devolver el ID del insertado.
         */
        $parametros = array();

        $parametros['titulo'] = $multimedia->getTitulo();
        $parametros['titulo_original'] = $multimedia->getTitulo_original();
        $parametros['anio'] = $multimedia->getAnio();
        $parametros['numero_capitulos'] = $multimedia->getNumero_capitulos();
        $parametros['numero_ovas'] = $multimedia->getNumero_ovas();
        $parametros['genero'] = $multimedia->getGenero();
        $parametros['duracion_capitulo'] = $multimedia->getDuracion_capitulo();
        $parametros['duracion_total'] = $multimedia->getDuracion_total();
        $parametros['director'] = $multimedia->getDirector();
        $parametros['f_estreno'] = $multimedia->getF_estreno();
        $parametros['temporadas'] = $multimedia->getTemporadas();
        $parametros['tipo'] = $multimedia->getTipo();
        $parametros['img_portada'] = $multimedia->getImg_portada();
        $parametros['hdd'] = $multimedia->getHdd();

        return $this->bd->insert($this->tabla, $parametros);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        //Valor predeterminado -> Constante, si se lo paso, coge el valor.
        $ordenPredeterminado = "$orden, id, titulo, titulo_original, anio, numero_capitulos";

        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "id, titulo, titulo_original, anio, numero_capitulos";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, " $registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $multimedia = new Multimedia();
            $multimedia->set($fila);

            $r[] = $multimedia;
        }

        return $r; //Devuelve un array de multimedia.
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "id, titulo", array(), "titulo");

        $array = array();

        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila [1];
        }

        return $array;
    }

}
