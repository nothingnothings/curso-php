<?php


// IMPORTANTE -> 


// EXEMPLO DE ""ASSIGN VARIABLES BY REFERENCE"" (REFERENCE VALUES)... -> aqui existe o "&", que nao existe no javascript...


$x = 1;


$y = &$x; ## //TODO - EIS O CÓDIGO EM QUESTAO (assignamos o valor da variable por REFERENCE, e nao por value)... --> agora sempre que o VALUE DE X MUDAR, O VALUE DE Y MUDARÁ TAMBÉM...


$x = 3;


echo $y; ## o que será printado será 3... ( e nao 1) --> isso acontece PQ OVERWRITTAMOS O DEFAULT DE ""VARIABLES SAO ASSIGNED POR VALUE""...



## sempre que o X MUDAR, O  Y MUDARÁ TAMBÉM...



?>