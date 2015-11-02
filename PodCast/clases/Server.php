<?php

class Server {

    static function getServerName() {
        return $_SERVER["SERVER_NAME"];
    }

    static function getRootPath() {
        return $_SERVER["CONTEXT_DOCUMENT_ROOT"];
    }

    static function getPuerto() {
        return $_SERVER["SERVER_PORT"];
    }

    static function getUserAgent() {
        return $_SERVER["HTTP_USER_AGENT"];
    }

    private static function getQueryString() {
        return $_SERVER["QUERY_STRING"];
    }

    static function getFile() {
        return $_SERVER["SCRIPT_FILENAME"];
    }

    static function getMethod() {
        return $_SERVER["REQUEST_METHOD"];
    }

    static function isGet() {
        return self::getMethod() == "GET";
    }

    static function isPost() {
        return self::getMethod() == "POST";
    }

    static function getClientAddress() {
        return $_SERVER["REMOTE_ADDR"];
    }

    static function getRequestDate($campo = null) {
        date_default_timezone_set('Europe/Madrid');

        switch ($campo) {

            //echo date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
            //Timestamp: número de segundos transcurridos desde 1/01/1970
            //$year = interval(date('Y', $_SERVER['REQUEST_TIME'])); Se convierte a entero con Interval
            case "Y":
                $year = date('Y', $_SERVER['REQUEST_TIME']);
                return $year;
            case "M":
                $month = date('m', $_SERVER['REQUEST_TIME']);
                return $month;
            case "D":
                $day = date('d', $_SERVER['REQUEST_TIME']);
                return $day;
            case "h":
                $hour = date('H', $_SERVER['REQUEST_TIME']);
                return $hour;
            case "m":
                $min = date('i', $_SERVER['REQUEST_TIME']);
                return $min;
            case "s":
                $seg = date('s', $_SERVER['REQUEST_TIME']);
                return $seg;

                return date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        }
    }

    static function getClientLanguage() {
        return $_SERVER["HTTP_ACCEPT_LANGUAGE"];
    }
    
    static function getRutaCompleta(){
        if (isset($_SERVER["HTTP_REFERER"])) {
            return $_SERVER["HTTP_REFERER"];
        }
        return null;
    }

}
