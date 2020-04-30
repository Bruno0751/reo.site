<?php
    require 'conexao.php';
    class DAOTabela{

        private $connect = null;

        public function __construct(){
            $this->connect = ConexaoComBanco::getInstence();
        }

        public function __destruct(){}

        public function criarTabela($tabela){
            try{
                $statment = $this->connect->prepare("CREATE TABLE ?(? ? ?)");
                $statment->bindValue(1, $tabela->nomeDaTabela);
                $statment->bindValue(2, $tabela->coluna1);
                $statment->bindValue(3, $tabela->valor);
                $statment->bindValue(4, $tabela->extra);
                
                //$array = $statment->fetchAll(PDO::FETCH_CLASS);
                //return $array;
                $statment->execute();
            }catch(PDOExeption $erro){
                echo "Erro ao Criar Tabela" . $erro;
            }
        }

    }