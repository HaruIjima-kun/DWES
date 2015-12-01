<?php
include '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageGeneros($bd);

$nombre = Request::get('nombre');

$generos = $gestor->get($nombre);
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
            Id: <input type="text" name="nombre" value="<?php echo $generos->getNombre(); ?>" />
            <input type="hidden" name="pkNombre" value="<?php echo $generos->getNombre(); ?>" />
            <br/>
            <input type="submit" value="Aceptar" name="aceptar" />
        </form>
    </body>
</html>
