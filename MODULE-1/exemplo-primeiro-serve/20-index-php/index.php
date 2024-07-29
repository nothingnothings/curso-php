<?php 

//agora veremos MATCH expressions (quase a mesma coisa que switch-case)... algumas diferencas, como OS DEFAULT CASES...





//EXEMPLO DE SWITCH-CASE STATEMENT:

// switch(x()) {

//     case 1: 
//         echo 1;
//         break;
//     case 2: 
//         echo 2;
//         break;
//     case 3: 
//         echo 3;
//         break;
//     default:
//         echo 4;
// }
















$paymentStatus = 1;


match($paymentStatus) {

    1 => print 'Paid',
    2 =>  print 'Payment Declined',
    0 =>  print 'Pending Payment'

};










// -->  a primeira 


// diferenca 


// é que 


// a match expression 


// é ACTUALLY uma expression,


// e por ser uma expression,

// é evaluated como 1 value...






// ISSO QUER DIZER QUE 


// AS MATCH EXPRESSIONS PODEM 


// SER ACTUALLY 


// ATRIBUÍDAS A VARIABLES...









// QUER DIZER QUE PODEMOS ESCREVER ASSIM:








$paymentStatus = 1;


$paymentStatusDisplay = match($paymentStatus) { //* EIS O CÓDIGO EM QUESTAO

    1 => print 'Paid',
    2 =>  print 'Payment Declined',
    0 =>  print 'Pending Payment'

};










// --> PODEMOS ACTUALLY REMOVER OS PRINT DENTRO DAS EXPRESSIONS,



// e aí 


// podemos só retornar os values (strings),

// para entao os printar embaixo, tipo assim:





$paymentStatus = 1;


$paymentStatusDisplay = match($paymentStatus) { //* EIS O CÓDIGO EM QUESTAO

    1 => 'Paid',
    2 =>  'Payment Declined',
    0 =>  'Pending Payment'

};




echo $paymentStatusDisplay;





// -->  OUTRA DIFERENCA É QUE COM OS SWITCH STATEMENTS,

// PRECISAMOS USAR BREAK STATEMENTS PARA EVITAR

// RESULTADOS INESPERADOS... COM A MATCH EXPRESSION,

// ISSO NAO ACONTECE... A EXPRESSION VAI RETORNAR 
// O VALUE SE O CASE FOR MATCHEADO, E NAO VAI "FALLTHROUGH"

// NOS OUTROS CASES....









// ENTRETANTO, É POSSÍVEL REPLICAR 

// O COMPORTAMENTO DE ""FALLTHROUGH""


// DOS SWITCH-CASE STATEMENTS 


// COM 



// AS MATCH EXPRESSIONS, BASTA


// ESCREVER MÚLTIPLOS CASES EM CADA 1 DOS KEY-VALUE PAIRS,


// TIPO ASSIM:









$paymentStatus = 1;


$paymentStatusDisplay = match($paymentStatus) { //* EIS O CÓDIGO EM QUESTAO

    1,2 => 'Paid',
    3,4 =>  'Payment Declined',
    0 =>  'Pending Payment'

};




echo $paymentStatusDisplay;







// 1) SWITCH-CASE É EXEMPLIFICATIVO -> colocamos exemplos de 
//                                     cases... se nao entramos em 1 deles, nao há erro.




// 2) MATCH EXPRESSION É __EXAUSTIVO --> COLOCAMOS OS CASES QUE DEVEM SER 
//                                         SATISFEITOS.... SE NENHUM FOR ENCAIXADO, ficamos com 1 error...

//com as MATCH EXPRESSIONS, SOMOS FORCADOS A ESPECIFICAR TODOS OS CASES POSSÍVEIS... SE NAO FAZEMOS ISSO, PODEMOS RECEBER 1 ERRO, SE ALGUM VALUE "oUT OF BOUNDS" APARECER....


// EX:





$paymentStatus = 5; // vai causar o throw de 1 error, pela match expression, por nao estar contemplado em 1 dos cases...




$paymentStatusDisplay = match($paymentStatus) { 
// 5 nao consta em nenhum dos cases, por isso ficamos com 1 error...
    1,2 => 'Paid',
    3,4 =>  'Payment Declined',
    0 =>  'Pending Payment'

};




echo $paymentStatusDisplay;








//o mesmo nao acontece com switch-case expressions, nao há o throw de error se ficamos "out of bounds", mesmo sem case default...












// PODEMOS __ EVITAR ESSE COMPORTAMENTO DE ERRO, NAS MATCH EXPRESSIONS, COM A KEYWORD DE DEFAULT, DE FORMA SIMILAR àQUELA DOS SWITCH-CASE STATEMENTS....







//ex:






$paymentStatus = 5; // vai causar o throw de 1 error, pela match expression, por nao estar contemplado em 1 dos cases...




$paymentStatusDisplay = match($paymentStatus) { 
// 5 nao consta em nenhum dos cases, por isso entramos no DEFAULT
    1,2 => 'Paid',
    3,4 =>  'Payment Declined',
    0 =>  'Pending Payment',
    default => 'Unknown Payment Status' //funciona da mesma forma que no switch-case statement...

};




echo $paymentStatusDisplay;
















// A QUARTA DIFERENCA 



// É QUE






// ""MATCH EXPRESSIONS FAZEM 

// __sTRICT__ COMPARISON___,

// ENQUANTO QUE __ LOOSE EXPRESSIONS 

// FAZEM __LOOSE_ COMPARISON""....




// OU SEJA,



// AS MATCH EXPRESSIONS CHECAM TAMBÉM O DATA TYPE,

// AO


// REALIZAR A COMPARACAO 
// DOS CASES...







//EX:








$paymentStatus = '1'; // vai RODAR O CASE DE 1 (int) LÁ NO SWITCH-CASE STATEMENT (loose comparison), MAS _ VAI ACABAR RODANDO O CASE DEFAULT NA MATCH EXPRESSION (pq o data type nao se encaixa no case de 1 int, justamente pq DATA TYPES SAO CHECADOS TAMBÉM, STRICT COMPARISON, lá em match expressions)...






$paymentStatusDisplay = match($paymentStatus) { 
    1,2 => 'Paid',
    3,4 =>  'Payment Declined',
    0 =>  'Pending Payment',
    default => 'Unknown Payment Status' 

};




echo $paymentStatusDisplay;








// --> QUER DIZER QUE O MATCH FAZ 

// A COMPARISON USANDO "===",



// enquanto que o switch-case faz a comparison usando 

// "=="...








// -> A MATCH EXPRESSION 


// NAO DEPRECA O SWITCH-CASE STATEMENT...





// --> PQ O SWITCH-CASE STATEMENT

// FAZ ALGUMAS COISAS QUE A MATCH EXPRESSION NAO CONSEGUE...




// -> O SWITCH-case CONSEGUE RODAR 

// CODE-BLOCKS,

// E A MATCH-EXPRESSION NAO...








// EX:




$paymentStatus = 1;





switch($paymentStatus) {
    case 1:
        echo 'eu';
        echo 'estou';
        echo 'aqui';
        break;
    default:
        echo 'é verdade';
}



// A MANEIRA DE RESOLVER ISSO 



// NA MATCH EXPRESSION SERIA

// EXTRAIR A EXPRESSION COMO 1 BLOCK DE CÓDIGO,
// E AÍ RODAR ESSE BLOCK 


// COMO 1 FUNCTION....


// TIPO ASSIM:


function estouAqui() {
    echo 'eu';
    echo 'estou';
    echo 'aqui';
}





$paymentStatusDisplay = match($paymentStatus) { 
    1,2 =>  estouAqui(),
    3,4 =>  'Payment Declined',
    0 =>  'Pending Payment',
    default => 'Unknown Payment Status' 

};



echo $paymentStatusDisplay;
