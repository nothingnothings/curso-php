


<?php




// EXEMPLO DE VARIABLES E CONSTANTS...






// EXEMPLO DE VARIÁVEL CLÁSSICA (que pode ser alterada)...

$firstName = 'Arthur';

$firstName = 'Joe';

echo $firstName; ## VAI OUTPUTTAR ""JOE""


// EXEMPLO DE __CONSTANTE__ (nao pode ser alterada)...

// PARA DEFINIR CONSTANTES, NO PHP, SOMOS OBRIGADOS A USAR A FUNCTION DE define()...



define('SECOND_NAME', 'Panazolo'); /// aqui criamos 1 constante de nome SECOND_NAME, de value PANAZOLO





define('A_NAME', "Sujeito"); // A NAMING CONVENTION DE CONSTANTES É __ TUDO EM UPPERCASE_...




echo SECOND_NAME, A_NAME;


// OK... MAS AQUI TEMOS UMA DIFERENCA CRUCIAL...

// COM VARIABLES,

// QUANDO 

// AS UTILIZAMOS,

// ESCREVEMOS 

// '$' na frente...

// JÁ COM CONSTANTS,


// QUANDO QUEREMOS AS UTILIZAR,

// USAMOS SEUS NOMES 

// _ SEM '$' NO INÍCIO...





echo defined(SECOND_NAME); ## SERVE PARA _ CHECAR_ SE 1 DETERMINADO CONSTANT NAME ( 1 constant) JÁ FOI USADO/DEFINIDO,...

// retorna 1 ou 0 (true ou false)..



echo defined(SECOND_NAME); ## vai retornar 1 (true, já foi definido).



echo defined(VOID_THING); ## vai retornar 0 (false, ainda nao foi definido).









const A_NEW_CONSTANT = "EXEMPLO"; ## É OUTRA MANEIRA DE DEFINIR CONSTANTS..



// CONSTANTS CRIADAS COM ""const"" keyword SAO _ CRIADAS _ACTUALLY _ DURANTE _O COMPILE TIME...



// JÁ CONSTANTS CRIADAS COM ""DEFINE()"" SAO DEFINIDAS _ DURANTE _ O RUNTIME...















// A DIFERENCA ENTRE 




// OS 2 APPROACHES É QUE 

// AS CONSTANTS 

// DEFINIDAS 

// COM ""const"" 


// SÃO DEFINIDAS __ DURANTE__ O ""COMPILE TIME""...




// JÁ CONSTANTS CRIADAS COM A FUNCTION DE ""define()""

// SAO DEFINIDAS _ DURANTE _ O RUNTIME...



// --> OK.... MAS QUAL É O EFEITO PRÁTICO DISSO...




// --> O EFEITO É 

// QUE 

// VC _ SÓ __ PODE __ DEFINIR __ CONSTANTES _ 


// DENTRO DE _ _CONTROL STRUCTURES (for loops, while statements, if-else, etc)



// _ por meio _ da FUNCTION DE DEFINE()....




// A KEYWORD DE """CONST"" NAO FUNCIONA, PARA DEFINIR CONSTANTES,

// DENTRO 



// DE CONTROL STRUCTURES...



//  ISTO FUNCIONA...
if (true) {
    define('STATUS_PAID', 9);
}


// ISTO NAO FUNCIONA

// if (true) {
//    const STATUS_PAID = 9; //! ERRADO - CONST KEYWORD DENTRO DE CONTROL STRUCTURE...
// }











$paid = 'PAID';



define('STATUS_' . $paid, $paid); ##PODEMOS CRIAR NOSSA CONSTANT/DEFINIR O CONSTANT NAME _ DINAMICAMENTE...


echo STATUS_PAID; //isso ficará definido...










// TAMBÉM EXISTEM PRE-DEFINED CONSTANTS, NO MUNDO PHP...



// AS CONSTANTS SAO COISAS COMO PHP_VERSION, PHP_BINARY, PHP_BINARY_READ, PHP_EXTRA_VERSION, etc..



// ex: 


echo PHP_VERSION; ## ISSO NOS MOSTRA A VERSION DO PHP QUE ESTÁ EXECUTANDO ESSA FILE..
















// --> SAO BASICAMENTE 


// CONSTANTS,

// MAS SAO CHAMADAS 

// DE MAGIC 

// PQ 


// SEU VALUE 
// PODE ACTUALLY MUDAR 



// __DEPENDENDO __ 



// DO LOCAL EM QUE SAO USADAS...







//  EXEMPLO DE MAGIC CONSTANT -> __LINE__...



// ex:


echo __LINE__; ## PRINTA A LINHA ATUAL DESTE ARQUIVO... ---> vai printar 274...





// TEMOS A MESMA COISA COM O 


// __FILE__ -->  ISSO VAI PRINTAR O FILE_PATH EM QUE É USADO esse arquivo... O FULL PATH...













// EXEMPLO DE VARIABLE VARIABLES...


$exemplo = 'arroz';




$$exemplo = 'feijao';   //essa é uma VARIABLE VARIABLE...



echo $arroz, $$exemplo; //ambos funcionam, e ambos printarão 'feijao'




echo "string exemplo com variable variable no interior {$$exemplo}"; ## faça isso, se quiser outputtar essa VARIABLE VARIABLE no interior de uma string... (expansion)..












// BEM, 




// 1 VARIABLE VARIABLE 





// __ESSENCIALMENTE_ 


// PEGA O VALUE 


// DA VARIABLE,

// E AÍ 




// __TRATA ___ COMO __ O ___ NOME __ DA 


// NOVA VARIABLE...









// --> ISSO QUER DIZER, EM OUTRAS PALAVRAS,







// QUE 



// $$exemplo = 'feijao';












// É ___ A MESMA COISA __ QUE ESCREVER 






// $arroz = 'feijao';













// ISSO ACONTECE BASICAMENTE POR CONTA DE ""EXPANSION""...











// --> isso pq "$exemplo", ESSA VARIÁVEL,
// É EQUIVALENTE AO VALUE DE 

// "arroz"....







// agora imagine assim:


// $($exemplo) 



// AÍ TROCAMOS O EXEMPLO POR "arroz",
// o que 
// quer dizer que fica assim:




// $(arroz) ------> E AÍ TERMINA ASSIM:



// $arroz 








// --> E, AÍ ,


// A PARTE DO VALUE CONTINUA A MESMA, TIPO ASSIM:






// $arroz = 'feijao';

















// ----> BASICAMENTE DIZEMOS 


// """PEGUE O VALUE DA VARIÁVEL EXEMPLO (arroz)

// __ E ENTAO USE ISSO COMO __ NOME _ DA NOVA VARIÁVEL (que vai ser 'arroz', com value de feijao)"" 







// ------------------------------------






// o IDE PODE mostrar que isso está errado, mas está certo...













// SE VC QUISER EVENTUALMENTE PRINTAR 



// ESSA VARIABLE, VC PODE 


// ESCREVER OU 


// $arroz ou 

// $$exemplo...




// TIPO ASSIM:



