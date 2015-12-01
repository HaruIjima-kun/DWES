<?php
include '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageDirectores($bd);

$nombre = Request::get('nombre');

$directores = $gestor->get($nombre);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/estilosGenerales.css" type="text/css" />
    </head>
    <body>
        <form action="phpedit.php" method="POST">
            Nombre <input type="text" name="nombre" value="<?php echo $directores->getNombre(); ?>" />
            <br/>
            Nacionalidad <input type="text" name="nacionalidad" value="<?php echo $directores->getNacionalidad(); ?>" />
            <br/>
            <input type="hidden" name="pkNombre" value="<?php echo $directores->getNombre(); ?>" />
            <br/>
            <input type="submit" value="Aceptar" name="aceptar" />
        </form>
    </body>
</html>
