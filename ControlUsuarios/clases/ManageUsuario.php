<?php

class ManageUsuario {

    private $bd = null;
    private $tabla = "usuarios";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($alias) {
        /*
         * Le pasamos el alias y tiene que hacer un return de un OBJETO de la clase Usuario cuyo alias coincida con el que le pasamos
         */
        $parametros = array();
        $parametros["alias"] = $alias;
        $condicion = "alias = :alias";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();

        $usuario = new Usuario($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6], $fila[7]);

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

    function setForAdmin(Usuario $usuario, $pkAlias) {
        /*
         * Update de todos los campos de los Usuario con privilegios admin y usará el alias como el where del update
         */
        
        $parametrosSet = array();
        $parametrosWhere = array();
    
        $parametrosSet['email'] = $usuario->getEmail();
        $parametrosSet['clave'] = $usuario->getClave();
        $parametrosSet['alias'] = $usuario->getAlias();
        $parametrosSet['fechaAlta'] = $usuario->getFechaalta();
        $parametrosSet['admin'] = $usuario->getAdministrador();
        $parametrosSet['personal'] = $usuario->getPersonal();
        $parametrosSet['activo'] = $usuario->getActivo();
        $parametrosSet['avatar'] = $usuario->getAvatar();
        
        $parametrosWhere['alias'] = $pkAlias;

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function setForUser(Usuario $usuario, $pkAlias) {
        /*
         * Update de los campos del Usuario sin privilegios admin y usará el nombre como el where del update
         */
        $parametrosSet = array();
        $parametrosWhere = array();

        $parametrosSet['email'] = $usuario->getEmail();
        $parametrosSet['clave'] = $usuario->getClave();
        $parametrosSet['avatar'] = $usuario->getAvatar();

        $parametrosWhere['alias'] = $pkAlias;

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Usuario $usuario) {
        /*
         * Se le pasa un objeto Usuario y lo inserta, debe devolver el alias del insertado.
         */
        $parametros = array();

        $parametros['email'] = $usuario->getEmail();   /* REGISTRO */
        $parametros['clave'] = $usuario->getClave();   /* REGISTRO */
        $parametros['alias'] = $usuario->getAlias();   /* REGISTRO */
        $parametros['admin'] = $usuario->getAdministrador(); /* DEFAULT 0 */
        $parametros['personal'] = $usuario->getPersonal(); /* DEFAULT 0 */
        $parametros['activo'] = $usuario->getActivo(); /* DEFAULT 0 */
        $parametros['avatar'] = $usuario->getAvatar(); /* DEFAULT "" */

        return $this->bd->insert($this->tabla, $parametros);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        //Valor predeterminado -> Constante, si se lo paso, coge el valor.

        $ordenPredeterminado = "$orden, email, alias, fechaAlta, admin, personal, activo, avatar";

        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "email, alias, fechaAlta, admin, personal, activo, avatar";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, "$registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $usuario = new Usuario();
            $usuario->set($fila);

            $r[] = $usuario;
        }
        return $r;//Devuelve un array de Usuarios
    }
    
    function getListPersonal($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        //Valor predeterminado -> Constante, si se lo paso, coge el valor.

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
        return $r;//Devuelve un array de Usuarios
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
