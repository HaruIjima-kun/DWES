<?php
include '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageDiscoDuro($bd);

$id = Request::get('id');

$discosDuros = $gestor->get($id);
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
            Id <input type="text" name="id" value="<?php echo $discosDuros->getId(); ?>" />
            <br/>
            Capacidad <input type="text" name="capacidad" value="<?php echo $discosDuros->getCapacidad(); ?>" />
            <br/>
            Fabricante <input type="text" name="fabricante" value="<?php echo $discosDuros->getFabricante(); ?>" />
            <br/>
            <input type="hidden" name="pkId" value="<?php echo $discosDuros->getId(); ?>" />
            <br/>
            <input type="submit" value="Aceptar" name="aceptar" />
        </form>
    </body>
</html>
