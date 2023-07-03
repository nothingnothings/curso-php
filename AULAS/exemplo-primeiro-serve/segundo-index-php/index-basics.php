<?php

echo 'Hello World';

print '&nbsp;';

print 'Hello World'; ## PRINT é diferente de ECHO...


print '&nbsp;';

echo print 'Hello World'; ##PRINT RETORNA UM VALUE DE "1" SEMPRE... é por isso que vamos ficar com Hello World1 na página da web...



// print echo 'Hello World'; ## //! NAO FUNCIONA...

## ""PRINT"" PODE SER USADO DENTRO DE EXPRESSIONS, mas ECHO  NAO PODE... (por isso echo print é possível, mas print echo é impossível)...



// ESTA SINTAXE TAMBÉM FUNCIONA:


echo print("EXEMPLO");






// $1variable = 'exemplo';  ## //!sintaxe INcorreta

// $@variable = 'exemplo';  ## //!sintaxe INcorreta

// $this= 'exemplo'; ##//!SINTAXE INCORRETA (this = reserved keyword)...



$variable = 'exemplo'; ##sintaxe correta
$Variable2 = 'exemplo2'; ##sintaxe correta
$_variable3 = 'exemplo3'; ## sintaxe correta


echo 'Hello', ' ', 'World', ' ', 2, ' ';


echo $variable, ' ';



echo "Joe's House ";










// IMPORTANTE -> 


// EXEMPLO DE ""ASSIGN VARIABLES BY VALUE"" (primitive values)...


$x = 1;



$y = $x;


$x = 3;


echo $y; ## o que será printado será 1... ( e nao 3) --> isso acontece PQ VARIÁVEIS SAO ASSIGNADAS POR VALUE...




// esse é o mesmo comportamento do javascript...










// IMPORTANTE -> 


// EXEMPLO DE ""ASSIGN VARIABLES BY REFERENCE"" (REFERENCE VALUES)... -> aqui existe o "&", que nao existe no javascript...


$x = 1;


$y = &$x; ## //TODO - EIS O CÓDIGO EM QUESTAO (assignamos o valor da variable por REFERENCE, e nao por value)... --> agora sempre que o VALUE DE X MUDAR, O VALUE DE Y MUDARÁ TAMBÉM...


$x = 3;


echo $y; ## o que será printado será 3... ( e nao 1) --> isso acontece PQ OVERWRITTAMOS O DEFAULT DE ""VARIABLES SAO ASSIGNED POR VALUE""...



## sempre que o X MUDAR, O  Y MUDARÁ TAMBÉM...




$firstName = 'Arthur ';




echo 'My name is $firstName '; ## este output NAO FUNCIONARÁ (pq single quotes nao possuem expansion)


echo "My name is $firstName 2 "; ##este output FUNCIONARÁ (pq DOUBLE QUOTES possuem expansion)... 
// FUNCIONA, MAS A SINTAXE É RUIM (pq fica tudo misturado)...





// SINTAXE SUPERIOR DE OUTPUT É ESTA (mais legível):


// SINTAXE --> {$variableName}
echo "My name is {$firstName} 3 ";






echo 'Hello ' . $firstName, ', ', 'How Are You?';     ## "." (DOT) é o CONCATENATION OPERATOR DO PHP... (como "+" no javascript)