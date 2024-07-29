<?php








// AGORA VEREMOS OUTROS OPERATORS...


// __ VEREMOS O OPERATOR DE ""ERROR CONTROL""...


// ESSE OPERATOR É ESCRITO COM "@"...


// --> certo...


// O QUE ESSE OPERATOR FAZ...




// BEM, SE VC O ADICIONA A 1 EXPRESSION,


// ELE 


// VAI SIMPLESMENTE __ SUPRIMIR__ QUAISQUER 


// ERRORS 

// QUE 
// TALVEZ OCORRAM 


// NESSA EXPRESSION (


// E OS ERRORS 

// QUE ELE VAI SUPRIMIR 

// DEPENDERAO DE COMO VC CONFIGUROU 


// SEU ERROR HANDLING NO ARQUIVO 


// CONFIG do php..

// )












// exemplo de error handling:





// $x = file('foo.txt'); /// a function de file() basicamente LE UMA FILE, no php...



// entretanto, a file de foo.txt NAO EXISTE...
//  ! E ISSO DARÁ O THROW DE UM ERROR... mas se eu usar "@", o erro será SUPRIMIDo...



$x = @file('foo.txt');







// !!! o professor RECOMENDA QUE NUNCA UTILIZEMOS ESSE OPERATOR...








// INCREMENT E DECREMENT OPERATORS - sao:   ++ e --










// -> SERVEM PARA INCREMENTAR E DECREMENTAR...









// tipo assim 




$x = 5;


$x++;



++$x;




$x--;

--$x;






// É CLARO QUE HÁ DIFERENCAS ENTRE COLOCAR O ++ e -- na frente/atrás...





// ++$x; ----> É DIFERENTE:



// * PRIMEIRO ELE AUMENTA, E SÓ DEPOIS RETORNA O VALUE..




// --$x; ----> É DIFERENTE:


// * PRIMEIRO ELE decrementa, E SÓ DEPOIS RETORNA O VALUE..









$x = 5;



echo $x++;  //VAI RETORNAR 5 (pq retorna antes, e só depois incrementa)...



echo ++$x; //vai retornar 6 (pq INCREMENTA ANTES, e só depois retorna)...




// OK... MAS AQUI TEMOS 1 DETALHE ---> 


// OS OPERATORS DE INCREMENT E DECREMENT APENAS AFETAM 



// ____ NUMBERS E STRINGS_....








// --> QUER DIZER QUE __ ARRAYS, OBJECTS,

// BOOLEANS, RESOURCES E ETC 

// NAO



// SAO AFETADOS...




// TODO --> DECREMENTAR UM VALUE NULL NAO TEM EFEITO ALGUM, TAMBÉM...






// --> MAS __ SE FAZEMOS 




// INCREMENT DE NULL, FICAREMOS COM 1...












// DECREMENTING TAMBÉM NAO TEM EFEITO ALGUM 



// SOBRE STRING VALUES...







// MAS 



// O INCREMENT TEM EFEITO SOBRE STRING VALUES...




// EX:



$x = 'abc';


$x--;  //ISSO NAO TERA EFEITO ALGUM...


echo $x;

echo ' ';


$x++; //JÁ ISSO TERÁ EFEITO... --> VAI INCREMENTAR OS CARACTERES (vai transformar em abd)...

echo $x; //vai printar abd...











// LOGICAL OPERATORS:





// && 


// ||  pipe 





// ! 


// and (NAO é a mesma coisa que && )
// or  (NAO é a mesma coisa que || )  --> NAO É A MESMA __oRDER_ OF PRECEDENCE...

// xor 






$x = true;

$y = false;



$z = $x && $y;



var_dump($z); /// SE FAZEMOS O VARDUMP DISSO, FICAMOS COM FALSE... ESSE É O COMPORTAMENTO ESPERADO...








// CERTO... MAS SE USARMOS A KEYWORD "and" em vez de &&, o resultado será diferente...





$x = true;

$y = false;



$z = $x and $y;  //aqui, usamos ""and"" em vez de &&... A ORDER OF PRECEDENCE É DIFERENTE...



var_dump($z);  //por conta da order of precedence, o resultado será TRUE (e nao false).



//  "=" POSSUI UMA ORDER OF PRECEDENCE SUPERIOR À "and", por isso a expressao acaba sendo evaluated assim:  """($z = $x) and $y;"""", e é claro que isso retorna TRUE...







// --> É POR ISSO QUE 


// VC 

// DEVE TER MT CUIDADO,

// SE DECIDIR POR USAR 

// ESSAS KEYWORDS DE and, or e xor....












// CERTO...



// E QUANTO AO XOR?






// XOR CIRCUITING --> O PHP TEM ISSO,


// QUANDO O ASSUNTO É LOGICAL OPERATORS...



// ---> DIGAMOS QUE TEMOS  ISTO:




// $x = true;
// $y = false;




// var_dump($x || $y);




// ISSO VAI RETORNAR TRUE....  (pq x está como true, e é um OR)...



// -> mas se TEMOS UM XOR, TUDO MUDA... 




// PQ O XOR É O """"OR EXCLUSIVO""""




// OK, MAS COMO É ISSO...


// tenho que me lembrar da tabela verdade...



// 0 0 0

// 0 1 1 

// 1 0 1 

// 1 1 0



// --> QUER DIZER QUE....


// SE __ 1 DOS NEGÓCIOS FOR DIFERENTE DO OUTRO,



// A EXPRESSAO INTEIRA RETORNA VERDADEIRO...



// JA SE TODOS OS TERMOS FOREM IGUAIS, A EXPRESSAO RETORNA FALSE....





// ok...





$x = true;
$y = false;




var_dump($x || $y);








// NESSE EXEMPLO, A EXPRESSION INTEIRA RETORNA 

// TRUE,



// MAS O QUE INTERESSA É QUE A PARTE DE 

// "$y"



// """"NEVER GETS EVALUATED"""",


// PQ 



// __ ESSA PARTE DO """"CIRCUITO""""



// ACABA """SHORT-CIRCUITED"""" -->  ISSO PQ,


// PARA QUE 


// A 

// EXPRESSAO 


// OR RETORNE TRUE,

// BASTA QUE 

// 1 

// DOS OPERANDS 

// SEJA 


// EVALUATED COMO TRUEE....







// TEMOS 1 EXEMPLO MELHOR COM ESTE CÓDIGO, COM 1 FUNCTION:





$x = true;
$y = false;

function hello() //function simples
{

    echo 'Hello World';

    return false;
}








var_dump(($x && hello()));  ///nao há CURTO CIRCUITO, ambas expressoes sao lidas (pq o primeiro value era TRUE... aí ele continuou lendo... mas se o value fosse false, ele nao teria continuado lendo)...


// --> MAS SE O PRIMEIRO VALUE FOR FALSE,

// ELE VAI PARAR 

// DE CHECAR O RESTO... (pq se apenas 1 value for false,

// ele nao 
// precisa 

// checar o resto...)




var_dump(($x || hello())); //voce PODERIA PENSAR que _""hello world'" SERIA PRINTADO NA TELA...

// MAS ISSO NAO ACONTECE/NUNCA VAI ACONTECER (com o OR), JUSTAMENTE PQ ESSA PARTE DA EXPRESSAO __""NEVER GETS EVALUATED"" (por conta do OR operator)...













// MAS E SE ALTERÁSSEMOS A EXPRESSAO...








// TIPO ASSIM:






$x = false;
$y = false;







var_dump($x && hello() || true);  //RETORNA true






//  -> NESSE CASO, O QUE SERIA PRINTADO?



// BEM... 



// NESSE CASO,

// __ A FUNCTION DE HELLO() TAMBÉM NAO SERIA EXECUTADA...

// MAS PQ...


// -_> BEM, SE CHECARMOS O DUMP, ELE RETORNOU TRUE....





// --> isso quer dizer que o value de "true",


// o segundo argumento do ||,


// foi evaluated...



// --> A RAZAO DE hello()

// NUNCA TER SIDO EXECUTADO 

// É JUSTAMENTE 

// OPERATOR PRECEDENCE.... OPERATOR PRECEDENCE E __ ASSOCIATIVITY...








// MAS BASICAMENTE  O QUE ACONTECE AQUI 


// É QUE __ O OPERATOR __ 




// DE ___ AND __  


// TEM __ MAIOR __ PRECEDENCE 




// DO _ QUE _ O OPERATOR DE """"OR'""'





// ORDER OF PRECEDENCE:


// 1) BANG OPERATOR (!)

// 2) AND OPERATOR (&&)

// 3) OR OPERATOR (||)


var_dump($x && hello() || true); /// a parte de ($x && hello()) É EXECUTADA ANTES DA OUTRA... E É EVALUATED COMO FALSE... só depois disso o ""||""  É EVALUATED...


// e é justamente por isso que o resultado final da operation é true...











// OK.... AGORA FALAREMOS SOBRE OPERATORS INEDITOS...





// OS BITWISE OPERATORS... (& | ^ ~ << >>)






// ---> PARA ISSO, DEVEMOS PENSAR EM __ BITS__ 

// COMO SWITCHES 
// DE 

// ON-OFF...



// --> OU SEJA,
// DEVEMOS 

// PENSAR EM BINÁRIOS...





// -> VC _ PODE  USAR 

// OS BINARY OPERATORS 
// PARA """"FLIP""" ESSES SWITCHES...




// -> ou seja,

// PODEMOS MUDAR O 0 PARA 1, E VICE-VERSA...

// TAMBÉM PODEMOS USAR ESSES OPERATORS PARA __ SHIFTAR 

// OS BITS, LEFT TO RIGHT... TUDO PARA CONSEGUIR O 

// RESULTADO 

// DESEJADO..





// O PRIMEIRO OPERATOR É "&"...
// ELE RETORNA __ BITS _ SETTADOS TANTO EM X COMO Y... (Axis, acho)...




//  EXEMPLO --> 



$x = 6;
$y = 3;



// binário:
// 110 - 6
// 011 - 3



// operacao:

// 110
// &
// 011
// ---
// 010  //RESULTADO FOI 010, que é ___2__ decimal, em binários...





// -> ok... 

// MAS O QUE FAZ O OPERATOR DE "&"?




// ELE É TIPO UM __"""MINI AND""" 





// PARA CADA __ BIT (casa)
// DESSES NÚMEROS (representacao binária),



// VAMOS RETORNAR 1 __ APENAS _ 

// SE OS 2 NUMBERS (ou mais ) TIVEREM 1 




// NAQUELE BIT..






var_dump($x & $y); //ISSO RETORNA int(2)  (DOIS).. --> MAS PQ RETORNOU 2...














// --------- CERTO... DEPOIS DO & (mini and), temos o | (MINI OR)...








$x = 6;
$y = 3;



// binário:
// 110 - 6
// 011 - 3






// operacao:

// 110
//  |
// 011
// ---
// 111  //RESULTADO FOI 111, que é ___7__ decimal, em binários...




var_dump($x | $y);  ///vai retornar 7, que é 111 em binários...












// ----------------------------




// DEPOIS DISSO, TEMOS O OPERATOR XOR... mini xor (BITWISE XOR) 



// É O """"BITWISE XOR""""" operator (mini xor)...




//  esse operator é  " ^ "




//  OK... O QUE ELE FAZ... ele provavelmente executa o circuito lógico do XOR...


// E ESSE CIRCUITO É:


// 0 0 0

// 0 1 1 

// 1 0 1 

// 1 1 0






// DEVEMOS EXECUTAR ISSO COM NOSSOS VALUES...




// tipo assim:






$x = 6;
$y = 3;




// binário:
// 110 - 6
// 011 - 3



// operacao:

// 110
//  ^    (xor)
// 011
// ---
// 101  //RESULTADO FOI 101, que é ___5__ decimal, em binários...




var_dump($x ^ $y);  //retorna 5...







// CERTO...

// DEPOIS DISSO,



// TEMOS...


// O OPERATOR 

// DE _ NEGATION_....


// ESSE OPERATOR SIMPLESMENTE ""FLIPPA"" os bits...



// ESSE OPERATOR É ~ ...






// EX:






$x = 6;
$y = 3;




var_dump(~$x & $y); //vai retornar 1, cálculo abaixo..


// operacOES:


// 1) flippar os bits de x....



// 110 (6) VIRA 001 (1)...



// 2) realizar o AND (mini and) COM OS 2 VALUEs:



// 001
//  &
// 011
// ---
// 001  //RESULTADO FOI 001, que é ___1__ decimal, em binários...





// ---------------------------









//  POR FIM, TEMOS ESTES 2 OPERATORS ------   << e >> ...









// ESSES OPERATORS BASICAMENTE 




// __ SHIFTAM__ BITS PARA A ESQUERDA E PARA A DIREITA...



// -_> OK, MAS O QUE O PROFESSOR QUER DIZER COM ""SHIFTAR BITS""?

// --> ELE QUER DIZER QUE, SEMPRE QUE 

// 1  BIT É __ SHIFTADO,


// ELE __ É _ DIVIDIDO POR 2 OU __ MÚLTIPLICADO POR 2...



// --> CADA SHIFT PARA A ESQUERDA __ MÚLTIPLICA __ ESSE BIT POR 2...



// ---> CADA SHIFT PARA A DIREITA __ VAI  DIVIDIR __ ESSE BIT POR 2....


// ok, mas como calculo isso...







// DIGAMOS QUE QUEREMOS SHIFTAR 6 POR 3...







// ESCREVEMOS ASSIM:






$x = 6;
$y = 3;





// binário:
// 110 - 6
// 011 - 3



//  1) BASTA SHIFTAR 110 __ 3 VEZES___....


// 110
//  <<
//
// ---
// 


//  2) PARA SHIFTAR O 110 3 VEZES, 
// BASTA FAZER O APPEND DE 3 ZEROS AO FINAL DESSE BINÁRIO, TIPO ASSIM:

// 110 VIRA 
// 110 000
// 110000   //CERTO....





var_dump($x << $y); //resulta em 48... 32 + 16.... 







// ok, ESSE FOI O SHIFT PARA A ESQUERDA... nós realmente multiplicamos 6 por 2, 3 vezes...


// 6 x 2 = 12 


// 12 x 2 = 24 

// 24 x 2 = 48








// ok, mas COMO É O SHIFT PARA A DIREITA? --> 
// NO SHIFT PARA A DIREITA,





// NÓS VAMOS __ DESCARTAR OS BITS____ 

// EM VEZ 

// DE __ ADICIONAR ZEROS...









// TIPO ESTA OPERACAO



$x = 6;
$y = 3;





// 110
//  >> (DESCARTAMOS OS 3 ÚLTIMOS NUMEROS) --> 110 --> 0 -->  FICAMOS COM 0...
//
// ---
// 



var_dump($x >> $y); //vai retornar 0 










$x = 6;
$y = 1; //shiftaremos por apenas 1 bit/slot



// 110
//  >> (DESCARTAMOS O PRIMEIRO NÚMERO) --> 110 --> 11 -->  FICAMOS COM 11, que é 3 em binário...
//
// 
// 

var_dump($x >> $y);  ///vai retornar 3... (mesma coisa que dividir 6 por 2, que dá 3)...













// OK... AGORA APENAS 1 DETALHE SOBRE OS BITWISE OPERATORS...










// DETALHE -> AMBOS OPERANDS,

// X E Y,


// SAO 

// CONVERTIDOS EM __INTEGERS...




// -> ELES SAO CONVERTIDOS EM INTEGERS,


// E AÍ OS 

// BITWISE OPERATORS 

// SAO 

// APLICADOS


//  NESSAS INTEGERS...




// a ÚNICA EXCECAO É SE X E Y 

// FOREM __ STRINGS..



// --> NESSE CASO, 


// AS OPERATIONS SERAO REALIZADAS NOS VALUES ASCII 

// DOS CARACTERES 

// INCLUSOS NAS STRINGS...









// OK.... MAS QUAL É A UTILIDADE DE BITWISE OPERATORS...






// HÁ ALGUNS...









// -> E VEREMOS ELES __ UTILIZADOS DENTRO 

// DAS CONFIG FILES DO PHP..








// -> MAS ALGUNS DOS USE-CASES SAO:



// 1) ENCRYPTION 




// 2) PARA ARMAZENAR ALGUMAS _ FLAGS_ COMO BITS....




// 3) VC PODE ATÉ MESMO USÁ-LOS PARA ARMAZENAR 
// PERMISSIONS... (
//    EX: em vez de ter múltiplas tables em que 

//    vc 
//    ARMAZENA ROLES E PERMISSIONS E TEM JOINS,


//    SE 

//    VC 

//    TIVER 1 SMALL TO MEDIUM APPLICAITON,


//    VC PODE ACTUALLY ""GET AWAY"" 

//    COM O STORE DE PERMISSIONS EM BITS... bem estranho..
// )








// AGORA DEVEMOS REVISAR ARRAY OPERATORS... ALGUNS DELES SAO UTEIS...


// --> ISSO PQ ALGUNS OPERATORS, QUANDO USADOS COM ARRAYS,

// SE COMPORTAM DE MANEIRAS DIFERENTES...



// PRIMEIRO, O OPERATOR DE "+"...



// DEFINIMOS ASSIM:





$x = ['a', 'b', 'c'];

$y = ['d', 'e', 'f'];



$z = $x + $y; /// O OPERATOR VAI COMPUTE A __ UNIAO _ DESSES 2 ARRAYS... (mas aqui, o array de $x continuará intacto)



print_r($z); //vai printar [a, b, c]




// -------> ok... QUANDO DIZEMOS UNIAO,

// SIMPLESMENTE QUEREMOS DIZER __ """"PEGUE 


// TODOS OS VALUES _ DO ARRAY DE Y __ 

// E FACA APPEND __ AO ARRAY _ DE X, ao final""",




// ISSO 

// SE 


// OS ELEMENTOS NAO EXISTIREM NO MESMO INDEX/KEY...







// TODO --> BEM, NESSE EXEMPLO AQUI, COMO OS 

// ELEMENTOS 'd' 'e' e 'f' 


// ESTAO NOS EXATOS MESMOS INDEXES DE a, b e c,


// __ QUANDO FIZERMOS A UNION,


// __ O QUE VAI ACONTECER É QUE 

// __ O 

// X __ NAO VAI SOFRER MUDANCA ALGUMA... VAI CONTINUAR SENDO 

// A,B E C...







// OUTRO EXEMPLO (agora com mais items no array de y):








$x = ['a', 'b', 'c'];

$y = ['d', 'e', 'f', 'g', 'h'];



$z = $x + $y; /// O OPERATOR VAI COMPUTE A __ UNIAO _ DESSES 2 ARRAYS... (NO CASO, SÓ OS ELEMENTOS g e h SERAO APPENDADOS AO ARRAY DE x)...



print_r($z); //vai printar [a, b, c, g, h]  (indexes 0,1,2,3 (g) ,4 (h))







// ------------------
// AS COISA SAO DIFERENTES COM ASSOCIATIVE ARRAYS


// EX:



//ASSOCIATIVE ARRAYS (com keys definidas):



$x = ['a' => 1, 'b' => 2, 'c' => 3];

$y = ['d' => 4, 'e' => 5, 'f' => 6, 'g' => 7, 'h' => 8];




$z = $x + $y; /// O OPERATOR VAI COMPUTE A __ UNIAO _ DESSES 2 ARRAYS... como as keys nao matcheiam, os 2 arrays realmente serao totalmente combinados...



print_r($z);




// -> OK... MAS SE ALGUM DESSES ITEMS, NO ARRAY Y,

// TIVESSE 

// A MESMA KEY DE ALGUM 

// ELEMENTO 

// DO ARRAY X,



// ESSE ITEM NAO FARIA/NAO FAZ O OVERWRITE 


// DO ITEM COM MESMO INDEX/KEY, LÁ NO ARRAY X...



// EX:



$x = ['a' => 1, 'b' => 2, 'c' => 3];

$y = ['a' => 4, 'e' => 5, 'f' => 6, 'g' => 7, 'h' => 8];




$z = $x + $y; /// O ÚNICO ELEMENTO QUE NAO SERIA COPIADO SERIA o a de valor 4, pq 1 key de nome "a" JÁ EXISTE EM x...



print_r($z);









//  DEPOIS DISSO, TEMOS COMPARISON E STRICT COMPARISON OPERATORS, COM ARRAYS...









// 



// DEPOIS DISSO, TEMOS COMPARISON E STRICT COMPARISON OPERATORS...





// JÁ VIMOS ESSES OPERATORS...






// MAS COM ARRAYS, SEU COMPORTAMENTO MUDA...



// COM O LOOSE COMPARISON OPERATOR (==),



// SERÁ RETORNADO 

// TRUE 


// SE 


// AMBOS OS ARRAYS TIVEREM OS MESMOS KEY-VALUE PAIRS...



// ex:



$x = ['a' => 1, 'b' => 2, 'c' => 3];

$y = ['a' => 4, 'e' => 5, 'f' => 6, 'g' => 7, 'h' => 8];


$z = $x == $y;



var_dump($z); /// Z SERÁ FALSE (pq os 2 arrays nao sao iguais, key-value pairs diferentes... devem ser totalmente iguais)







$x = ['a' => 1, 'b' => 2, 'c' => 3];

$y = ['a' => 1, 'b' => 2, 'c' => 3];


$z = $x == $y;



var_dump($z); /// Z SERÁ TRUE (pq os 2 arrays sao ""iguais"") (os data types dos values podem ser diferentes 1 em relacao ao outro, mas os values devem ser iguais)










// O STRICT COMPARISON OPERATOR _ _TAMBÉM É DIFERENTE.... DIFERENTE DO JAVASCRIPT



//  É DIFERENTE PQ __ O QUE IMPORTA, PARA ELE, É QUE:

// 1) TODAS AS KEYS SEJAM IGUAIS 

// 2) TODOS OS VALUES SEJAM IGUAIS 

// 3) TODOS OS DATA TYPES DOS VALUES SEJAM IGUAIS

// 4) A ORDEM DOS ITEMS TAMBÉM DEVE SER A MESMA, DENTRO DO ARRAY...

// 5) NAO INTERESSA SE ""SAO O MESMO OBJECT OU NAO"" ( o que interessa é os values, para esse operator)...



// EX:





$x = ['a' => 1, 'b' => 2, 'c' => 3];

$y = ['a' => 1, 'b' => 2, 'c' => 3];


$z = $x == $y;



var_dump($z); // Z SERÁ TRUE 
// (pq os 2 arrays sao ""iguais"" na perspectiva do php) (a order é a mesma, e os data types tambem sao iguais)
