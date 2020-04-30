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

    $daoCliente = new DAOCliente();
    $verificarIDCliente = $daoCliente->verificarIDCliente($cliente->codigo);
    $verificaIDPessoa = $daoCliente->verificarIDPessoa($cliente->fk);

    if($verificaIDPessoa == null ){
        $_SESSION['msg'] = "ERRO: ID Pessoa Não Existe";
        header("location:../load-cliente.html");
    }else if($verificarIDCliente != null){
        $_SESSION['msg'] = "ERRO: ID do Cliente ja Existente";
        header("location:../load-cliente.html");
    }else{
        $daoCliente->cadastrarCliente($cliente);
        $_SESSION['msg'] = "Cliente Cadastrado";
        header("location:../load-cliente.html");
        ob_end_flush();
    }