<?php

class Util {
    /*
     * Los métodos estáticos son autosuficientes.
     */

    static function getSelect($name, $parametros, $valorSelected = null, $blanco = true, $atributos = "", $id = null) {
        if ($id != null) {
            $id = "id='$id'";
        } else {
            $id = "";
        }

        $r = "<select name='$name' $id $atributos >\n";
        if ($blanco === true) {
            $r .= "<option value=''>&nbsp;</option>\n";
        }

        foreach ($parametros as $indice => $valor) {
            $selected = "";
            if ($valorSelected != null && $indice === $valorSelected) {
                $selected = "selected";
            }
            $r .= "<option $selected value='$indice'>$valor</option>\n";
        }

        $r .= "</select>\n";

        return $r;
    }

}
