<?php

class ManageImagenes {

    private $bd = null;
    private $tabla = "imagenes";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($email) {
        $parametros = array();
        $parametros["email"] = $email;
        $condicion = "email = :email";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();

        $imagenes = new Imagenes($fila[0], $fila[1], $fila[2], $fila[3]);

        return $imagenes;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($email) {
        $parametros = array();
        $parametros["email"] = $email;

        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteImagen($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Imagenes $imagen) {
        return $this->delete($imagen->getnombre());
    }

    function setImagen(Imagenes $imagen, $pkEmail) {
        $parametrosSet = array();
        $parametrosWhere = array();
    
        $parametrosSet['email'] = $imagen->getEmail();
        $parametrosSet['titulo'] = $imagen->getTitulo();
        $parametrosSet['descripcion'] = $imagen->getDescripcion();
        $parametrosSet['imagen'] = $imagen->getImagen();
        
        $parametrosWhere['email'] = $pkAlias;

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }
    
    function insert(Imagenes $imagen) {
        $parametros = array();

        $parametros['email'] = $imagen->getEmail();
        $parametros['titulo'] = $imagen->getTitulo();
        $parametros['descripcion'] = $imagen->getDescripcion();
        $parametros['imagen'] = $imagen->getImagen();

        return $this->bd->insert($this->tabla, $parametros);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        $ordenPredeterminado = "$orden, email, titulo, descripcion, imagen";

        if ($orden === "" || $orden === null) {
             $ordenPredeterminado = "email, titulo, descripcion, imagen";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, "$registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $imagen = new Usuario();
            $imagen->set($fila);

            $r[] = $imagen;
        }
        return $r;//Devuelve un array de Imagenes
    }
    
    function getListPersonal($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        $ordenPredeterminado = "$orden, email, alias, fechaAlta, admin, personal, activo, avatar";

        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "email, alias, fechaAlta, admin, personal, activo, avatar";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "admin not like 1", array(), $ordenPredeterminado, "$registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $usuario = new Usuario();
            $usuario->set($fila);

            $r[] = $usuario;
        }
        return $r;
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
