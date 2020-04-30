<?php
    class Tabela{

        private $nomeDaTabela;
        private $coluna1;
        private $valor;
        private $extra;

        public function __construct(){}

        public function __destruct(){}

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __toString(){
            return nl2br("Nome da Base: $this->nomeDaTabela
            Coluna: $this->coluna1
            Valor: $this->valor
            Extra: $this->extra");
        }
    }