<?php
require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageMultimedia($bd);
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

$multimedias = $gestor->getList($page, trim($orden));

$op = Request::get('op');
$r = Request::get('r');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../css/estilosGenerales.css" type="text/css" />
    </head>
    <body>
        <a href="insertar.php">Insertar tipos de multimedia</a>
        <table border="1">
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Id
                        <a href="?order=nombre&sort=desc">&Del;</a>
                        <a href="?order=nombre&sort=asc"> &Delta;</a>
                    </th>
                    <th>Título
                        <a href="?order=titulo&sort=desc">&Del;</a>
                        <a href="?order=titulo&sort=asc"> &Delta;</a>
                    </th>
                    <th>Título Original
                        <a href="?order=titulo_original&sort=desc">&Del;</a>
                        <a href="?order=titulo_original&sort=asc"> &Delta;</a>
                    </th>
                    <th>Año
                        <a href="?order=anio&sort=desc">&Del;</a>
                        <a href="?order=anio&sort=asc"> &Delta;</a>
                    </th>
                    <th>Número de Capítulos
                        <a href="?order=numero_capitulos&sort=desc">&Del;</a>
                        <a href="?order=numero_capitulos&sort=asc"> &Delta;</a>
                    </th>
                    <th>Número de ovas
                        <a href="?order=numero_ovas&sort=desc">&Del;</a>
                        <a href="?order=numero_ovas&sort=asc"> &Delta;</a>
                    </th>
                    <th>Género
                        <a href="?order=genero&sort=desc">&Del;</a>
                        <a href="?order=genero&sort=asc"> &Delta;</a>
                    </th>
                    <th>Duración del capítulo
                        <a href="?order=duracion_capitulo&sort=desc">&Del;</a>
                        <a href="?order=duracion_capitulo&sort=asc"> &Delta;</a>
                    </th>
                    <th>Duración total
                        <a href="?order=duracion_total&sort=desc">&Del;</a>
                        <a href="?order=duracion_total&sort=asc"> &Delta;</a>
                    </th>
                    <th>Director
                        <a href="?order=director&sort=desc">&Del;</a>
                        <a href="?order=director&sort=asc"> &Delta;</a>
                    </th>
                    <th>Fecha de estreno
                        <a href="?order=f_estreno&sort=desc">&Del;</a>
                        <a href="?order=f_estreno&sort=asc"> &Delta;</a>
                    </th>
                    <th>Temporadas
                        <a href="?order=temporadas&sort=desc">&Del;</a>
                        <a href="?order=temporadas&sort=asc"> &Delta;</a>
                    </th>
                    <th>Tipo
                        <a href="?order=tipo&sort=desc">&Del;</a>
                        <a href="?order=tipo&sort=asc"> &Delta;</a>
                    </th>
                    <th>Disco Duro
                        <a href="?order=hdd&sort=desc">&Del;</a>
                        <a href="?order=hdd&sort=asc"> &Delta;</a>
                    </th>

                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="16">
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
                <?php foreach ($multimedias as $indice => $multimedia) { ?>
                    <tr>
                        <td><figure><img src="<?php echo $multimedia->getImg_portada(); ?>" /></figure></td>
                        <td><?= $multimedia->getId(); ?></td>
                        <td><?= $multimedia->getTitulo(); ?></td>
                        <td><?= $multimedia->getTitulo_original(); ?></td>
                        <td><?= $multimedia->getAnio(); ?></td>
                        <td><?= $multimedia->getNumero_capitulos(); ?></td>
                        <td><?= $multimedia->getNumero_ovas(); ?></td>
                        <td><?= $multimedia->getGenero(); ?></td>
                        <td><?= $multimedia->getDuracion_capitulo(); ?></td>
                        <td><?= $multimedia->getDuracion_total(); ?></td>
                        <td><?= $multimedia->getDirector(); ?></td>
                        <td><?= $multimedia->getF_estreno(); ?></td>
                        <td><?= $multimedia->getTemporadas(); ?></td>
                        <td><?= $multimedia->getTipo(); ?></td>
                        <td><?= $multimedia->getHdd(); ?></td>
                        <td>
                            <a class='borrar' href="phpdelete.php?id=<?= $multimedia->getId(); ?>">Borrar</a>
                            <a href='editar.php?id=<?= $multimedia->getId(); ?>'>Editar</a>
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

