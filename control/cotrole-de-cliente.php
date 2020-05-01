<?php
    session_start();
    ob_start();
    
    include '../dao/dao-cliente.php';
    include '../model/cliente.php';
    include '../utl/padronizacao.php';
    include '../utl/validacao.php';

    $cliente = new Cliente();
    $cliente->codigo = Padronizacao::antiXSS($_POST['numberCodigoCliente']);
    $cliente->nomeCompleto = Padronizacao::antiXSS(Padronizacao::padronizandoNome(Padronizacao::juntarNomeESobreNome($_POST['textNomeCliente'], $_POST['textSobreNomeCliente'])));
    $cliente->senha = Padronizacao::antiXSS(Padronizacao::protegendo($_POST['passwordSenhaCliente']));
    $cliente->fk = Padronizacao::antiXSS($_POST['numberIDPessoa']);
    $cliente->cpf = Padronizacao::antiXSS($_POST['textCPF']);

    $daoCliente = new DAOCliente();
    $verificarIDCliente = $daoCliente->verificarIDCliente($cliente->codigo);
    $verificaIDPessoa = $daoCliente->verificarIDPessoa($cliente->fk);
    $verificaCPFCliente = $daoCliente->verificarCPFDoCliente($cliente->cpf);

    if($verificarIDCliente != null && $verificaCPFCliente != null && $verificaIDPessoa == null){
        $_SESSION['msg'] = "ERRO: ID e CPF do Cliente; e ID Pessoa";
        header("location:../load-cliente.html");
        ob_end_flush();
    }else if($verificarIDCliente != null && $verificaCPFCliente != null){
        $_SESSION['msg'] = "ERRO: ID e CPF do Inválidos";
        header("location:../load-cliente.html");
        ob_end_flush();
    }else if($verificarIDCliente != null && $verificaIDPessoa == null){
        $_SESSION['msg'] = "ERRO: ID do Cliente ja Existente, e ID Pessoa Não Existe";
        header("location:../load-cliente.html");
        ob_end_flush();
    }else if($verificaIDPessoa == null && $verificaCPFCliente != null){
        $_SESSION['msg'] = "ERRO: CPF Inválido; e ID Pessoa não Existe";
        header("location:../load-cliente.html");
        ob_end_flush();
    }else if($verificarIDCliente != null){
        $_SESSION['msg'] = "ERRO: ID do Cliente ja Existente";
        header("location:../load-cliente.html");
        ob_end_flush();
    }else if($verificaCPFCliente != null){
        $_SESSION['msg'] = "ERRO: CPF Inválido";
        header("location:../load-cliente.html");
        ob_end_flush();
    }else if($verificaIDPessoa == null){
        $_SESSION['msg'] = "ERRO: ID Pessoa Não Existe";
        header("location:../load-cliente.html");
        ob_end_flush();
    }else{
        $daoCliente->cadastrarCliente($cliente);
        $_SESSION['msg'] = "Cliente Cadastrado";
        header("location:../load-cliente.html");
        ob_end_flush();
    }