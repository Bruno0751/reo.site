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
        <script src="js/script-pessoal.js"></script>
    </head>
    <body>
        <?php
            echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
            unset($_SESSION['msg']);
        ?>
        <div class="container">
            <header class="jumbotron">
                <h1>Cadastro de Cliente</h1>
            </header>
            <nav class="navbar container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.html">Home /</a></li>
                    <li><a href="consulta-de-cliente.php">consulta de Cliente /</a></li>
                    <li><a href="cadastro-de-pessoa.php">cadastro de Pessoas</a></li>
                    <li><a href="consulta-de-pessoa.php">Consulta de Pessoas /</a></li>
                </ul>
            </nav>
            <section>
                <h2 class="none">Cadastro de Cliente</h2>
                <!--enctype="multipart/format-data"-->
                <form action="control/cotrole-de-cliente.php" method="POST">
                    <div class="inp">
                        <input type="number" placeholder="Código" name="numberCodigoCliente" title="**[0...9] MAX...15**" required pattern="^[0-9]{1,4}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="Nome" name="textNomeCliente" title="**[a...z ou A..Z] MAX...30**" required pattern="^[A-ü ]{1,30}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="Sobre Nome" name="textSobreNomeCliente" title="**[a...z ou A..Z] MAX...40**" pattern="^[A-ü ]{1,40}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="Senha" name="passwordSenhaCliente" title="**[a...z ou A..Z ou 0...9] MIN..6 / MAX...20**" required pattern="^[A-ü,0-9]{6,23}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="text" placeholder="CPF" name="textCPF" title="**[0...9] MAX...15**" required pattern="^[0-9]{11,15}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="number" placeholder="ID.Pes." name="numberIDPessoa" title="**[0...9] MAX...15**" required pattern="^[0-9]{1,4}$" class="form-control">
                    </div>
                    <div class="inp">
                        <input type="submit" value="Cadatrar" name="cadastrar" class="btn btn-success">
                        <input type="reset" value="Limpar" name="limpar" class="btn btn-warning">
                    </div>
                </form>
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