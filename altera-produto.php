<?php 
        
        require_once "autoload.php";
        
        $usuarioService = new UsuarioService();
        
        $usuarioService->verificaUsuario();        
        
        if (strcasecmp($_REQUEST['tipoProduto'],'livro')==0){
            $produto = new Livro;
            $produto->setIsbn($_REQUEST['isbn']);
        }else{
            $produto = new Produto();
        }   

        $produto->setId($_REQUEST['id']);

        $produto->setNome($_REQUEST['nome']);
        $produto->setPreco($_REQUEST['preco']);
        $produto->setDescricao($_REQUEST['descricao']);
        $produto->setUsado("false");

        $categoria = new Categoria();
        $categoria->setId($_REQUEST['categoria_id']);
        $produto->setCategoria($categoria);

        require_once "conecta.php";
        
        require_once "cabecalho.php";

        if(array_key_exists('usado', $_REQUEST)){
            $produto->setUsado("true");
        }

        $produtoDao = new ProdutoDao($conexao);
        
        if($produtoDao->altera($produto)){
?>
    
    <p class="alert alert-info">Produto <?=$produto->getNome()?>, R$<?=$produto->getPreco()?> alterado com sucesso</p>
        
        <?php }else{
            $msg=mysqli_error($conexao);
            error_log($msg);
            ?>

    <p class="alert alert-danger">Produto <?=$produto->getNome()?>, R$<?=$produto->getPreco()?> nao foi alterado </p>

<?php  
        }

require_once "rodape.php"; ?>