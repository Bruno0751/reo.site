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
        <link rel="stylesheet" type="text/css" href="style/estilos.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/script-pessoal.js"></script>
    </head>
    <body>
        <?php
            echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
            unset($_SESSION['msg']);
        ?>
        <div class="container">
            <header>
                <h1 class="jumbotron">Cadastro de Pessoa</h1>
            </header>
            <nav class="navbar container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.html">Home /</a></li>
                    <li><a href="consulta-de-pessoa.php">Consulta de Pessoas /</a></li>
                    <li><a href="cadastro-de-cliente.php">Cadastro de Cliente /</a></li>
                    <li><a href="consulta-de-cliente.php">consulta de Cliente /</a></li>
                </ul>
            </nav>
            <section>
                <h2 class="none">Cadastro de Pessoa</h2>
                <!--enctype="multipart/format-data"-->
                <form action="control/control-de-pessoa.php" method="POST" enctype="multipart/format-data">
                    <div class="inp">
                        <input type="number" placeholder="Código" name="numberCodigoPessoa" title="**[0...9] MAX...15**" required pattern="^[0-9]{1,4}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="Nome" name="textNomePessoa" title="**[a...z ou A..Z] MAX...30**" required pattern="^[A-ü ]{1,30}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="Sobre Nome" name="textSobreNomePessoa" title="**[a...z ou A..Z] MAX...40**" pattern="^[A-ü ]{2,40}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="Senha" name="passwordSenhaPessoa" title="**[a...z ou A..Z ou 0...9] MIN..6 / MAX...20**" required pattern="^[A-ü,0-9]{6,20}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="submit" value="Cadatrar" name="cadastrar" class="btn btn-success">
                        <input type="reset" value="Limpar" name="limpar" class="btn btn-warning">
                    </div>
                </form>
            </section>
        </div>
    </body>
</html>