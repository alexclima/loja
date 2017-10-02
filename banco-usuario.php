<?php
    
    function buscaUsuario($conexao,$login,$senha){
        $login = mysqli_real_escape_string($conexao,$login);
        $senha = mysqli_real_escape_string($conexao,$senha);
        $senha=md5($senha);
        $query = "SELECT * FROM usuarios WHERE login='{$login}' AND senha='{$senha}'";        
        $resultado=mysqli_query($conexao,$query);
        return mysqli_fetch_assoc($resultado);
    }
?>