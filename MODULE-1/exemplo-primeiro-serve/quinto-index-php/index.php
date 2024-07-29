




<?php


// BOOLEANS 




$isComplete = true;



$isDone = false;



$isCompleteCasted = (string) true;


$isDoneCasted = (string) false;



$isComplete1 = TRUE;


$isComplete2 = FALSE;




if ($isComplete) { // É TRUE... -- o if vai executar...
    echo $isComplete;
} else {

    echo 'something went wrong';
}





if ($isComplete2) { // É false --> o else vai executar
    echo $isComplete;
} else {

    echo 'something went wrong';
}






$aZero = 0; //value falsy 


$aNegativeZero = -0; //value falsy também...


$aFloatZero = 0.0; //value falsy também...


$aStringZero = '0'; //value falsy  também.. (DIFERENTE DO JAVASCRIPT)


$anEmptyArray = []; //value falsy, também (DIFERENTE DO JAVASCRIPT)


//PRATICAMENTE TODAS AS OUTRAS COISAS SERAO EVALUATED COMO 1 (true), PQ NAO SERAO 0... ATÉ MESMO NEGATIVE NUMBERS...

$aNumber = 5; ///é true

$aFilledArray = [1, 2, 3, 4]; //É TRUE

$aFakeFalse = 'false'; //é true (TUDO QUE NAO É AQUELES CASOS ALI DE CIMA SERÁ EVALUATED COMO TRUE)

if ($aZero) { // É false --> o else vai executar
    echo $isComplete;
} else {

    echo 'something went wrong';
}



if ($aNegativeZero) { // É false --> o else vai executar
    echo $isComplete;
} else {

    echo 'something went wrong';
}



if ($aFloatZero) { // É false --> o else vai executar
    echo $isComplete;
} else {

    echo 'something went wrong';
}


if ($aStringZero) { // É false --> o else vai executar
    echo $isComplete;
} else {

    echo 'something went wrong';
}



if ($anEmptyArray) { // É false --> o else vai executar
    echo $isComplete;
} else {

    echo 'something went wrong';
}


if ($aNumber) { // É TRUE--> o if vai executar
    echo $isComplete;
} else {

    echo 'something went wrong';
}


if ($aFilledArray) { // É TRUE--> o if vai executar
    echo $isComplete;
} else {

    echo 'something went wrong';
}




//var_dump pode ser usado para CHECAR O VALUE DE 1 BOOLEAN (e de qualquer data type)...
var_dump($isComplete); ///vai retornar bool(true)

var_dump($isCompleteCasted); ///vai retornar string(1) "1"

var_dump($isDone); ///vai retornar bool(false)

var_dump($isDoneCasted); //vai retornar string(0) ""



is_bool($isComplete); ///is_bool É UMA FUNCTION BUILT-IN DO PHP QUE RETORNA TRUE OU FALSE A DEPENDER SE A VARIABLE É UM BOOLEAN OU NAO...



var_dump(is_bool($isComplete)); ///vai retornar ''bool(true)'' (pq is_bool vai retornar true, e aí true será identificado como 1 value de type bool(true), pelo var_dump)...


var_dump(is_bool($aFilledArray)); //vai retornar ''bool(true)'' (pq is_bool vai retornar true, e aí true será identificado como 1 value de type bool(true), pelo var_dump)...
