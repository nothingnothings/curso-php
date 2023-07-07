<?php



// OPERATOR PRECEDENCE E ASSOCIATIVITY 






// QUANDO MÚLTIPLOS 
// OPERATORS SAO USADOS EM 1 EXPRESSION,



// ELES SAO AGRUPADOS POR SUA PRECEDENCE...


// --> E SE ELES TIVEREM A MESMA PRECEDENCE,



// É A ___ASSOCIATIVITY___ QUE DEFINE COMO 
// ELES SAO AGRUPADOS...



// ORDEM:





// 1) ** 


// 2) ++ -- ~

// 3) instanceof 



// 4) ! 



// 5) * / % 


// 6) + - . 


// 7) << >> 

// 8) == === !== !==


// 9) & 


// 10) ^



// 11) | 



// 12) && 


// 13) ||


// 14) ??


// 15) ? : 


//  16 ) + -  += -= *= /=







// TEREMOS O EXEMPLO MAIS SIMPLES:





// $x = 5 + 3 * 5;





// SEM PRECEDENCE,




// A COISA SERIA ASSIM:





// 1)  5 + 3 = 8 



// 2) 8 * 5 = 40



// OK... MAS ISSO ACONTECERIA SÓ SE NAO EXISTISSE 
// PRECEDENCE...


// --> MAS COMO TEMOS PRECEDENCE,
// A MÚLTIPLICACAO ACONTECE ___ aNTES__ DA SOMA...





//  É POR ISSO QUE FICA ASSIM:



// 1)  3 * 5 = 15



// 2) 5 + (15) = 20 












// É POR ISSO QUE O RESULTADO É 20, E NAO 40... 






$x = 5 + 3 * 5;


echo $x; //resultado é 20 (5 * 3 = 15; 15 + 5 = 20).


echo " ";





// OK.... MAS SE VC QUISER QUE A EXPRESSAO ""5 + 3""


// SEJA EXECUTADA __ ANTES DE " 3 * 5 ",


// vc DEVE ENVELOPPAR 

// A EXPRESSAO COM PARENTESES...


// (PQ COM ISSO NÓS __ FORCAMOS __ PRECEDENCE....)



// TIPO  ASSIM:


$x = (5 + 3) * 5;  /// 15 * 8 = 40;   (mudamos completamente o resultado, com uns simples parenteses)...




echo $x;



echo " ";








// --> QUANDO 2 OPERATORS TEM A MESMA PRECEDENCE,

// O QUE 
// DECIDE 




// A MANEIRA PELA QUAL 


// OS VALUES SAO AGRUPADOS __ É A ASSOCIATIVIDADE...







// VEJA ESTA TABELA:





// Operator Precedence




// Associativity	Operators	Additional Information
// (n/a)	        clone new	    clone and new
// right	        **	            arithmetic
// (n/a)	        + - ++ -- ~ (int) (float) (string) (array) (object) (bool) @	arithmetic (unary + and -), increment/decrement, bitwise, type casting and error control
// left	        instanceof	        type
// (n/a)	            !	           logical
// left	            * / %	        arithmetic
// left	            + - .	        arithmetic (binary + and -), array and string (. prior to PHP 8.0.0)
// left	            << >>	            bitwise
// left	            .	                    string (as of PHP 8.0.0)
// non-associative	   < <= > >=	            comparison
// non-associative	    == != === !== <> <=>	    comparison
// left	                &	                    bitwise and references
// left	                ^	                        bitwise
// left	                |	                        bitwise
// left	                &&	                        logical
// left	                ||	                        logical
// right	                ??	                        null coalescing
// non-associative	        ? :	                        ternary (left-associative prior to PHP 8.0.0)
// right	         = += -= *= **= /= .= %= &= |= ^= <<= >>= ??=	        assignment
// (n/a)	            yield from                          	yield from
// (n/a)	            yield	                                yield
// (n/a)	            print	                                print
// left	            and	                                    logical
// left	            xor	                                    logical
// left	            or	                                    logical














// CERTO... COMO VOCE PODE OBSERVAR,

// NESSA TABELA 


// TEMOS O VALUE DE ASSOCIATIVITY DE CADA 1 DOS OPERATORS...












// --> E COMO ASSIGNMENT 


// TEM 1 VALUE DE ASSOCIATIVITY DE ""RIGHT"",


// ISSO SIGNIFICA QUE 



// A EXPRESSAO É LIDA """"DA DIREITA PARA A ESQUERDA"""



// --> quer dizer que:





// 1) $y = 5;


// 2) $x = (resultado da primeira expressao)














// OK... AGORA OUTRO EXEMPLO....



// --> TEMOS ISTO:



$x = 5;


$y = 2;


$z = 10;


$result = $x / $y * $z;



echo $result;


// --> SE OLHARMOS A TABELA,

// VEREMOS QUE:



// 1) A MAIOR PRECEDENCE É * e / ....



// 2) MAS ELES TEM A MESMA PRECEDENCE...



// 3) COMO POSSUEM A MESMA PRECEDENCE, OLHAMOS O VALUE 
// DE ""ÄSSOCIATIVITY"", que é __LEFT__ (left = lemos da esquerda para a direita, as 
// expressoes)..




// --> É POR ISSO QUE A EXPRESSAO É LIDA ASSIM:


// $x = 5;


// $y = 2;


// $z = 10;


// $result = $x / $y * $z;


// 1) $x / $y = 2.5

// 2) (resultado da primeira expressao, 2.5) * $z (10) = 25  --> O RESULTADO É 25...







// CERTO...





// DEPOIS DISSO, TEMOS 




// """"OPERATORS COM _ MESMA PRECEDENCE __ E QUE 

// SAO NON-ASSOCIATIVE'""" ->  sao operators 

// que 



// _____ NAO PODEM __ SER USADOS UNS DO LADO 

// DOS OUTROS...



// (no caso, 

// SAO < <= > >=)





// EXEMPLO:

// $x = 5;


// $y = 2;


// $z = 10;


// $result = $x < $y > $z; //! nao funcionará. vai dar 1 error... (por conta da non-associativity entre > e <)



// ISSO __ NAO FUNCIONARÁ...











// ENTRETANTO,


// VC PODERIA 

// USAR, NESSA EXPRESSAO, OPERATORS COM PRECEDENCE DISTINTA,


// TIPO O "==" com esses ">" e "<"....



// TIPO ASSIM:



$x = 5;


$y = 2;


$z = 10;


$result = $x < $y == $z;



echo " ";

echo var_dump($result); //vai retornar false...




// EXPRESSAO SOLUCIONADA (ordem):



// OPERATORS DIFERENTES, PRECEDENCE DIFERENTE ENTRE ELES...

// OPERATORS DE < e > (comparison) POSSUEM _ MAIOR _ PRECEDENCE DO QUE OPERATORS "==" (também comparison, mas menor precedence)...

// 1) LEMOS PRIMEIRAMENTE A PARTE DE ">" e "<"... --> $x NAO É MENOR DO QUE $y --> FALSE...

// 2) SÓ DEPOIS LEREMOS A PARTE DE  "(resultado) == $z;" --> QUE RETORNA FALSE (false nao é igual a 10)...


// 3) com o operator de "=", assignamos um value de false à variável $result...









// ERTO... MAS AGORA DEVEMOS VER ALGUNS EXEMPLOS 


// COM OS LOGICAL OPERATORS...












// DIGAMOS QUE TEMOS ISTO:











// $x = true;
// $y = false;






// var_dump($x && !$y);








// COMO É AVALIADA ESSA EXPRESSAO, QUAL É A ORDEM?

// é assim:



// 1) O OPERATOR COM MAIOR PRECEDENCE É ! (bang)... -> converte y em TRUE...




// 2) depois disso, o operator com maior precedence é && --> true e true DÁ TRUE...


// 3) por isso o var_dump dá TRUE...






// outro exemplo...









// TEMOS ISTO:



$x = true;
$y = false;
$z = true;



var_dump($x && $y || $z);



// OU SEJA,
 
//  TEMOS """""X E Y OU Z""""





// para resolver isso, devemos 

// repetir 


// a resolucao:






// 1) QUAL TEM MAIOR PRECEDENCE... --> o and TEM MAIOR PRECEDENCE DO QUE ""or""



// por isso lemos a parte de 

// "x && y" PRIMEIRO -----> ELA RESULTA EM FALSE..

// 2) pegamos o resultado dessa expression, false,
//  e rodamos com o OR do z...

//  tipo assim:


//  (resultado, false) || $z (True) ----> OU SEJA,

//  RESULTARÁ EM TRUE (
//     consequencia de   ""false || true ""
//  )


// 3) o dump vai dumpar TRUE..
















// --> 


// conforme mencionado 


// no video anterior,



// TEMOS 
// 2


// VARIANTES DE LOGICAL OPERATORS....






// ISTO:

// &&  ||



// e 


// isto:




// and or 




// and or xor 



// POSSUEM 

// A MENOR PRECEDENCE EXISTENTE...







// PODEMOS DEMONSTRAR ISSO POR MEIO DE 1 EXEMPLO...



// ex:



// $x = true;
// $y = false;





// $z = $x && $y;


// 1) O && possui uma precedence maior do que "="...


// por isso, 


// rodamos true e false --> isso dá FALSE...




// 2) DEPOIS, RODAMOS O "=" (assignment) --> ISSO assigna o value de z 


// como sendo false...




// -> OK, MAS SE TROCARMOS o && por and,


// ficamos com isto:





// $x = true;
// $y = false;





// $z = $x and $y;





// 1) O ASSIGNMENT OPERATOR POSSUI MAIOR PRECEDENCE DO QUE "and"




// 2) por isso rodamos $z = $x,  e descartamos ""and $y;""




// 3) por isso, o resultado fica $z = true --> PQ RODAMOS SÓ A PRIMEIRA PARTE.







// PARA EVITAR CONFUSAO
 
//  E RESULTADOS INESPERADOS,

// É __ ALTAMENTE _ RECOMENDADO 

// USAR PARENTESES...



// --> TAMBÉM ESTÁ SENDO EXPLÍCITO 

// __ SOBRE __ COMO VC QUER QUE SEUS OPERATORS SEJAM GROUPED (

//     em vez de confiar 

//     na precedence e associativity
// )







// para consertar essa expressao, escreveríamos assim:





$z = ($x and $y);


var_dump($z);








