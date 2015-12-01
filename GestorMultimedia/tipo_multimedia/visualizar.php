<?php
require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageTipoMultimedia($bd);
$page = Request::get("page");

$order = Request::get("order");
$sort = Request::get("sort");

$orden = "$order $sort";

$trozoEnlace = "";

if (trim($orden) !== "") {
    $trozoEnlace = "&order=$order&sort=$sort";
}

if ($page === null || $page === "") {
    $page = 1;
}
$registros = $gestor->count(); //Dice cuantos registros tenemos.

$pages = ceil($registros / Constants::NRPP);
/*
 *  Da el numero de páginas si la división es exacta. Con ceil devuelve el entero >= que el número que tenemos
 */

$tipos = $gestor->getList($page, trim($orden));

$op = Request::get('op');
$r = Request::get('r');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/estilosGenerales.css" type="text/css" />
        <title></title>
    </head>
    <body>
        <a href="insertar.php">Insertar tipos de multimedia</a>
        <table border="1">
            <thead>
                <tr>
                    <th>Id
                        <a href="?order=nombre&sort=desc">&Del;</a>
                        <a href="?order=nombre&sort=asc"> &Delta;</a>
                    </th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="?page=1<?= $trozoEnlace ?>">Primero</a>
                        <a href="?page=<?php echo max(1, $page - 1) . $trozoEnlace; ?>">Anterior</a>
                        <a href="?page=<?php echo min($page + 1, $pages) . $trozoEnlace; ?>">Siguiente</a>
                        <a href="?page=<?php echo $pages . $trozoEnlace; ?>">Último</a>
                        <form style="display: inline;" action="?<?= $trozoEnlace; ?>">
                            <?php
                            $array = ["10" => "10", "50" => "50", "100" => "100"];
                            echo Util::getSelect("rpp", $array, 10, false);
                            ?>
                            <input type="submit" value="ver" />
                        </form>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($tipos as $indice => $tipo) { ?>
                    <tr>
                        <td><?= $tipo->getNombre(); ?></td>
                        <td>
                            <a class='borrar' href="phpdelete.php?nombre=<?= $tipo->getNombre(); ?>">Borrar</a>
                            <a href='editar.php?nombre=<?= $tipo->getNombre(); ?>'>Editar</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <script src="../js/javascript.js"></script>
    </body>
</html>
<?php
$bd->close();
?>

