<?php

class Controlador {

    function handle() {
        $op = 0;
        if (isset($_GET["op"])) {
            $op = $_GET["op"];
            //$op = Request::get("op");
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
        
        ob_start();
        include "./_plantilla/_miniaturas.php";
        $miniaturas = ob_get_clean();
        
        $footer = file_get_contents('./_plantilla/_footer.html');

        $datos = array(
            "formularios" => $formularios,
            "miniaturas" => $miniaturas,
            "footer" => $footer
        );

        foreach ($datos as $key => $value) {
            $pagina = str_replace("{" . $key . "}", $value, $pagina);
        }
        $pos = substr($pagina, 0);
        
        echo $pagina;
    }
    
    function metodo1() {
        $sesion = new Session();
        if (!$sesion->isLogged()) {
            self::metodo0();
        } else {
            $pagina = file_get_contents('./_plantilla/_principal.html');
            
            ob_start();
            include "./_plantilla/_user.php";
            $formularios = ob_get_clean();
    
            ob_start();
            include "./_plantilla/_miniaturas.php";
            $miniaturas = ob_get_clean();
            
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
    }
}
