<?php 
    require_once "autoload.php";
    $usuarioService = new UsuarioService(); 
    require_once "cabecalho.php";         
?>

    <h1 class="text-center">Bem Vindo!</h1>
    <h2 class="text-center">Login</h2>
    <?php
            if(array_key_exists('login', $_REQUEST)){
                if($_REQUEST['login']==false){
        ?>
            <p class="alert alert-danger msg">Usuario ou senha inválido</p>
        <?php
            }
        }
        ?>
    <?php

   
        if (isset($_REQUEST['falhaDeSeguranca'])){ ?>
            <p class='alert-danger'>Voce não tem acesso a esta funcionalidade!</p>
        <?php 
        }

        if($usuarioService->usuarioEstaLogado()){
            ?>
            <p class="text-center">Voce esta logado como <?= $usuarioService->usuarioLogado();?></p>
            <p class="text-center"><a href="logout.php">Deslogar</a></p>
        <?php }else{ ?>


            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="">Login:</label>
                    <input type="text" class="form-control" name="login">
                </div>

                <div class="form-group">
                    <label for="">Senha:</label>
                    <input type="password" class="form-control" name="senha">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
    <?php
        }
    ?>

<?php require_once "rodape.php"; ?>