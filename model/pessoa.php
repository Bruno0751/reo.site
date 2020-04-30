<?php
    class Pessoa{

        private $codigo;
        private $nomeCompleto;
        private $senha;
        private $cpf;

        public function __construct(){}

        public function __destruct(){}

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __toString(){
            return nl2br("Identificação: $this->codigo
            Nome: $this->nomeCompleto
            Senha: $this->senha
            CPF: $this->cpf");
        }
    }