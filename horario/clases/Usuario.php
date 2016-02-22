<?php

class Usuario {
        private $email, $password, $nombre;
        
        function __construct($email = null, $password = null, $nombre = null) {
            $this->email = $email;
            $this->password = $password;
            $this->nombre = $nombre;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }
        
        public function getNombre() {
            return $this->nombre;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }
        
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        
        public function getJson(){
            $r = '{';
            foreach ($this as $indice => $valor) {
                $r .= '"' .$indice . '":' . json_encode($valor). ','; //Se codifican algunos caracteres
            }
            $r = substr($r, 0,-1);
            $r .='}';
            return $r;
        }
        
        function set($valores, $inicio = 0) {
            $i = 0;
            foreach ($this as $indice => $valor) {
                $this->$indice = $valores[$i + $inicio];
                $i++;
            }
        }
}

