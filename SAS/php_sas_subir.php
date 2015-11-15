<?php

require 'clases/AutoCarga.php';
//Transforma el array $_FILES a uno más entendible
$file = FileUploadMultiple::transformar(FileUploadMultiple::trans($_FILES));
//Guardamos cuántas fotos subimos.
$longitud = sizeof($file);
//Guardamos el usuario
$usuario = Request::post("id_us");
//Guardamos la ruta de la carpeta con el nombre del usuario
$carpetaUser = "C:/SAS_users/" . $usuario . "/";
//Declaramos las subidas correctas e incorrectas
$correctas = 0;

$incorrectas = 0;
$session = new Session();
$session->set('user', $usuario);
$session->set('subidasOK', $correctas);
$session->set('subidasKO', $incorrectas);
$session->set("archivosTotales", $longitud);
// Comprobamos que el usuario no está vacío, si lo está vuelve al html, si no, lo mete en la sesión



if (!is_dir($carpetaUser)) {
    mkdir($carpetaUser, 0777, true);
    /* Si no existe, crea la carpeta y procederá a subir las fotos. */
} else {
    /* Enviar a otra pagina para que el usuario visualice las fotos */
}

for ($i = 0; $i < $longitud; $i++) {

    $subir = new FileUpload($file, $i);
    $nombreArchivo = $file[$i]["name"];

    $extension = substr($nombreArchivo, strpos($nombreArchivo, "."));

    $nombreArchivo = $usuario . "_0" . $i;
    $subir->setNombre($nombreArchivo);
    $subir->setDestino($carpetaUser);

    if ($subir->upload()) {
        $correctas++;
        $session->set('subidasOK', $correctas);
        echo "subidas: $correctas<br/>";
    } else {
        $incorrectas++;
        $session->set('subidasKO', $incorrectas);
        echo "no las ha subido: $incorrectas<br/>";
    }
}

$session->sendRedirect("sas_listado.php");


