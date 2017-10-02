<?php
    require_once "autoload.php";
     
    $usuarioService = new UsuarioService();             

    $usuarioService->logout();
    header('Location:index.php?logout=true');
    die();
?>