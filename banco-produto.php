<?php
    require_once "autoload.php";

    function listaProdutos($conexao){
        $produtos = array();
        $query = "SELECT p.*,c.nome AS categoria_nome FROM produtos AS p JOIN categoria AS c ON p.categoria_id = c.id";
        $resultado = mysqli_query($conexao,$query);
        while($array=mysqli_fetch_assoc($resultado)){

            $produto=new Produto();

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

    function insereProduto($conexao,$produto){
        $query="insert into produtos(nome,preco,descricao,usado,categoria_id) values('{$produto->getNome()}',{$produto->getPreco()},'{$produto->getDescricao()}',{$produto->getUsado()},{$produto->getCategoria()->getId()})";
        $resultado=mysqli_query($conexao,$query);
        return $resultado;
    }

    function removeProduto($conexao,$id){
        $query= "DELETE FROM produtos WHERE id={$id}";
        return mysqli_query($conexao,$query);
    }

    function buscaProduto($conexao,$id){
        $query = "SELECT * FROM produtos WHERE id={$id}";
        $resultado = mysqli_query($conexao,$query);
        $array=mysqli_fetch_assoc($resultado);

        $produto=new Produto();        
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

    function alteraProduto($conexao,$produto){
        $query = "UPDATE produtos SET nome='{$produto->getNome()}', preco={$produto->getPreco()}, 
                                        descricao='{$produto->getDescricao()}',
                                        usado={$produto->getUsado()},
                                        categoria_id={$produto->getCategoria()->getId()} 
                                        WHERE id={$produto->getId()}";
        return mysqli_query($conexao,$query);
    }
?>