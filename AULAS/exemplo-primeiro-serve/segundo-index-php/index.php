<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php ##

// é assim que PODEMOS FAZER EMBED DE CÓDIGO PHP, A SER EXECUTADO, DENTRO DE NOSSOS ARQUIVOS HTML...
//    PARA EXECUTES DE CÓDIGO PHP, PARA COISAS MAIS NORMAIS/COMPLEXAS, VC USARÁ ESSA SINTAXE (e nao a de baixo, em EXEMPLO, que só serve para o OUTPUT DE CONTEÚDO DE FORMA SIMPLES NA PÁGINA)...


echo 'Hello World';

## O CÓDIGO VISTO MAIS ABAIXO É BASICAMENTE A MESMA COISA QUE  ESCREVER ESSE CÓDIGO PHP AQUI, MAS SEM TER DE ESCREVER ""ECHO"" DEPOIS...


$x = 10;
$y = 5;

echo '<h4>' . $x . ', ' . $y . '</h4>'; ## também podemos fazer ECHO/OUTPUT DE CONTEÚDO HTML _ DE DENTRO DE NOSSO PHP....


?>







<?= " EXEMPLO " ?>
    
</body>
</html>