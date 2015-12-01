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
        <form action="phpedit.php" method="POST" enctype="multipart/form-data">
            Id: <input type="text" name="id" value="<?php echo $multimedias->getId(); ?>" />
            <br/>
            Título: <input type="text" name="titulo" value="<?php echo $multimedias->getTitulo(); ?>" />
            <br/>
            Título Original: <input type="text" name="titulo_original" value="<?php echo $multimedias->getTitulo_original(); ?>" />
            <br/>
            Año: <input type="text" name="anio" value="<?php echo $multimedias->getAnio(); ?>" />
            <br/>
            Número de Capítulos: <input type="text" name="numero_capitulos" value="<?php echo $multimedias->getNumero_capitulos(); ?>" />
            <br/>
            Número de Ovas: <input type="text" name="numero_ovas" value="<?php echo $multimedias->getNumero_ovas(); ?>" />
            <br/>
            Género: <?php echo Util::getSelect("genero", $gestorGeneros->getValuesSelect(), $multimedias->getGenero(), false) ?>
            <br/>
            Duración del capítulo: <input type="time" name="duracion_capitulo" value="<?php echo $multimedias->getDuracion_capitulo(); ?>" />
            <br/>
            Duración total: <input type="time" name="duracion_total" value="<?php echo $multimedias->getDuracion_total(); ?>" />
            <br/>
            Director: <?php echo Util::getSelect("director", $gestorDirectores->getValuesSelect(), $multimedias->getDirector(), false) ?>
            <br/>
            Fecha de estreno: <input type="date" name="f_estreno" value="<?php echo $multimedias->getF_estreno(); ?>" />
            <br/>
            Temporadas: <input type="text" name="temporadas" value="<?php echo $multimedias->getTemporadas(); ?>" />
            <br/>
            Tipo de multimedia: <?php echo Util::getSelect("tipo", $gestorTipoMultimedia->getValuesSelect(), $multimedias->getTipo(), false) ?>
            <br/>
            Disco duro: <?php echo Util::getSelect("hdd", $gestorDiscoDuro->getValuesSelect(), $multimedias->getHdd(), false) ?>
            <br/>
            Imagen de portada: <input type="file" name="img_portada" value="" />
            <br/>            
            <input type="hidden" name="pkId" value="<?php echo $multimedias->getId(); ?>" />
            <br/>
            <input type="submit" value="Aceptar" name="aceptar" />

        </form>
    </body>
</html>