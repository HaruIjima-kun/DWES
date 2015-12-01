<?php
include '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageTipoMultimedia($bd);

$nombre = Request::get('nombre');

$tipos = $gestor->get($nombre);
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
            Id: <input type="text" name="nombre" value="<?php echo $tipos->getNombre(); ?>" />
            <input type="hidden" name="pkNombre" value="<?php echo $tipos->getNombre(); ?>" />
            <br/>
            <input type="submit" value="Aceptar" name="aceptar" />
        </form>
    </body>
</html>
