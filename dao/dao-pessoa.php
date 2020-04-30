<?php
    require_once 'conexao.php';
    class DAOPessoa{

        private $connect = null;

        public function __construct(){
            $this->connect = ConexaoComBanco::getInstence();
        }

        public function __destruct(){}

        public function cadastrarPessoa($pessoa){
            try{
                $statment = $this->connect->prepare("INSERT INTO pessoa(id_pessoa, nome_completo, senha) VALUES(?, ?, ?)");
                $statment->bindValue(1,$pessoa->codigo);
                $statment->bindValue(2,$pessoa->nomeCompleto);
                $statment->bindValue(3,$pessoa->senha);
               
                $statment->execute();

            }catch(PDOExeption $erro){
                echo "Erro ao Cadastrar" . $erro;
            }
        }

        public function buscarPessoa(){
            try{
                $statment = $this->connect->query("SELECT * FROM pessoa");
                $array = $statment->fetchALL(PDO::FETCH_CLASS,'pessoa');
                return $array;
            }catch(PDOExeption $erro){
                echo "Erro ao Buscar" . $erro;
            }
        }

        public function verificarIDPessoa($id){
            try{
                $statment = $this->connect->prepare("SELECT id_pessoa FROM pessoa WHERE id_pessoa = ?");
                $statment->bindValue(1, $id);
                $statment->execute();
        
                $id = null;
                $id = $statment->fetchALL(PDO::FETCH_CLASS,'pessoa');
                return $id;
            }catch(PDOException $erro){
                echo "Erro ao Buscar" . $erro;
            }
        }

        public function deletarPessoa($id){
            try{
                $statment = $this->connect->prepare("DELETE FROM pessoa WHERE id_pessoa = ?");
                $statment->bindValue(1,$id);
                $statment->execute();
            }catch(PDOExeption $erro){
                echo "Erro ao Deletar" . $erro;
            }
        }

        public function filtrarPessoa($pesquisa,$filtro){
            try{
                $query = "";
                switch($filtro){
                    case "todos":
                        $query = "";
                    break;
                    case "codigo":
                        $query = "WHERE id_pessoa = " . $pesquisa;
                    break;
                    case "nome":
                        $query = "WHERE nome_completo LIKE '%" . $pesquisa . "%'";
                    break;                    
                }
                $statment = $this->connect->query("SELECT * FROM pessoa {$query}");
                $array = $statment->fetchALL(PDO::FETCH_CLASS,'pessoa');
                return $array;
            }catch(PDOExeption $erro){
                echo "Erro ao Filtrar" . $erro;
            }
        }
    }