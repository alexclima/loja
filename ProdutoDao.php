<?php
    require_once "autoload.php";

    class ProdutoDao{
        
        private $conexao;

        function __construct($conexao){
            $this->conexao=$conexao;
        }    

    function lista(){
        $produtos = array();
        $query = "SELECT p.*,c.nome AS categoria_nome FROM produtos AS p JOIN categoria AS c ON p.categoria_id = c.id";
        $resultado = mysqli_query($this->conexao,$query);
        error_log(mysqli_error($this->conexao));
        while($array=mysqli_fetch_assoc($resultado)){

            if(trim($array['isbn'])!==""){
                $produto = new Livro();
                $produto->setIsbn($array['isbn']);
            }else{
                $produto = new Produto();
            }

            $produto->setId($array['id']);
            $produto->setNome($array['nome']);
            $produto->setPreco($array['preco']);
            $produto->setDescricao($array['descricao']);
            $produto->setUsado($array['usado']);

            $categoria=new Categoria();

            $categoria->setId($array['categoria_id']);
            $categoria->setNome($array['categoria_nome']);
            $produto->setCategoria($categoria);

            array_push($produtos,$produto);
        }
        return $produtos;
    }

    function insere($produto){
        if($produto->temIsbn()){
            $isbn = $produto->getIsbn();
        }else{
            $isbn="";
        }
        $query="insert into produtos(nome,preco,descricao,usado,isbn,categoria_id) values('{$produto->getNome()}',{$produto->getPreco()},'{$produto->getDescricao()}',{$produto->getUsado()},'{$isbn}',{$produto->getCategoria()->getId()})";
        $resultado=mysqli_query($this->conexao,$query);
        return $resultado;
    }

    function remove($id){
        $query= "DELETE FROM produtos WHERE id={$id}";
        $resultado = mysqli_query($this->conexao,$query);
        error_log(mysqli_error($this->conexao));
        return $resultado;
    }

    function busca($id){
        $query = "SELECT * FROM produtos WHERE id={$id}";
        $resultado = mysqli_query($this->conexao,$query);
        error_log(mysqli_error($this->conexao));
        $array=mysqli_fetch_assoc($resultado);

        if(trim($array['isbn'])!==""){
            $produto = new Livro();
            $produto->setIsbn($array['isbn']);
        }else{
            $produto = new Produto();
        }
       
        $produto->setId($array['id']);
        $produto->setNome($array['nome']);
        $produto->setPreco($array['preco']);
        $produto->setDescricao($array['descricao']);
        $produto->setUsado($array['usado']);
        
        $categoria=new Categoria();        
        $categoria->setId($array['categoria_id']);
        $produto->setCategoria($categoria);
        
        return $produto;
    }

    function altera($produto){

        if($produto->temIsbn()){
            $isbn = $produto->getIsbn();
        }else{
            $isbn = "";
        }

        $query = "UPDATE produtos SET nome='{$produto->getNome()}', preco={$produto->getPreco()}, 
                                        descricao='{$produto->getDescricao()}',
                                        usado={$produto->getUsado()},
                                        isbn='{$isbn}',
                                        categoria_id={$produto->getCategoria()->getId()} 
                                        WHERE id={$produto->getId()}";
        $resultado =  mysqli_query($this->conexao,$query);
        error_log(mysqli_error($this->conexao));
        return $resultado;
    }

}

?>