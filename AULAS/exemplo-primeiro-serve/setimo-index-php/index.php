<?php



$x = 13.5; //floating point 

$y = 13.5e3; /// REPRESENTACAO DE FLOAT POINT NUMBERS COM EXPONENTIAL FORM (VIRA 13500) --->    e2 = 100;  e1 = 10; e0 = 1;, etc...

$zzz = 13.5e-3; // vira 13.5  . 1/1000


$xyz = 13_000.5; //vira 13000.5 (readability)..





echo PHP_FLOAT_MAX;



echo PHP_FLOAT_MIN;




$w = ceil((0.1 + 0.7) * 10); //ROUNDS UP (retorna 8)...



$s = floor((0.1 + 0.7) * 10); //ROUNDS DOWN (retorna 7)













// AGORA DIGAMOS QUE 

// TEMOS ISTO:



// ceil((0.1 + 0.2) * 10);

// --> ISSO RESULTA EM 4...



// PQ O RESULTADO É 


// 0.3000000000000000000000004  (imprecisao),

// O QUE 

// ACABA SENDO 



// RESOLVED PARA 4 (por conta do ceil)....







/// ou seja:


// RESUMO:








// ____ NUNCA _ CONFIE__ NOS FLOAT_  NUMBERS__ ATÉ 


// O ÚLTIMO DÍGITO... E NUNCA COMPARE FLOATING NUMBERS DIRETAMENTE POR EQUALITY...








//exemplo do que NAO DEVEMOS FAZER (nao devemos comparar floats diretamente):






$q = 0.23;

$t = 1 - 0.77; //? TEORICAMENTE, AMBAS VARIABLES DEVERIAM SER IGUAIS...




if ($q == $t) {
    echo 'Yes';
} else {
    echo 'No'; //ENTRAREMOS NESSE BLOCK, PQ OS 2 NAO SERAO  EXATAMENTE IGUAIS...
}









// ALGUMAS OPERATIONS/CALCULOS

// TALVEZ RESULTEM EM 1 VALUE DE ""UNDEFINED"""


// ---> ESSE VALUE DE UNDEFINED É CHAMADO DE ""NAN"" (not a number)...

// ex:


log(-1); //retorna NAN








$veryInfinite = INF; //REPRESENTA O INFINITO (infinity)...







echo INF; //vc ganha INF quando VC VAI OUT OF BOUNDS DE 1 FLOAT...





// --> TAMBÉM VC NUNCA DEVE 
// COMPARAR 

// 1 

// VARIABLE 

// DIRETAMENTE A 1 INFINITY...








// -> E VC TAMBÉM NUNCA DEVE COMPARAR 1 VARIABLE DIRETAMENTE A '"NAN""



// se vc quer comparar coisas com nan/inf,


// VOCE DEVE USAR AS BUILT-IN FUNCTIONS DE is_nan 


// e is_infinite...










is_infinite($veryInfinite); //retornará true


is_finite($veryInfinite); //retornará false




is_nan($veryInfinite);



$myInt = 5;


var_dump((float) $myInt);  // com isso, essa variable será castada como FLOAT (mesmo sendo 1 int)... -> e o var_dump vai retornar float(5)...






// -> O PROFESSOR ACHA MELHOR ESCREVER ""(float)""


// para castar esse int como float...


// --> ALGUMAS COISAS QUE 

// VC DEVE TER EM MENTE 
// QUANDO CONVERTEMOS 
// OUTROS DATA TYPES EM FLOATS:








$floatNumber = "assadasdds";


var_dump((float) $floatNumber); // isso vai resultar em float(0) --> PQ NAO TEMOS NENHUM NUMBER DENTRO DAQUELA STRING..






$realFloatNumber = "15.5aaa";

var_dump((float) $realFloatNumber); //isso vai resultar em float(15.5) ---> PQ TIRAMOS O ACTUAL NUMBER VALUE de dentro daquela string...