<?php
    session_start();
    ob_start();

    include '../dao/dao-tabela.php';
    include '../model/tabela.php';
    include '../utl/validacao.php';

    $tabela = new Tabela();
    $tabela->nomeDaTabela = $_POST['textNomeDaTabela'];
    $tabela->coluna1 = $_POST['textColuna1'];
    $tabela->valor = $_POST['textValor1'];
    $tabela->extra = $_POST['textExtra1'];

    $daoTabela = new DAOTabela();
    $daoTabela->criarTabela($tabela);

    $_SESSION['msg'] = "Tabela Criada";
    
    header("location:../criar-tabela.php");
    ob_end_flush();