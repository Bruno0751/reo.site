<?php
  session_start();
  include_once 'utl/helper.php';
?>
<!DOCTYPE html>
<html lang="pt-br"> 
    <head>
        <title>site</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,intial-scale=1,maximum-scale=1">

        <link rel="icon" href="image/icone.png">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style/estilos.css">

        <script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-3.1.1.min.js"></script>
    </head>
    <body>
        <?php
            echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
            unset($_SESSION['msg']);
        ?>
        <div class="container">
            <header>
                <h1 class="jumbotron">Criar Tabela</h1>
            </header>
            <nav class="navbar container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Cadastrar Pessoa</a></li>
                    <li><a href="consulta-pessoa.php">Consulta de Pessoas</a></li>
                </ul>
            </nav>
            <section>
                <h2 class="none">Criar Tabela</h2>
                <!--enctype="multipart/format-data"-->
                <form action="" method="POST">
                    <div class="inp">
                        <input type="text" placeholder="Nome da Tabela" name="textNomeDaTabela" title="**[a...z] MIN...3/MAX...20(SEM ESPAÇOS)**" required pattern="^[a-z]{3,20}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="Coluna" name="textColuna1" title="****" required class="form-control">
                    </div>

                    <div class="inp">
                        <input type="text" placeholder="Valor" name="textValor1" title="****" required class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="Extra" name="textExtra1" title="**[null, NULL, not null, NOT NULL]**" required pattern="^[null,NULL,not,NOT ]{4,8}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="submit" value="Cadatrar" name="cadastrar" class="btn btn-success">
                        <input type="reset" value="Limpar" class="btn btn-warning">
                    </div>
                </form>
                <?php
                    if(isset($_POST['cadastrar'])){
                        include 'dao/dao-tabela.php';
                        include 'model/tabela.php';
                        include 'utl/validacao.php';

                        $tabela = new Tabela();
                        $tabela->nomeDaTabela = $_POST['textNomeDaTabela'];
                        $tabela->coluna1 = $_POST['textColuna1'];
                        $tabela->valor = $_POST['textValor1'];
                        $tabela->extra = $_POST['textExtra1'];

                        $daoTabela = new DAOTabela();
                        $daoTabela->criarTabela($tabela);
                        

                        //$_SESSION['msg'] = "Tabela Criada";
                        echo $tabela;
                        //header("location:criar-tabela.php");
                        ob_end_flush();
                    }
                ?>
            </section>
        </div>
    </body>
</html>