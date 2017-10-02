<?php 
    require_once "conecta.php";
    require_once "cabecalho.php";
    require_once "autoload.php";

    $produtoDao = new ProdutoDao($conexao);
    
    $produtos = $produtoDao->lista();

?>
<h1 class="text-center">Listagem</h1>

<?php 
if(array_key_exists('removido',$_REQUEST)){
    if ($_REQUEST['removido']=='true'){
    ?>
    <p class="alert alert-info msg">Produto Removido com sucesso</p>
<?php
    }else{
?>
    <p class="alert alert-danger msg">Produto nao removido</p> 
<?php
    }
}
?>
<table class="table table-hover">
    <?php
        foreach($produtos as $produto): 
    ?>
        <tr>
            <td><?= $produto?></td>
               
            <td>R$ <?= $produto->getPreco()?></td>

            <td><?= substr($produto->getDescricao(),0,40)?></td>

            <td><?php if($produto->getUsado()=='1'){
                    echo "Usado";
            }else{
                    echo "Novo";
            }
            
            ?></td>

            <td><?= $produto->getCategoria()->getNome()?></td>

            <td>R$ <?= $produto->calculaImposto();?></td>

            <td>
                <?php if($produto->temIsbn()): ?>
                ISBN: <?= $produto->getIsbn()?>
                <?php endif ?>
            </td>
            
            <td>            
                <form action="remove-produto.php" method="post">

                    <input type="hidden" name="id" value="<?= $produto->getId()?>">

                    <button type="submit" class="btn btn-danger">Remover</button>
                </form>
            </td>

            <td>            
                <a class="btn btn-default" href="produto-formulario.php?id=<?= $produto->getId()?>">Alterar</a>
            </td>
        </tr>
    <?php
        endforeach; 
    ?>
</table>

<script>
    [...document.querySelectorAll('table tr .remove')]
    .forEach(a=>a.onclick=event=>{
        if (!confirm('confirma?')){
            event.preventDefault();
        };
    });

    setTimeout(()=>document.querySelector('.msg').remove(),5000);
</script>
<?php 
    require_once "rodape.php";    
?>