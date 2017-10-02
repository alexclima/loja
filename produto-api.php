<?php
    require_once "conecta.php";
    require_once "autoload.php";

    $dao = new ProdutoDao($conexao);
    $produtos = $dao->lista();
    $dtos = array();
    foreach($produtos as $produto){
        array_push($dtos,$produto->toDto());
    }
    header('Content-type:application/json');
    echo json_encode($dtos);
?>