<?php
    abstract class Recibo{

    function geraCabecalho(){

    }

    function geraRodape(){

    }

    abstract function geraLinha();

    }

    class ReciboBradesco extends Recibo{

        function geraLinha(){
            return true;
        }
    }

    $recibo = new ReciboBradesco;
    $recibo2 = new Recibo;
?>