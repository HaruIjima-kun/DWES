<?php

/*
 * En este archivo se procede al inicio de sesión en la base de datos con un usuario
 * que se encuentre en la misma, se comprueba qué permisos tiene y en función de eso,
 * lo lleva a su página de administración correspondiente, o a la página de error.
 */

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

if ($procedencia === "registro") {
    $email = Request::post("email");
} else {
    /*     * * Recogida de datos del formulario * * */

    $alias = Request::post("user");
    $password = Request::post("password");

    /*     * * Encriptación de la contraseña * * */

    $passEncriptada = encriptarSHA1($password);

    /*     * * Consulta a la base de datos y almacenamiento de los datos en variables * * */

    /*
     * Comprueba que el usuario existe en la base de datos, si existe recoge los datos devueltos,
     * si no existe, lo devuelve a la página del login, posteriormente sería interesante añadir
     * mensajes en el login si la contraseña no es correcta, si el usuario no existe...
     */

    $existe = $gestor->count('alias like "' . $alias . '"');

    if ($existe == 1) {
        $sqlUsuario = $gestor->get($alias);
        $sqlAlias = $sqlUsuario->getAlias();            // Alias
        $sqlPass = $sqlUsuario->getClave();             // Clave
        if ($passEncriptada === $sqlPass && $alias === $sqlAlias) {
            $sqlEmail = $sqlUsuario->getEmail();            // Email
            $sqlAlias = $sqlUsuario->getAlias();            // Alias
            $sqlPass = $sqlUsuario->getClave();             // Clave
            $sqlFechaRegistro = $sqlUsuario->getFechaalta(); // Fecha alta
            $sqlAdmin = $sqlUsuario->getAdministrador();    // Admin?
            $sqlPersonal = $sqlUsuario->getPersonal();      // Personal?
            $sqlActivo = $sqlUsuario->getActivo();          // Activo?
            $sqlAvatar = $sqlUsuario->getAvatar();          // Avatar

            $usuario = new Usuario($sqlEmail, $sqlPass, $sqlAlias, $sqlFechaRegistro, $sqlAdmin, $sqlPersonal, $sqlActivo, $sqlAvatar);
            $sesion->setUser($usuario);
            $sesion->sendRedirect("phpControl.php");
        } else {
            $sesion->destroy();
            $sesion->sendRedirect("../index.php");
        }
    } else {
        $sesion->destroy();
        $sesion->sendRedirect("../index.php");
    }
}

function encriptarSHA1($cad) {
    return sha1($cad);
}
