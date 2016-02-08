<?php

class Controlador {

    function handle() {
        $op = 0;
        if (isset($_GET["op"])) {
           echo  $op = $_GET["op"];
            //$op = Request::get("op);
        }

        $metodo = "metodo" . $op;

        if (method_exists($this, $metodo)) {
            $this->$metodo();
        } else {
            $this->metodo0();
        }
    }

    function metodo0() {
        $pagina = file_get_contents('./_plantilla/_principal.html');

        $formularios = file_get_contents('./_plantilla/_formularios.html');
        $miniaturas = file_get_contents('./_plantilla/_miniaturas.html');
        $footer = file_get_contents('./_plantilla/_footer.html');

        $datos = array(
            "formularios" => $formularios,
            "miniaturas" => $miniaturas,
            "footer" => $footer
        );

        foreach ($datos as $key => $value) {
            $pagina = str_replace("{" . $key . "}", $value, $pagina);
        }

        echo $pagina;
    }
    
    function metodo1() {
        $pagina = file_get_contents('./_plantilla/_principal.html');
        ob_start();
        include "./_plantilla/_user.php";
        $formularios = ob_get_clean();
        

        //$formularios = file_get_contents('./_plantilla/_user.php');
        $miniaturas = file_get_contents('./_plantilla/_miniaturas.html');
        
        $footer = file_get_contents('./_plantilla/_footer.html');

        $datos = array(
            "formularios" => $formularios,
            "miniaturas" => $miniaturas,
            "footer" => $footer
        );

        foreach ($datos as $key => $value) {
            $pagina = str_replace("{" . $key . "}", $value, $pagina);
        }

        echo $pagina;
    }
    
    
/*
    function metodo1() {
        $contenidoParticular = file_get_contents('_plantilla/_1.html');

        $datos = array(
            "saludo" => "Hola, ¿qué tal?"
        );

        foreach ($datos as $key => $value) {
            $contenidoParticular = str_replace("{" . $key . "}", $value, $contenidoParticular);
        }

        $pagina = file_get_contents('_plantilla/_plantilla.html');

        $datos2 = array(
            "contenido_particular" => $contenidoParticular
        );

        foreach ($datos2 as $key => $value) {
            $pagina = str_replace("{" . $key . "}", $value, $pagina);
        }

        echo $pagina;
    }

    function metodo2() {
        $contenidoParticular = file_get_contents('_plantilla/_2.html');

        $datos = array(
            "esto" => "nuevo"
        );

        foreach ($datos as $key => $value) {
            $contenidoParticular = str_replace("{" . $key . "}", $value, $contenidoParticular);
        }

        $pagina = file_get_contents('_plantilla/_plantilla.html');


        $datos2 = array(
            "contenido_particular" => $contenidoParticular
        );

        foreach ($datos2 as $key => $value) {
            $pagina = str_replace("{" . $key . "}", $value, $pagina);
        }

        echo $pagina;
    }*/

}
