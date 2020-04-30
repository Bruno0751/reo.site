<?php
    class validacao{

        public static function validarId($id){
            $exp = "/^[0-9]{1,4}$/";
            return preg_match($exp, $id);
        }
        public static function validarNome($nome){
            $exp = "/^[0-9]{1,15}$/";
            return preg_match($exp, $nome);
        }
        public static function validarSobreNome($sobreNome){
            $exp = "/^[A-ü ]{1,40}$/";
            return preg_match($exp, $sobreNome);
        }
        public static function validarSenha($senha){
            $exp = "/^[A-ü,0-9]{6,23}$/";
            return preg_match($exp, $senha);
        }
    }