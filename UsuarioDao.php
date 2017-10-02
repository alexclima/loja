<?php

    class UsuarioDao{

        private $conexao;
        
                function __construct($conexao){
                    $this->conexao=$conexao;
                }        
    
    function busca($login,$senha){
        $login = mysqli_real_escape_string($this->conexao,$login);
        $senha = mysqli_real_escape_string($this->conexao,$senha);
        $senha=md5($senha);
        $query = "SELECT * FROM usuarios WHERE login='{$login}' AND senha='{$senha}'";        
        $resultado=mysqli_query($this->conexao,$query);
        return mysqli_fetch_assoc($resultado);
    }
}
?>