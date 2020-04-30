<?php
    session_start();
    ob_start();
    
    include '../dao/dao-pessoa.php';
    include '../model/pessoa.php';
    include '../utl/padronizacao.php';
    include '../utl/validacao.php';

    $pessoa = new Pessoa();
    $pessoa->codigo = Padronizacao::antiXSS($_POST['numberCodigoPessoa']);
    $pessoa->nomeCompleto = Padronizacao::antiXSS(Padronizacao::padronizandoNome(Padronizacao::juntarNomeESobreNome($_POST['textNomePessoa'], $_POST['textSobreNomePessoa'])));
    $pessoa->senha = Padronizacao::antiXSS(Padronizacao::protegendo($_POST['passwordSenhaPessoa']));

    $daoPessoa = new DAOPessoa();
    $verificaIDPessoa = $daoPessoa->verificarIDPessoa($pessoa->codigo);

    if($verificaIDPessoa != null){
        $_SESSION['msg'] = "ERRO: ID de Pessoa ja Existente";
        header("location:../load-pessoa.html");
        ob_end_flush();
    }else{
        $daoPessoa->cadastrarPessoa($pessoa);
        $_SESSION['msg'] = "Pessoa Cadastrada";
        header("location:../load-pessoa.html");
        ob_end_flush(); 
    }   