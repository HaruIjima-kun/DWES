<?php
$bd = new DataBase();
$gestor = new ManageImagenes($bd);
$imagenes = $gestor->getList();

foreach ($imagenes as $clave => $valor) {
   echo  $miniatura = '<article>' .
                    '<a class="thumbnail" href="' . $imagenes[$clave]->getImagen() . '" data-position="left center"><img src="' . $imagenes[$clave]->getImagen() . '" alt="" /></a>'.
                    '<h2>' . $imagenes[$clave]->getTitulo() . '</h2>'.
                    '<p>' . $imagenes[$clave]->getDescripcion() . '</p>'.
                '</article>';
}
