<?php
include '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageMultimedia($bd);

$id = Request::get('id');

$multimedias = $gestor->get($id);

$gestorDirectores = new ManageDirectores($bd);
$gestorDiscoDuro = new ManageDiscoDuro($bd);
$gestorGeneros = new ManageGeneros($bd);
$gestorTipoMultimedia = new ManageTipoMultimedia($bd);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/estilosGenerales.css" type="text/css" />
    </head>
    <body>
        <form action="phpinsert.php" method="POST" enctype="multipart/form-data">
            Título: <input type="text" name="titulo" value="" />
            <br/>
            Título Original: <input type="text" name="titulo_original" value="" />
            <br/>
            Año: <input type="text" name="anio" value="" />
            <br/>
            Número de Capítulos: <input type="text" name="numero_capitulos" value="" />
            <br/>
            Número de Ovas: <input type="text" name="numero_ovas" value="" />
            <br/>
            Género: <?php echo Util::getSelect("genero", $gestorGeneros->getValuesSelect(), $multimedias->getGenero(), false) ?>
            <br/>
            Duración del capítulo: <input type="time" name="duracion_capitulo" value="" />
            <br/>
            Duración total: <input type="time" name="duracion_total" value="" />
            <br/>
            Director: <?php echo Util::getSelect("director", $gestorDirectores->getValuesSelect(), $multimedias->getDirector(), false) ?>
            <br/>
            Fecha de estreno: <input type="date" name="f_estreno" value="" />
            <br/>
            Temporadas: <input type="text" name="temporadas" value="" />
            <br/>
            Tipo de multimedia: <?php echo Util::getSelect("tipo", $gestorTipoMultimedia->getValuesSelect(), $multimedias->getTipo(), false) ?>
            <br/>
            Disco duro: <?php echo Util::getSelect("hdd", $gestorDiscoDuro->getValuesSelect(), $multimedias->getHdd(), false) ?>
            <br/>
            Imagen de portada: <input type="file" name="img_portada" value="" />
            <br/>
            <input type="submit" value="Aceptar" name="aceptar" />

        </form>
    </body>
</html>
