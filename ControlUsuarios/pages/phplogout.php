<?php

/*
 * En este archivo simplemente se cierra la sesión. Básicamente cuando se le da al
 * botón de cerrar sesión.
 */

require '../clases/AutoCarga.php';

$sesion = new Session();
$sesion->destroy();
$sesion->sendRedirect("../index.php");
