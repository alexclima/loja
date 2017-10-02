<?php
    require_once "autoload.php";
     
    $usuarioService = new UsuarioService();

    require_once "conecta.php";
    
    $login = $_REQUEST['login'];
    $senha = $_REQUEST['senha'];

    $usuarioDao = new UsuarioDao($conexao);

    if($usuarioDao->busca($login,$senha)){
        $usuarioService->logaUsuario($login);
        header('Location:index.php?login=1');
    }else{
        header('Location:index.php?login=0');
    }
    die(); 
?>