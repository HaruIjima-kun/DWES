<?php
require '../clases/AutoCarga.php';
$sesion = new Session(); //
/*
 * Comprobamos que la sesión está iniciada, si no lo está, volvemos al inicio de sesión.
 */
if (!$sesion->isLogged()) {
    $sesion->sendRedirect("../login.php");
    exit();
}

/*
 * Obtenemos el nombre del usuario para su posterior utilización.
 */

$user = $sesion->getUser();

/*
 * Comprobamos si la carpeta del usuario y usuarios existe, si no existe, creará 
 * la carpeta usuarios y la carpeta del usuario a la vez.
 */

$carpetaUser = '../usuarios/' . $user;

if (!file_exists($carpetaUser)) {
    mkdir($carpetaUser, 0777, true);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/estilos1.css" />
        <title></title>
    </head>
    <body id="aplicacion">
        <div id="centrar">
            <h1> Bienvenido a su PodCast: <?php echo $user ?> </h1>
            <hr/>
            <div id="form_subida">
                <form action="subirArchivo.php" method="post"
                      enctype="multipart/form-data">
                    <input type="file" name="subir_archivo" value="" />
                    <br/>
                    <br/>
                    <label>Elija la categoría de su canción: </label>
                    <select name="categoria" required="" >
                        <option>Rock</option>
                        <option>Heavy</option>
                        <option>Pop</option>
                        <option>Jazz</option>
                        <option>Clasica</option>
                        <option selected="">Otro</option>
                    </select>
                    <br/>
                    <br/>
                    <input type="submit" value="Aceptar" name="aceptar" />
                </form>
                <br/>
            </div>
            <div id="lista_canciones">
                <?php
                echo "<ul>";

                $directorio = opendir($carpetaUser); //Ruta de la carpeta del Usuario
                while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
                    if (!is_dir($archivo)) {//verificamos si es o no un directorio
                        $nombreArchivo = str_replace(".mp3", "", $archivo);
                        $nombreArchivo = substr($nombreArchivo, 0, strpos($nombreArchivo, "_"));
                        echo "<li> <span class='nombre_canciones'>" . $nombreArchivo . "</span> <audio controls> <source src='" . $carpetaUser . "/" . $archivo . "'" . " type='audio/mpeg' class='align_controls'> </audio></li>";
                    }
                }
                closedir($directorio);
                echo "</ul><br/><br/>";
                ?>
            </div>
            <div id="lista_Categoria">
                <?php
                $rock = 0;
                $heavy = 0;
                $pop = 0;
                $jazz = 0;
                $clasica = 0;
                $otro = 0;
                $directorio = opendir($carpetaUser);
                while ($archivo = readdir($directorio)) {
                    if (strpos($archivo, "_Rock")) {
                        $rock++;
                    } else if (strpos($archivo, "_Heavy")) {
                        $heavy++;
                    } else if (strpos($archivo, "_Pop")) {
                        $pop++;
                    } else if (strpos($archivo, "_Jazz")) {
                        $jazz++;
                    } else if (strpos($archivo, "_Clasica")) {
                        $clasica++;
                    } else if (strpos($archivo, "_Otro")) {
                        $otro++;
                    }
                }

                echo "<span>¡" . $user . "! Este es tu listado de canciones por Categoría</span>";
                echo "<ul>" .
                "<li>Tienes " . $rock . " cancion(es) de Rock.</li>" .
                "<li>Tienes " . $heavy . " cancion(es) de Heavy.</li>" .
                "<li>Tienes " . $pop . " cancion(es) de Pop.</li>" .
                "<li>Tienes " . $jazz . " cancion(es) de Jazz.</li>" .
                "<li>Tienes " . $clasica . " cancion(es) de Clasica.</li>" .
                "<li>Tienes " . $otro . " cancion(es) de Otros.</li>";
                echo "</ul>";
                closedir($directorio);
                ?>
            </div>
        </div>
    </body>
</html>