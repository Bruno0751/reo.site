<?php
    class Padronizacao{
        
        public static function antiXSS($input){
            return htmlspecialchars($input);
        }
        public static function padronizandoNome($input){
            return ucwords(strtolower($input));
        }
        public static function juntarNomeESobreNome($input, $sobreNome){
            $nomes = array($input, $sobreNome);
            $juntar = implode(" ", $nomes);
            return $juntar;
        }
        public static function protegendo($input){
            return md5($input);
        }
    }