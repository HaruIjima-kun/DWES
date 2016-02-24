<!DOCTYPE html>
<!--
Página donde si un usuario intenta iniciar sesión sin estar activo, le notificará
que no está activo.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Usuario NO activo</h1>
        <h2>Se ha procedido a cerrar su sesión</h2>
        <?php
        // put your code here
        ?>
    </body>
</html>
<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$sesion->destroy();
?>