<?php
    require_once "autoload.php";

    class CategoriaDao{

        private $conexao;
        
                function __construct($conexao){
                    $this->conexao=$conexao;
                }
    
    
    function lista(){
        $categorias = array();
        $query = "SELECT * FROM categoria";
        $resultado = mysqli_query($this->conexao,$query);
        while($array=mysqli_fetch_assoc($resultado)){

            $categoria = new Categoria();

            $categoria->setId($array['id']);
            $categoria->setNome($array['nome']);

            array_push($categorias,$categoria);
        }
        return $categorias;
    }

}
?>