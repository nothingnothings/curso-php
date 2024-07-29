<?php



PHP_INT_MAX; //número máximo int possível - pode ser 4 bilhoes (32 bit systems) ou muito mais (64 bit systems).. 




PHP_INT_MIN; //número mínimo int possível - pode ser 4 bilhoes (32 bit systems) ou muito mais (64 bit systems).. 








$x = 5;  ///números podem ser displayed na base 10...



echo $x;


$y = 0x2A; ///exemplo de REPRESENTACAO DE HEXADECIMAL NUMBER, NO PHP... --> esse value é 42..



echo $y;




// NÚMEROS OCTAIS SAO PREFIXADOS POR "0"...
$z = 05; //exemplo de representacao de NÚMERO OCTAL, NO PHP ---> se ecoado, vai outputtar 5... 



echo $z;


$z2 = 055; //055 OCTAL --> SE ECOADO, OUTPUTTA 45...


echo $z2;




// NÚMEROS OCTAIS SAO PREFIXADOS POR "0b"...
$binary1 = 0b11; /// ISSO É 3....


echo $binary1;




$binary2 = 0b001; ///isso ecoa como 1...

echo $binary2;

$binary3 = 0b110; ///ISSO ECOA COMO 6 (em binários, 110 é 6...)


echo $binary3;



// EXEMPLO DE OVERFLOW NO PHP



$x = PHP_INT_MAX + 1;


var_dump($x);









$zzz = (int) 100;  //exemplo de type casting.

$x = (int) true; //SERÁ CASTADO COMO "1"... (pq convertemos esse boolean em 1 int, e a representacao int é 1...)

$x = (int) false; //SERÁ CASTADO COMO 0... (pq convertemos esse boolean em 1 int, e a representacao int é 0...)

$xxx = (int) 10.99; //será castado como 10 (perderá a casa decimal)...

$ddd = (int) "5"; //será castado como 5 (será convertido, de string para number).

$xyz = (int) '85sadassda'; ///será castado como 85 (o php tentará converter isso, sem erro.)

$xdadas = (int) 'exemplo'; ///VAI SER CASTADO/convertido COMO 0... (nao foi possível converter a string em um integer)...

$zero = (int) null; //TAMBÉM VAI SER CASTADO/CONVERTIDO COMO 0...




is_int($zzz); ///retorna true ou false, a depender se a variável é um integer ou nao... (no caso, true)...








$readableNumber = 2_000_000_000; //é a mesma coisa que 2 bilhoes, mas é mais readable (do que escrever 2000000000)






// --> OS UNDERSCORES SAO BASICAMENTE REMOVIDOS E IGNORADOS PELO PHP...

// MAS ISSO NAO FUNCIONA SE ESTIVER EM 

// 1 FORMATO 

// STRING...

// -> e se vc CASTAR ISSO COMO INT,

// ELE VAI 

// FICAR COMO "2" (pq tudo depois do 2 será removido)...