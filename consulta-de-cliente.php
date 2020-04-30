<?php
  session_start();
  ob_start();

  include_once 'model/cliente.php';
  include_once 'dao/dao-cliente.php';
  include_once 'utl/helper.php';

  $daoCliente = new DAOCliente();
  $array = $daoCliente->buscarCliente();
?>
<!DOCTYPE html>
<html lang="pt-br"> 
    <head>
        <title>site</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,intial-scale=1,maximum-scale=1">

        <link rel="icon" href="image/icone.png">
        <link rel="stylesheet" type="text/css" href="style/estilos.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-3.1.1.min.js"></script>
    </head>
    <body>
        <div class="container">
            <header>
                <h1 class="jumbotron">Lista de Cliente(s)</h1>
            </header>
            <nav class="navbar container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.html">Home /</a></li>
                    <li><a href="cadastro-de-cliente.php">Cadastrar Cliente /</a></li>
                    <li><a href="cadastro-de-pessoa.php">Cadastro de Pessoas /</a></li>
                    <li><a href="consulta-de-pessoa.php">Consulta de Pessoas /</a></li>
                </ul>
            </nav>
            <?php
                if(isset($_SESSION['msg'])){
                    Helper::alert($_SESSION['msg']);
                    unset($_SESSION['msg']);
                }
                if(count($array) == 0){
                    echo "<h1>Não Há Cliente(s) Cadastrados</h1>";
                    return;
                }
            ?>
            <section>
                <h2 class="none">Lista de Cliente(s)</h2>
                <p style='text-align: center; font-size: 26px;'>Digite Sua Pesquisa</p>
                <form name="filtro" method="POST" action="">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input name="txtfiltro" type="text" placeholder="Digite o Que Deseja!" class="form-control">
                        </div>
                        <div class="col-md-6 ">
                            <select name="selfilter" class="form-control">
                                <option value="todos">Todos</option>
                                <option value="codigo">Código</option>
                                <option value="nome">Nome</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="filtrar" value="Procurar" class="btn btn-primary btn-block">
                    </div>
                </form>
                <?php
                    if(isset($_POST['filtrar'])){
                        $pesquisa = $_POST['txtfiltro'];
                        $filtro = $_POST['selfilter'];

                        if(!empty($pesquisa)){
                            $DAOpessoa = new DAOpessoa();
                            $array = $DAOpessoa->filtrarPessoa($pesquisa,$filtro);
                            if(count($array) == 0){
                                echo "<h2 style='color: #FF4500; text-align: center; font-size: 30px;'>Pesquisa Não Encontrada</h2>
                                <br>
                                <p style='color: green; text-align: center; font-size: 30px;'>Tente Novamente</h2>";
                                return;
                            }
                        }
                    }
                ?>
                <div class="table-responsive container tab">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Senha</th>
                                <th>ID.PES.</th>
                                <th>Exluir</th>
                                <th>Alterar</th>
                            </tr>
                        <thead>
                        <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Senha</th>
                                <th>ID.PES.</th>
                                <th>Exluir</th>
                                <th>Alterar</th>
                            <tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach($array as $linhas){
                                echo "<tr>";
                                    echo "<td>$linhas->id_cliente</td>";
                                    echo "<td>$linhas->nome_completo</td>";
                                    echo "<td>$linhas->senha</td>";
                                    echo "<td>$linhas->cd_pessoa</td>";
                                    echo "<td><a class='btn btn-danger' href='consulta-de-cliente.php?id=$linhas->id_cliente'>Excluir</a></td>";
                                    echo "<td><a class='btn btn-success' href='alterar-cliente.php?id=$linhas->id_cliente'>Alterar</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        if(isset($_GET['id'])){
                            $daoCliente->deletarCliente($_GET['id']);
                            $_SESSION['msg'] = "Cliente Excluido";
                            //erro ob_end_flush();
                            header("location:consulta-de-cliente.php");
                            ob_end_flush();
                        }
                    ?>
                </div>
            </section>
        </div>
    </body>
</html>