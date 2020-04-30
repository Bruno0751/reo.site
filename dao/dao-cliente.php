<?php
        require 'conexao.php';
    class DAOCliente{
        
        private $connect = null;

        public function __construct(){
            $this->connect = ConexaoComBanco::getInstence();
        }

        public function __destruct(){}

        public function cadastrarCliente($cliente){
            try{
                $statment = $this->connect->prepare("INSERT INTO cliente(id_cliente, nome_completo, senha, cd_pessoa) VALUES(?,?,?,?)");
                $statment->bindValue(1,$cliente->codigo);
                $statment->bindValue(2,$cliente->nomeCompleto);
                $statment->bindValue(3,$cliente->senha);
                $statment->bindValue(4,$cliente->fk);         
                $statment->execute();

            }catch(PDOExeption $erro){
                echo "Erro ao Cadastrar" . $erro;
            }
        }

        public function buscarCliente(){
            try{
                $statment = $this->connect->query("SELECT * FROM cliente");
                $array = $statment->fetchALL(PDO::FETCH_CLASS,'cliente');
                return $array;
            }catch(PDOExeption $erro){
                echo "Erro ao Buscar" . $erro;
            }
        }

        public function verificarIDCliente($id){
            try{
                $statment = $this->connect->prepare("SELECT id_cliente FROM cliente WHERE id_cliente = ?");
                $statment->bindValue(1, $id);
                $statment->execute();
        
                $id = null;
                $id = $statment->fetchALL(PDO::FETCH_CLASS,'cliente');
                return $id;
            }catch(PDOException $erro){
                echo "Erro ao Buscar" . $erro;
            }
        }

        public function verificarIDPessoa($fk){
            try{
                $statment = $this->connect->prepare("SELECT id_pessoa FROM pessoa WHERE id_pessoa = ?");
                $statment->bindValue(1, $fk);
                $statment->execute();
        
                $fk = null;
                $fk = $statment->fetchObject('Cliente');
                return $fk;
            }catch(PDOException $erro){
                echo "Erro ao Buscar" . $erro;
            }
        }

        public function deletarCliente($id){
            try{
                $statment = $this->connect->prepare("DELETE FROM cliente WHERE id_cliente = ?");
                $statment->bindValue(1,$id);
                $statment->execute();
            }catch(PDOExeption $erro){
                echo "Erro ao Deletar" . $erro;
            }
        }

        public function filtrarCliente($pesquisa,$filtro){
            try{
                $query = "";
                switch($filtro){
                    case "todos":
                        $query = "";
                    break;
                    case "codigo":
                        $query = "WHERE id_cliente = " . $pesquisa;
                    break;
                    case "nome":
                        $query = "WHERE nome_completo LIKE '%" . $pesquisa . "%'";
                    break;                    
                }
                $statment = $this->connect->query("SELECT * FROM cliente {$query}");
                $array = $statment->fetchALL(PDO::FETCH_CLASS,'cliente');
                return $array;
            }catch(PDOExeption $erro){
                echo "Erro ao Filtrar" . $erro;
            }
        }
    }