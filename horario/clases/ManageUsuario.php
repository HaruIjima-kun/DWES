<?php

class ManageUsuario {

    private $bd = null;
    private $tabla = "usuarios";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($email) {
        $parametros = array();
        $parametros["email"] = $email;
        $condicion = "email = :email";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();

        $usuario = new Usuario($fila[0], $fila[1], $fila[2]);

        return $usuario;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($email) {
        /*
         * Debe borrar el Usuario que tenga el alias pasado
         */
        $parametros = array();
        $parametros["email"] = $email;

        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteUsuario($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Usuario $usuario) {
        /*
         * Devuelve las filas borradas
         */
        return $this->delete($usuario->getnombre());
    }
    
    function set(Usuario $usuario, $pkUsuario) {
        $parametros = $usuario->getArray();

        $parametrosWhere = array();

        $parametrosWhere['email'] = $pkUsuario;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "email", array(), "email");

        $array = array();

        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila [0];
        }

        return $array;
    }
    
    function getList($pagina = 1, $orden = "", $nrpp = Constant::NRPP) {
        //Valor predeterminado -> Constante, si se lo paso, coge el valor.

        $ordenPredeterminado = "$orden, email, nombre";

        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "email, nombre";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, "$registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $usuario = new Usuario();
            $usuario->set($fila);

            $r[] = $usuario;
        }
        return $r;
    }
    
    function getListJson($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        $lista = $this->getList($pagina, $orden, $nrpp, $condicion, $parametros);
        $r = "[ ";
        foreach ($lista as $objeto){
            $r .= $objeto->getJson() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

}
