<?php
require 'clases/AutoCarga.php';
$session = new Session();
$user = $session->get("user");
$correctas = $session->get("subidasOK");
$incorrectas = $session->get("subidasKO");
$direcPredeterminado = "C:/SAS_users/";
$carpetaUser = $direcPredeterminado . $user;
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        echo "<h1>Hola usuario: $user</h1>";
        echo "<ul>";

        $directorio = opendir($carpetaUser); //Ruta de la carpeta del Usuario
        while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
            if (!is_dir($archivo)) {//verificamos si es o no un directorio
                $directorioArchivo = $carpetaUser . "/" . $archivo;

                echo "<li><a href=" . $directorioArchivo . ">$archivo</a></li>";
            }
        }
        closedir($directorio);
        echo "</ul><br/><br/>";
        echo "<h2>Se han subido $correctas fotos de " . $session->get("archivosTotales") . "</h2></br>";
        echo "<h2>No se han subido $incorrectas fotos de " . $session->get("archivosTotales") . "</h2";
        ?>
    </body>
</html>
