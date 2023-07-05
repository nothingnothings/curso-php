<?php
// -----> OK... AGORA É HORA DE ESTUDARMOS EXPRESSIONS...







// JÁ APRENDEMOS O BÁSICO DO PHP:



// 1) COMO INSTALAR E RODAR O PHP



// 2) COMO FICAR COM O PHP UP AND RUNNING..





// 3) BASIC SYNTAX


// 4) VARIABLES E CONSTANTS



// 5) DATA TYPES E CASTING



// 6) COMO USAR O PHP DENTRO DO HTML E ASSIM POR DIANTE...











// -> AGORA É HORA


// DE ESTUDARMOS EXPRESSIONS...








// MAS JÁ VIMOS EXPRESSIONS ANTES..









// EXPRESSIONS -> É BASICAMENTE TUDO QUE



// TEM 1 VALUE,

// OU QUE

// É


// EVALUATED COMO 1 VALUE...









// O PHP É UMA EXPRESSION-ORIENTED LANGUAGE,

// EM QUE

// QUASE TUDO É UMA EXPRESSION...










// -> AS EXPRESSIONS MAIS SIMPLES SAO


// VARIABLES,
// CONSTANTS


// E LITERAL VALUES...








// EX:




// $x = 5;






// QUANDO ASSIGNAMOS UM VALUE A UMA VARIAVEL,





// O 5 É UM LITERAL VALUE,

// QUE EVALUATES TO ITSELF











// --> E, PORTANTO, O X É UMA EXPRESSION...






// SE VC ASSIGNA




// $y = $x;,






// o Y EVALUATES TO X, THAT EVALUATES TO 5... O QUE QUER DIZER QUE

// ESSA É UMA EXPRESSION..













// PRATICAMENTE TUDO QUE DEPOIS DO ASSIGMENT


// OPERATOR É CONSIDERADO UMA EXPRESSION,


// ISSO PQ



// __ AS COISAS QUE VEM DEPOIS DO ASSIGNMENT OPERATOR




// SAO EVALUATED COMO VALUES...











// E 1 VALUE PODE SER DE QUALQUER DATA TYPE (booleans, arrays, strings, floats, etc)...












// UM EXEMPLO CLÁSSICO DE EXPRESSION É COMPARAR 1 VARIAVEL A OUTRA...










// ex:





$x = 5;


$y = $x;


$z = $x === $y;










// ISSO É UMA EXPRESSION, PQ É EVALUATED A UM BOOLEAN VALUE...






// FUNCTIONS TAMBÉM SAO CONSIDERADAS EXPRESSIONS,

// PQ ELAS TIPICAMENTE RETORNAM 1 VALUE...










// if ($x < 5) { /// isso também é uma expression, pq faz evaluate a true/false
//     echo 'Hello';
// }