<?php

class FileUploadMultiple {
    /* PERMITIR SUBIR UN ARCHIVO Y VARIOS ARCHIVOS */

    static function transformar($files) {
        $array = array();
        $numeroArchivos = count($files['name']["imagen"]);
        for ($i = 0; $i < $numeroArchivos; $i++) {
            $array[$i] ["name"] = $files["name"]["imagen"][$i];
            $array[$i] ["type"] = $files["type"]["imagen"][$i];
            $array[$i] ["tmp_name"] = $files["tmp_name"]["imagen"][$i];
            $array[$i] ["error"] = $files["error"]["imagen"][$i];
            $array[$i] ["size"] = $files["size"]["imagen"][$i];
        }
        return $array;
    }

    static function trans($files) {
        $array = array();
        foreach ($files as $indiceArchivo => $valorarray) {
            foreach ($valorarray as $numeroarchivo => $valor) {
                $array[$numeroarchivo][$indiceArchivo] = $valor;
            }
        }
        return $array;
    }

}
