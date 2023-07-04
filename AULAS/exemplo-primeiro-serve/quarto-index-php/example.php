
<?php

// TODOS ESSES EXEMPLOS SAO __ SEM O STRICT MODE _ DO PHP ATIVADO (sem o throw de 1 error sempre que passamos 1 parameter de type errado, para 1 de nossas functions com declarations...)

function sum($x, $y)
{

    // var_dump($x, $y);
    return $x + $y;
}


$sum = sum(2, '3');


// echo $sum;



// var_dump($sum);




function sum2(string $x, string $y)
{

    // var_dump($x, $y);
    return $x + $y;
}







// $example = sum2(3, '6'); //ainda será uma INT, o resultado (e os números ainda serao somados)





// var_dump($example);





function sum3(int $x, int $y)
{

    // var_dump($x, $y);
    return $x + $y;
}








$exemplo4 = sum3(4.212131231232, '3'); //float + string -> e os types estao como 2 integers...






// var_dump($exemplo4); ///resultado será 7 ( e o float terá sido convertido em integer)...









function sum4($x, $y)
{

    var_dump($x, $y);
    return $x + $y;
}


$exemplo5 = sum4(4.212131231232, '3');



var_dump($exemplo5); ///resultado será um float, e será  float(7.212131231232)













function sumArray(array $x, int $y)
{


    var_dump($x, $y);
    return $x + $y;
}




sum(2.5, '3'); ///isso vai dar um ERROR (pq 2.5 nao é um array, e o php, ao tentar converter 2.5 para um array, vai dar throw desse error...)















// --> NO STRICT MODE,
// VC VAI RECEBER 1 ERRO 



// ATÉ MESMO SE VC TENTAR FAZER PASS 


// DE 1 PARAMETER 

// QUE __ __ PODERIA_ SER CONVERTIDO DINAMICAMENTE (


//     como passar 1 float a 1 param de type INTEGER...
// )






//para definir strict mode -> declare(strict_types=1)











$z = '5';



var_dump($x); //vai printar string(1) "5"







$z = (int) '5';   //? COM ISSO, CONSEGUIMOS _ CASTAR QUALQUER VALUE COMO QUALQUER TYPE (aqui castamos 1 STRING como INTEGER, como se ela fosse 1 numbeR)...