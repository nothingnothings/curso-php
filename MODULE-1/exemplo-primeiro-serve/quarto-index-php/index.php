<?php




/* Data Types e Type Casting */




# 4 SCALAR TYPES 

# bool - true/false
$completed = true;
# int  1,2,3,4,5, 0, -5 (sem decimais)
$score = 75;
# float - 1.5, 0.1, 0.000004, -15.8
$price = 0.99;
# string  - "Gio", 'Hello World'
$greeting = 'Hello Gio';



echo $completed . '<br />';
echo $score . '<br />';
echo $price . '<br />';
echo $greeting . '<br />';



// PRIMEIRA MANEIRA DE CONSEGUIR SABER O DATA TYPE DE 1 VARIABLE..
echo gettype($completed); ///é a mesma coisa  que "typeof" operator, no mundo typescript (retorna o TIPO DE DATA armazenado naquela variável/value)...
echo gettype($score);
echo gettype($price);
echo gettype($greeting);


var_dump($completed); ///var_dump outputta toda a informacao existente sobre  1 variable, seu type, etc...
// var_dump($completed); -- vai printar 'bool(true)'

var_dump($greeting); /// -- vai printar 'string(9) Hello Gio'

# 4 COMPOUND TYPES 

# array 


$companies = ['e', 'x', 'e', 'm', 'p', 'l', 'o'];


// echo $companies; //nao vai funcionar (nao é possível printar arrays assim, com echo --- resulta em 1 error)...



print_r($companies); // isso funciona (printa array em 1 readable form)



# object 
# callable 
# iterable


# 2 SPECIAL TYPES
# resource 
# null -- nenhum value, ou NADA.


// ---> o primeiro 



// value foi printado como "1" na tela..





// isso pode nao fazer tanto sentido,

// mas vc 

// DEVE TER EM MENTE QUE 


// ""QUANDO PRINTAMOS TRUE,

// ELE VAI FICAR PRINTADO COMO 1, NO PHP""



// """"E, NO PHP, 

// QUANDO PRINTAMOS FALSE,

// A COISA QUE É PRINTADA É BLANK (ou seja, nada, ou seja, ) """



// MAS É CLARO QUE __ QUANDO PRINTAMOS 


// ALGUMA COISA, NO PHP,

// ISSO NAO INDICA O TIPO DE DATA DE UMA VARIÁVEL....



// ------> PARA TER CERTEZA ABSOLUTA DO TIPO DE DATA DE UMA VARIÁVEL,


// PODEMOS USAR 

// A FUNCTION DE "gettype()"  (é tipo o typeof operator, do Javascript)...










// AGORA ""TYPE HINTING"":





function sumInt($x, $y)
{

    var_dump($x, $y); ///retorna int(2) e int(3) -- o php infere que essas variables sao de type int, dinamicamente.

    return $x + $y;
}



echo sumInt(2, 5);





function sumMix($x, $y)
{

    var_dump($x, $y); //retorna int(2) e string(1) -->  
    echo '<br />';
    return $x + $y; //mas o value retornado será um INTEGER... (e nao uma string)...
}


$intResult = sumMix(2, '3');


echo $intResult;


var_dump($intResult); // dirá que o output daquele function call (que soma int + string) SERÁ UMA INT...



function declareTypesMix(int $x, int $y) { //QUER DIZER QUE ESSES TYPES QUE DECLARAMOS AQUI SERAO IGNORADOS, PELO PHP, SE ELE CONSIDERAR QUE FAZ MAIS SENTIDO OUTRO DATA TYPE, A DEPENDER DO CONTEXTO DE RUN DAS FUNCTIONS E ETC...

    var_dump($x, $y); ///vai printar ""int(3)"" e ""int(5)"" --> sim, mesmo QUE O VALUE DE 5 TENHA SIDO CHAMADO COMO STRING ('5')...

    return $x + $y;
}




$declareTypesIntResult = declareTypesMix(3, '5');



$declareTypesIntResult2 = declareTypesMix(3.5, '5'); //aqui estamos passando um FLOAT, e NAO UM INTEGER...
// e esse FLOAT É CONVERTIDO EM 1 INTEGER, PELO PHP, PQ DEFINIMOS "int $x" (isso vai overwrittar o type que passamos) --> QUER DIZER QUE ESSE VALUE SERÁ LIDO COMO "3" (INT) pelo php, e nao como "3.5" (float)...

echo $declareTypesIntResult;


echo $declareTypesIntResult2;

