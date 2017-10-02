<?php
    require_once "autoload.php";
    
    function listaCategorias($conexao){
        $categorias = array();
        $query = "SELECT * FROM categoria";
        $resultado = mysqli_query($conexao,$query);
        while($array=mysqli_fetch_assoc($resultado)){

            $categoria = new Categoria();

            $categoria->setId($array['id']);
            $categoria->setNome($array['nome']);

            array_push($categorias,$categoria);
        }
        return $categorias;
    }
?>