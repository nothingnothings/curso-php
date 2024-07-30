<?php


// Variable Functions:
function sum(int|float ...$numbers): int|float
{
    return array_sum($numbers);
}



$x = 'sum';



echo $x(1, 2, 3, 4); // If 'sum' exists as a function, it  will be called.



// Is callable method:
function sum2(int|float ...$numbers): int|float
{
    return array_sum($numbers);
}



$x = 'sum2';


if (is_callable($x)) { // will avoid the throw of an error.

    echo $x(1, 2, 3, 4);

} else {
    echo 'Not Callable';
}





// Anonymous Functions:
function (int|float ...$numbers): int|float {
    return array_sum($numbers);
};


// Anon Function, but assigned to a variable:
$x = function (int|float $number): int|float {
    return $number * 2;
};
echo $x(2);



$x = 1;


// This type of anon function is called a closure. It is a function that has access to variables outside of its local scope (global scope, for example), with the 'use()' keyword.
$sum5 = function (int|float ...$numbers) use ($x): void { // THIS WILL ALLOW US TO ACCESS A VARIABLE NOT DEFINED IN THIS SCOPE 
    echo $x;
};



















// OK... ISSO FEITO, FALAREMOS SOBRE O 'CALLABLE' type, 

// e sobre CALLBACK FUNCTIONS...












// -- 'QUANDO UMA FUNCTION É PASSADA 
//     A OUTRA FUNCTION COMO ARGUMENT

//     E ENTÃO É CHAMADA DE DENTRO DAQUELA FUNCTION,

//     ISSO É CHAMADO DE 'CALLBACK FUNCTION'... '''






// --> O PHP TEM 1 MONTE DE BUILT-IN FUNCTIONS QUE 
//     EXPECT CALLBACK FUNCTIONS...




//     ALGUMAS DELAS SÃO:



//     1) ARRAY_MAP 


//     2) ARRAY_FILTER



//     3) U_SORT



//     4) ETC...














// -> PODEMOS COMEÇAR COM 'array_map',

// tipo assim:









// Callback Functions


array_map()











// -> ESSA FUNCTION EXIGE 1 PARAMETER DE TIPO 'CALLBACK: CALLABLE'...











// -> 'CALLABLE' --> é um outro data type... significa basicamente 'uma callable function, passada como argument'...

















// --> E VC PODE PASSAR CALLABLE FUNCTIONS A 'array_map'
//     DE DIVERSAS FORMAS...








// PRIMEIRA FORMA:




$array = [1, 2, 3, 4];




// Callback Functions
$array2 = array_map(
    function($element) {
        return $element * 2;
    }, $array);



print_r($array);




print_r($array2); 






// O QUE ESSES 2 print_r vao printar é isto:





// Array 
// (
//     [0] => 1
//     [1] => 2
//     [2] => 3
//     [3] => 4
// )


// E 


// ISTO:






// Array 
// (
//     [0] => 2
//     [1] => 4
//     [2] => 6
//     [3] => 8
// )

















// OU SEJA, É PRATICAMENTE IGUAL AO '.map()' do javascript,

// mas com 


// uma sintaxe mais esquisita e feia...









// RECAPITULANDO:




$array2 = array_map(
    function($element) {
        return $element * 2;
    }, $array);
















// OK... MAS QUAL É A SEGUNDA FORMA DE ESCREVER ISSO?









// COM O ASSIGN DE ESSA CALLBACK FUNCTION A UMA VARIABLE, TIPO ASSIM:









// callback functions:


$array = [1, 2, 3, 4];


$x = function($element) {
    return $element * 2;
};


$array2 = array_map($x, $array);  ////// BEM MAIS LEGÍVEL DO QUE ESCREVER INLINE... 













// A TERCEIRA MANEIRA É DEFINIR 1 FUNCTION COM 1 NAME, E AÍ 
// PASSAR ESSE NAME, COMO UMA STRING...



// TIPO ASSIM:







// TERCEIRA MANEIRA:




$array = [1, 2, 3, 4];

function foo($element) {
    return $element * 2;
}

$array2 = array_map('foo', $array);












// ------------



// ARROW FUNCTIONS:








// -- FORAM INTRODUZIDAS COM O PHP 7.4...









// -- É  UMA SINTAXE MAIS 'CLEAN' DE ANON FUNCTIONS,
//     COM ALGUMAS POUCAS DIFERENÇAS...









// -- A SINTAXE DE ARROW FUNCTIONS É ESPECIALMENTE ÚTIL __COMO 
//     UMA ESPÉCIE DE 'INLINE CALLBACK FUNCTION'...







// --> OU SEJA, SÃO ESPECIALMENTE ÚTEIS QUANDO PASSADAS 
//     COMO ARGUMENTS PARA OUTRAS FUNCTIONS/built-in functions do php...










// TIPO ASSIM:







// Arrow functions:

$array = [1, 2, 3, 4];


array_map(
    

    fn($number) => $number * $number,
    $array
)




// OU SEJA, A SINTAXE É UM POUCO DIFERENTE DA SINTAXE DO JAVASCRIPT...







// É ASSIM:






// fn($number) => $number * $number;









// fn() 





// AÍ, DENTRO DOS (), a definição dos parameters...




// AÍ, DEPOIS DISSO, '=>', 


// e aí 


// A EXPRESSION... A EXPRESSION A SER RETORNADA... 














// É UM POUCO PARECIDO COM AS ARROW DO JAVASCRIPT,

// MAS 1 POUCO DIFERENTE TAMBÉM...














// OK... AGORA VEREMOS AS DIFERENÇAS 
// DAS ARROW FUNCTIONS EM RELAÇÃO A FUNCTIONS NORMAIS:




// 1) VOCÊ SEMPRE PODE ACESSAR AS VARIABLES DO PARENT SCOPE, NAS ARROW FUNCTIONS,
//     SEM __ PRECISAR UTILIZAR A KEYWORD DE 'use()'...






// EX:




// // Arrow functions:

// $array = [1, 2, 3, 4];

// $y = 5;


// array_map(
    

//     fn($number) => $number * $number * $y, // we can access '$y', from the global scope, as normal.
//     $array
// )












// --> OK... MAS, AQUI, VC DEVE TER 


// UM QUIRK EM MENTE:


// ''ARROW FUNCTIONS USE THE VARIABLES FROM THE PARENT SCOPE 
//     WITH A 'BY-VALUE' VARIABLE BINDING... ISSO QUER DIZER QUE 

//     __VC NÃO É CAPAZ _ DE MODIFICAR _ O VALUE __ DA GLOBAL VARIABLE/PARENT SCOPE 
//      DE DENTRO DA ARROW FUNCTION...''





// OU SEJA, SE ESCREVEMOS ALGO COMO '++$y' no meio da expression da arrow function,
//     SIM, esse value será incrementado, MAS APENAS NO SCOPE DA ARROW FUNCTION...






// EX:







// // Arrow functions:

// $array = [1, 2, 3, 4];

// $y = 5;


// array_map(
    

//     fn($number) => $number * $number * ++$y, // the value will only be altered on this scope, and not globally...
//     $array
// )












// 2) A SEGUNDA DIFERENÇA É QUE 
//     ARROW FUNCTIONS POSSUEM 1 SINGLE EXPRESSION,

//     E AÍ VC RETORNA O VALUE DAQUELA EXPRESSION...





//     --> É 1 SINGLE EXPRESSION, VC NÃO PODE TER MÚLTIPLAS LINES...






//     --> O MÁXIMO QUE VC PODE FAZER É ESCREVER 1 ARRAY, 
//         E AÍ USAR MULTI-LINE... MAS VOCE NÃO PODE FAZER 

//         COISAS COMO 


//         expression1;
//         expression2;
//         expression3;




//     --> NO FUTURO, SERIA LEGAL 
//         SE ESSA RESTRICTION FOSSE REMOVIDA, MAS, POR ENQUANTO, 

//         PODEMOS APENAS RETORNAR 1 SINGLE EXPRESSION...

