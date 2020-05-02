<?php
  session_start();
  ob_start();

  include_once 'model/pessoa.php';
  include_once 'dao/dao-pessoa.php';
  include_once 'utl/helper.php';

  $daoPessoa = new DAOpessoa();
  $array = $daoPessoa->buscarPessoa();
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
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!--
        <link  href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        -->

        <script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-3.1.1.min.js"></script>
        <!--
        <script src="vendor/components/jquery/jquery.min.js"></script>
        <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
        -->
    </head>
    <body>
        <div class="container">
            <header>
                <h1 class="jumbotron">Lista de Pessoa(s) / attt</h1>
            </header>
            <nav class="navbar container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.html">Home /</a></li>
                    <li><a href="cadastro-de-pessoa.php">Cadastrar Pessoa /</a></li>
                    <li><a href="cadastro-de-cliente.php">Cadastrar Cliente /</a></li>
                    <li><a href="consulta-de-cliente.php">consulta de Cliente /</a></li>
                </ul>
            </nav>
            <?php
                if(isset($_SESSION['msg'])){
                    Helper::alert($_SESSION['msg']);
                    unset($_SESSION['msg']);
                }
                if(count($array) == 0){
                    echo "<h1>Não Há Pessoa(s) Cadastrados</h1>";
                    return;
                }
            ?>
            <section>
                <h2 class="none">Lista de Pessoa(s)</h2>
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
                                <th>CPF</th>
                                <th>Exluir</th>
                                <th>Alterar</th>
                            </tr>
                        <thead>
                        <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Senha</th>
                                <th>CPF</th>
                                <th>Exluir</th>
                                <th>Alterar</th>
                            <tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach($array as $linhas){
                                echo "<tr>";
                                    echo "<td>$linhas->id_pessoa</td>";
                                    echo "<td>$linhas->nome_completo</td>";
                                    echo "<td>$linhas->senha</td>";
                                    echo "<td>$linhas->cpf </td>";
                                    echo "<td><a class='btn btn-danger' href='consulta-de-pessoa.php?id=$linhas->id_pessoa'>Excluir</a></td>";
                                    echo "<td><a class='btn btn-success' href='alterar-pessoa.php?id=$linhas->id_pessoa'>Alterar</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        if(isset($_GET['id'])){
                            $daoPessoa->deletarPessoa($_GET['id']);
                            $_SESSION['msg'] = "Pessoa Excluido";
                            //erro ob_end_flush();
                            header("location:consulta-de-pessoa.php");
                            ob_end_flush();
                        }
                    ?>
                </div>
            </section>
            <footer>
                <figure>
                    <ul>
                        <li>
                          <a href="https://www.facebook.com/bruno.gresslerdasilveira.71">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span class="fa fa-facebook" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/brunao_gs/?hl=pt-br">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span class="fa fa-instagram" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span class="fa fa-twitter" aria-hidden="true"></span>
                            </a>
                        </li> 
                        <li>
                            <a href="https://www.linkedin.com/in/bruno-gressler-55151515a/">
                              <span></span>
                              <span></span>
                              <span></span>
                              <span></span>
                              <span class="fa fa-linkedin-square" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </figure>
            </footer>
        </div>
    </body>
</html>