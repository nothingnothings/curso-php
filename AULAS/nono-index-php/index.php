<?php

// NULL É UM DATA TYPE ESPECIAL, QUE REPRESENTA

// UMA VARIABLE SEM VALUE...


// --> UMA VARIABLE PODE SER NULL SE:



// 1) FOR ASSIGNADA A ELA A CONSTANTE ""NULL""




// 2) SE ELA AINDA NAO FOI DEFINIDA...



// 3) ELA FOI _""UNSET""...













// exemplo de 1:


$x = null;

//pode também ser escrito com uppercase:

// $x = NULL;



















// --> SE FAZEMOS ECHO DE null,


// FICAMOS COM ""NOTHING""....







// ISSO FAZ SENTIDO,

// PQ QUANDO 


// ECOAMOS ALGO,

// ESSA COISA É PRIMEIRAMENTE CASTADA A UMA STRING --> E O CAST DE STRING DE NULL É "" (nada, empty string)...








// MANEIRAS DE CHECAR POR NULL:


var_dump($x); ///VAI RETORNAR ""NULL" pq esse é o value que colocamos dentro dessa variable...






is_null($x); // ISTO CHECA SE 1 GIVEN VARIABLE É NULL...



echo $x === null; //vai retornar TRUE (1) ou FALSE (nada)..

var_dump($z); ///vai retornar 1 ERRO DE ""UNDEFINED VARIABLE"", e também vai retornar NULL (pq essa variable nunca teve seu value definido)...








// --> se chamarmos 


// is_null EM CIMA 
// DESSA VARIÁVEL QUE NUNCA FOI DEFINIDA,




// VAMOS GANHAR "bool(true)" (sinalizando que nunca foi definido),


// E ENTAO 

// RECEBEREMOS O MESMO ERROR (de undefined variable)....












//  A TERCEIRA MANEIRA DE DEFINIR 1 VARIABLE COMO NULL, QUE NAO EXISTE NO JAVASCRIPT, É COM o method/function de "unset(nome_da_variable)" --> isso ESSENCIALMENTE DESTRÓI ESSA VARIABLEE...









$x = 123;


var_dump($x);



unset($x);

var_dump($x); ///RETORNA null (e um erro de que essa variable x está como undefined)...





// OK.. AGORA DEVEMOS FALAR SOBRE O CASTING...

// O CASTING... -> QUANDO O NULL É CONVERTIDO 

// PARA 1 STRING,

// COMO MENCIONAMOS ANTERIORMENTE,




// ESSE NULL 

// SERÁ CONVERTIDO A UMA EMPTY STRING...






// EX:


$xyz = null;

var_dump((string) $xyz); //VAI RETORNAR ""string(0) '' ""











// SE CASTAMOS ISSO A INTEGER,

// O X (null)  SERÁ 


// CASTADO A 0...










// --> SE CASTAMOS O NULL A BOOLEAN,

// ELE SERÁ CASTADO COMO FALSE...



// -> E SE CASTAMOS O NULL A 1 ARRAY,

// ELE É CASTADO A 1 EMPTY ARRAY...