<?php






// -> SE 1 OPERATOR 


// __aCEITA/EXIGE APENAS 1 VALUE,




// ELE É CHAMADO 



// DE ""UNARY OPERATOR"" (é um termo geral)...









// ------> UM EXEMPLO DE UNARY OPERATOR 

// É O __ BANG...









// ! --> BANG ...











// ESSE VALUE ADICIONA UM ""NOT"" A ALGUMA COISA...








// -> SE 1 OPERATOR __ aCEITA/EXIGE 2 VALUES,

// ELE É CHAMADO _DE _ BINARY OPERATOR...







// UM EXEMPLO CLÁSSICO DE BINARY OPERATOR É "+"









$x = true;







$y = !$x; // exemplo de UNARY OPERATOR (converte true em false, no caso)... --> é unary pq aceita/exige apenas 1 value, atua sobre apenas 1 value...




//BINARY OPERATOR -->  SAO OPERATORS QUE ACEITAM/EXIGEM 2 VALUES, ATUAM SOBRE 2 VALUES... A MAIOR PARTE DOS PHP OPERATORS É DESTE TIPO...






// ----> SE 1 OPERATOR __ EXIGE __ 3 VALUES,

// ELE É 


// CHAMADO DE ___ TERNARY OPERATOR... (ex: ternary expressions, javascript)...







// EXEMPLO DE TERNARY OPERATOR É ?:










// COMECAMOS PELOS ARITHMETIC OPERATORS:


// sao:
// + - * / % **


// TE DEIXAM RODAR OPERACOES COMO ADICOES,

// SUBTRACOES,

// MULTIPLICACOES,

// DIVISOES,

// ""MODULES""


// e EXPONENCIACAO...










$x = 10;
$y = 2;

var_dump($x + $y);
var_dump($x - $y);
var_dump($x * $y);
var_dump($x / $y);
var_dump($x % $y); //retorna 0 (é o resto dessa divisao)
var_dump($x ** $y); //retorna 100 (10 na segunda potencia)














// -> OK... O PROFESSOR PRIMEIRAMENTE QUER FALAR SOBRE OS OPERATORS DE ADD E SUBTRACTION...



// --> VC PODE USAR OS 2 PARA PREFIXAR VALUES OU VARIABLES...

// --> SE VC FIZER ISSO,

// VC __ PODE CONVERTER AQUELE VALUE PARA OU UMA INTEGER,

// OU UM FLOAT...





$exemplo = +'5'; //ISSO SERÁ CASTADO COMO UMA INTEGER...


var_dump($exemplo); //retornará int(5); (POSITIVO)







$exemplo2 = -'5'; //ISSO SERÁ CASTADO COMO UMA INTEGER...


var_dump($exemplo); //retornará int(-5);  (É A MESMA COISA QUE O CÓDIGO DE CIMA, MAS CONVERTE PARA UMA INT NEGATIVA)...






var_dump($x / $y); //vai retornar 1 integer pq OS 2 OPERANDS SAO INTEGERS (10 e 2), E SAO EVENLY DIVISIBLE... caso contrário, retornaria 1 FLOAT...









//casos em que sao retornados floats:

$zzz = 10;

$www = 3;


var_dump($zzz / $www); //RETORNA 3.3333333 (float) (pq nao é evenly divisible)





$q = 10;

$t = 2.0; //isto é um float


var_dump($q / $t); //retorna 5 (MAS de TYPE FLOAT...).... (RETORNOU FLOAT PQ 1 DOS OPERANDS É UM FLOAT, O 2.0 é um float...)










// OK... OUTRO DETALHE --> SE VC DIVIDIR 

// ALGUM NUMBER POR 0,



// SEU APP VAI QUEBRAR, 

// VAI PARAR DE RODAR,

// E VC 


// VAI GANHAR 1 ERROR....




// -----> ENTRETANTO, SE VC ESTIVER TRABALHANDO COM UMA VERSAO DO PHP 



// __ ANTERIOR __ À VERSAO 8,



// VC __ SÓ VAI GANHAR 1 WARNING (o app nao vai quebrar),


// E VC 


// VAI CONSEGUIR 1 VALUE... MAS ESSE VALUE SERÁ INFINITY..














// SE VC QUISER ___EVITAR___ O COMPORTAMENTO DO PHP 8,

// QUE QUEBRA O SEU APP,






// EM CASES EM QUE VC __ QUER__ CONSEGUIR O INFINITY COMO VALUE,



// quando divide por 0,




// VC __PODE _ USAR _ UMA FUNCTION QUE FOI INTRODUZIDA 

// NO PHP8,




// QUE 


// É A FUNCTION DE fdiv()




$someNumber = 10;

$aNastyZero = 0;




var_dump(fdiv($someNumber, $aNastyZero)); //vai retornar float(INF)...


// SE VC RODAR ISSO AÍ, ELE VAI TENTAR DIVIDIR POR 0, MAS NAO VAI 

// DAR THROW DE UM ERROR,

// E SIM VAI APENAS 

// RETORNAR ""INFINITY"" ( ou seja, ficaremos com o comportamento 
// de divisao por 0 do php ANTERIOR à versao 8....)













// EXEMPLO DE USO DO MODULUS OPERATOR (%)...






$xxxx = 10;
$yyyy = 2;




var_dump($xxxx % $yyyy); //vai retornar int(0) --> JUSTAMENTE PQ NAO EXISTIRÁ RESTO NA DIVISAO ENTRE 10 E 2...










$xxxx2 = 10;
$yyyy2 = 2;


var_dump($xxxx2 % $yyyy2); //vai retornar int(1) --> JUSTAMENTE PQ EXISTIRÁ RESTO NA DIVISAO ENTRE 10 E 2 (que será 1)...






// ------> se deixamos 10 e 6,


// o modulus será de 4... (o resto será 4)...











// --> O DETALHE, AQUI, É QUE 

// AMBOS 



// OPERANDS _ SERAO CASTADOS __ COMO INTEGERS... ( ou seja, se eram 

// floats, serao castados como INTEGERS, vao perder 
// as casas decimais) ANTES DE OCORRER A DIVISAO...

// EXEMPLO:



$aFloatValue1 = 10.5;

$aFloatValue2 = 2.9;


var_dump($aFloatValue1 % $aFloatValue2); //vai retornar int(0), pq ambos values serao castados como 10 e 2, e aí o resto dessa divisao é 0...








// MAS COMO PODEMOS REALIZAR MODULUS OPERATION EM FLOAT VALUES, ENTAO...





// DEVEMOS USAR A FUNCTION DE fmod() -> E ENTAO PASSAR OS 2 VALUES/OPERANDS,


// tipo assim:





var_dump(fmod($aFloatValue1, $aFloatValue2)); //vai retornar float(1.800000000003);










// OUTRA COISA QUE DEVEMOS SABER, QUANDO TRABALHAMOS COM O MOD OPERATOR,


// É QUE 

// QUANDO TRABALHAMOS COM NÚMEROS NEGATIVOS,






// O __ _SINAL __ DO RESULTADO_ _



// É TIRADO _ DO NUMBER QUE 

// VC ESTAVA DIVIDINDO...














//  AGORA DEVEMOS VER OS ""ASSIGNMENT OPERATORS"""... SAO VARIOS (nao sao apenas "=")...








// O ASSIGNMENT OPERATOR BASICO É 




// "=" --> ELE ASSIGNA O VALUE 


// DA DIREITA 

// PARA O VALUE DA ESQUERDA..





// NUNCA CONFUNDA ASSIGNMENT OPERATOR COM COMPARISON OPERATORS:





// NUNCA ESCREVA ISTO:



// if ($x = 5) {


// },



// PQ AÍ VC ESTARÁ ASSIGNANDO O VALUE DE 5 AO X... (e sempre retornará true)...

//  O QUE VC QUER ESCREVER É if ($x == 5) {}










// ALÉM DISSO,

// É POSSÍVEL ASSIGNAR MÚLTIPLAS VARIABLES AO MESMO TEMPO...





// tipo assim:


$variable1 = $variable2 = 10; //ambas variables terao o value de 10...










// NO PHP, TEMOS UM TIPO DE ASSIGNMENT OPERATOR MAIS COMPLEXO, CHAMADO DE __ COMBINED OPERATORS_... (ah, sao aqueles operators como += -= *= /=, etc ...)





// EX:




$xyz = $xyz * 3; //versao sem shorthand




$xyz *= 3; //versao com shorthand









//  E ISSO FUNCIONA COM TODOS OPERATORS, tipo +=, -=, *=, /=, %=, **=
















// STRING OPERATORS --> TEMOS "." (concatenation) e .= (CONCATENATION COM ASSIGNMENT)....









// EX:






$we = "Hello";



$we = $we . 'World'; //sem shorthand



$we .= 'World'; //COM SHORTHAN (vai concatenar e definir o value de $we como essa concatenacao de hello + world) ...









//  COMPARISON OPERATORS (==, ===, !=, !==) :








$xtz = 5;


$ytz = 5;




var_dump($xtz == $ytz); //vai retornar bool(true)


var_dump($xtz === $ytz); //vai retornar bool(true)


// OS 2 VAO RETORNAR TRUE PQ OS 2 SAO 5,



// E OS 2 VALUES POSSUEM DATA TYPE DE INT...









$xtzz = 5;


$ytzz = '5';



var_dump($xtzz == $ytzz); //vai retornar bool(true) (mesmo os 2 data types sendo diferentes... forced type conversion)...


var_dump($xtzz === $ytzz); //vai retornar bool(FALSE)  (pq nao sao iguais, sao 2 data types completamente diferentes, string e int)




// O PRIMEIRO DUMP VAI RETORNAR bool(true)  (bem estranho, pq os DATA TYPES SAO DIFERENTES, SAO NUMBER E STRING) -- idiossincrasia do PHP... forced type conversion...

// O SEGUNDO DUMP VAI RETORNAR bool(FALSE) (O QUE FAZ SENTIDO, PQ OS 2 DATA TYPES SAO REALMENTE DIFERENTES)...





















$xtzzf = 5;


$ytzzf = '5';



var_dump($xtzzf != $ytzzf); //vai retornar bool(false) (mesmo os 2 data types sendo diferentes... forced type conversion)...


var_dump($xtzzf !== $ytzzf); //vai retornar bool(true)  (pq nao sao iguais, sao 2 data types completamente diferentes, string e int)




// SINTAXE ALTERNATIVA DE != é <>











// TEMOS UM OPERATOR COMPLETAMENTE 


// DIFERENTE...






// É O SPACESHIP OPERATOR...







// ELE É ESCRITO ASSIM:



// <=>





// SPACESHIP --> <=> 


var_dump($x <=> $y); //retorna 0 se X FOR IGUAL A Y.... retorna -1 SE X É MENOR DO QUE Y, E RETORNA 1 SE __ O X __ FOR MAIOR DO QUE O Y...







// -------------------------






// ANTES DO PHP8,


// QUANDO UMA STRING ___ ERA COMPARADA A 1 NUMBER,




// A STRING ERA CONVERTIDA A 1 NUMBER ANTES 


// DA COMPARACAO... 




var_dump(0 == 'hello');


// ^^^^^^^^^^
// NO PHP 7.4,


// ESSA STRING AÍ 

// SERIA 
// CONVERTIDA 

// EM UM NUMBER... NESSA CONVERSAO, 

// A STRING SERIA CONVERTIDA A 0... ->  e entao 

// 0 == 0 RETORNARIA TRUE....






// MAS NO PHP8,

// ESSA STRING NAO É MAIS CONVERTIDA EM 1 NUMBER...

// EM VEZ DISSO,

// O QUE ACONTECE 

// É QUE 

// _ QUANDO A STRING NAO É NUMÉRICA,

// ____ O OUTRO __ LADO ( o zero )__ É QUE SERÁ CONVERTIDO ___ EM UMA STRING___, E ENTAO UMA STRING COMPARISON ACONTECERÁ...







// QUER DIZER QUE, NO PHP8,

// OCORRE ISTO:






// ISTO:


// var_dump(0 == 'hello');



// VIRA ISTO:


// var_dump('0' == 'hello');


// E É CLARO QUE ESSA EXPRESSION RESULTA EM FALSE,

// PQ OS VALUES DAS STRINGS NAO SAO IGUAIS...




var_dump(0 == '0'); //vai retornar true (pq a string vai ser convertida em number, e aí a comparison vai ocorrer)...













// --> O PROFESSOR É UM GRANDE FA DE 

// STRICT TYPING E STRICT COMPARISONS...  ( XXX === YYY ) 






// DEVEMOS TAMBÉM SEMPRE USAR STRICT COMPARISONS, QUANDO POSSÍVEL... PARA 

// EVITAR ERROS EM POTENCIAL...




// exemplo da importancia de STRICT COMPARISON..


$xa = 'Hello World';


$ya = strpos($xa, 'H'); //vai retornar 0... (pq é A PRIMEIRA LETRA DA STRING)... SE NAO ENCONTRAR ESSA STRING, RETORNARÁ FALSE...


if ($ya == false) {
    echo 'H not found';
} else {
    echo 'H found';
}



// strpos() 


// É UMA FUNCTION QUE RETORNA 




// OU O NÚMERO (int) 

// DA POSICAO EM QUE FOI ENCONTRADA AQUELA LETRA/SUB-STRING DENTRO DA STRING,

// OU 

// ENTAO 


// RETORNA FALSE (se nao foi encontrada essa substring dentro daquela 
// string)....







// -> AQUI, NO CASO, ELA RETORNARIA 0 (encontrou a string)  ou false (nao encontrou a string)...





// ELA ENCONTROU, POR ISSO RETORNOU 0... mas o 0 foi considerado como false pelo 

// php,


// dentro daquela LOOSE COMPARISON (com ==),

// O QUE 

// FEZ COM QUE ENTRÁSSEMOS NO IF BLOCk....









// agora o mesmo código, mas revisado e com lógica correta (e com STRICT COMPARISON, do false... que é diferente de 0, na verdade)...







// ex:





$xb = 'Hello World';


$yb = strpos($xb, 'H'); //vai retornar 0... (pq é A PRIMEIRA LETRA DA STRING)... SE NAO ENCONTRAR ESSA STRING, RETORNARÁ FALSE...


if ($yb === false) {  ///evitamos de entrar nesse if block, pq 0 NAO É IGUAL A ""false"" (diferentes data types, int vs boolean)...
    echo 'H not found';
} else {
    echo 'H found';
}














// POR FIM, TEMOS OS 2 ___ CONDITIONAL OPERATORS...






// SAO ELES: ?? e ?:











// ?    : --> É UM TERNARY OPERATOR...










// MESMA COISA QUE NO JAVASCRIPT....








$ternaryResult = $yb === false ? 'H Not Found' : 'H Found at Index' . $y;



echo $ternaryResult;














// -> MAS QUANDO VC STACKAR TERNARY OPERATORS,

// SEMPRE USE () --> POR 2 RAZOES:



// 1) NAO USAR PARENTESES FOI DEPRECADO NO PHP 7.4...



// 2) É BEM MAIS LEGÍVEL...





// O OUTRO 

// CONDITIONAL OPERATOR É 

// CHAMADO 

// DE 

// ""NULL COALLESCING OPERATOR"",

// E 

// ELE 

// É PRINCIPALMENTE USADO 

// QUANDO TRABALHAMOS COM NULLS...



//  esse operator é ??




$a = null;

$b = $a ?? 'hello';

var_dump($b); ///vai dumpar 'hello', esse será o output...




// """"A VARIÁVEL ___ b APENAS SERÁ 

// HELLO _ SE a _ FOR IGUAL A NULL""""  















// $x = "exemplo';



// $y = $x ?? 'hello';



// isso acontecerá (o $y terá o mesmo value de $x) 

// ATÉ MESMO SE O $x FOR false (
//     o caso de $y ser 'hello'

//     SÓ VAI ACONTECER 

//     SE $x for REALMENTE NULL...
// )











// ESSE OPERATOR, DE NULL COALESCING,



// PODE _SER ÚTIL ___ QUANDO 

// VC 


// TRABALHA 


// COM:



// 1) UNDEFINED VARIABLES 


// 2) UNDEFINED ARRAY KEYS...














// POR EXEMPLO,



// IMAGINE QUE NUNCA DEFINIMOS A VARIABLE DE $x...:











// $y = $x ?? 'hello';










// -> SE X NUNCA FOI DEFINIDO, 



// X SERÁ NULL... --> SE X FOR NULL,


// o 

// $y terá um value de HELLO...



