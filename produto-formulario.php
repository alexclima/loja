<?php 
    
      
    require_once "autoload.php";
      
    $usuarioService = new UsuarioService();
      
    $usuarioService->verificaUsuario();
      
    
      
      require_once "cabecalho.php";
      
      require_once "conecta.php";
      
      
      
      $produto=new Produto();
      $produto->setCategoria(new Categoria());
      $action='adiciona-produto.php';     
      $ehAlteracao=false;
      $usado="";

      $categoriaDao = new CategoriaDao($conexao);

    $categorias = $categoriaDao->lista();
    if(isset($_REQUEST['id'])){
        $action = 'altera-produto.php';
        $ehAlteracao=true;

        $produtoDao = new ProdutoDao($conexao);

        $produto = $produtoDao->busca($_REQUEST['id']);
        $usado=$produto->getUsado()?"checked":"";//se for alteracao verifica e coloca se é checked ou nao
    }
?>

<h1><?= $ehAlteracao?"Altera Produtos":"Cadastrando Produtos"?></h1>

<form action="<?= $action?>" method="POST">

    <input type="hidden" name="id" value="<?= $produto->getId()?>">

    <div class="form-group">
        <label for="">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= $produto->getNome();?>">
    </div>

    <div class="form-group">
        <label for="">Preco</label>
        <input type="number" name="preco" class="form-control" value="<?= $produto->getPreco();?>">
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <textarea class="form-control" name="descricao" ><?= $produto->getDescricao();?></textarea>
    </div>

    <div class="checkbox">
        <label><input type="checkbox" name="usado" <?=$usado?>>Usado</label>        
    </div>

    <div class="form-group">
        <label>Categorias</label>
        <select name="categoria_id" class="form-control">
            <?php
            foreach($categorias as $categoria):
                $selected = $categoria->getId()==$produto->getCategoria()->getId()?"selected":""; 
            ?>
                <option value="<?=$categoria->getId()?>" <?=$selected?>><?=$categoria->getNome()?></option>
                
            <?php
                endforeach; 
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Tipo de Produto</label>
        <select name="tipoProduto" class="form-control">
            <?php $ehLivro = $produto->temIsbn()?>
            <option value="geral"<?= !$ehLivro?'Selected':''?>>geral</option> 
            <option value="livro"<?= $ehLivro?'Selected':''?>>livro</option> 
        </select>
    </div>
    
    <div class="form-group">
        <label>ISBN (Quando for um Livro)</label>
        <?php
            if ($produto->temIsbn()){
                $isbn = $produto->getIsbn();
            } else{
                $isbn = "";
            }
        ?>
        <input class = "form-control" name="isbn" value="<?= $isbn ?>"/>
    </div>

    <input type="submit" value="Salvar" class="btn btn-primary">
</form>

<?php require_once "rodape.php"; ?>    