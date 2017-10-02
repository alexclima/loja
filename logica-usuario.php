<?php 
    session_start();
    
    function verificaUsuario(){
        if(!usuarioEstaLogado()){
            header('Location:index.php?falhaDeSeguranca=true');
            die();
          }
    }

    function usuarioEstaLogado(){
        return isset($_SESSION['usuario_logado']);
    }

    function usuarioLogado(){
        return $_SESSION['usuario_logado'];
    }

    function logaUsuario($usuario){
        return $_SESSION['usuario_logado']=$usuario;
    }

    function logout(){
        session_destroy();
    }
?>