<?php





function x()
{
    sleep(3);
    echo 'Done <br />';
    return 1;
}



// function x()
// {
//     sleep(3);
//     echo 'Done <br />';
//     return 3;
// }




if (x() === 1) {
    echo 1;
} elseif (x() === 2) {
    echo 2;
} elseif (x() === 3) {
    echo 3;
} else {
    echo 4;
}




// CERTO.... O QUE ACONTECE, AQUI, É ISTO:




// A FUNCTION DE X É EXECUTADA DENTRO DA EXPRESSION DO IF STATEMENT,

// e aí retorna "1" depois de 3 segundos...






// o 1 faz com que entremos no primeiro block,



// x() === 1 





// OS OUTROS BLOCKS NAO SAO NEM MESMO EXECUTADOS...














// --> CERTO... ISSO FAZ SENTIDO....











// MAS SE O NEGÓCIO RETORNAR 3, A FUNCTION, POR EXEMPLO,



// ISSO FARÁ COM QUE ___CADA___ UM DOS IF CONDITIONALS TENHA 



// DE __ REEXECUTAR __ ESSA FUNCTION, checando pelo 

// value de 1, 2 e 3, respectivamente (cada block)...





// isso quer dizer que a execucao desse block inteiro vai 

// demorar 

// 9 segundos, e nao 3....









// BASTA MOVER O FUNCTION CALL __ PARA __ FORA __ DO IF-ELSE,

// E AÍ 


// SÓ 


// CHECAR O RESULTADO DESSE RUN EM CADA 1 DOS IF-ELSE STATEMENTS,

// TIPO ASSIM:



$x = x();



if ($x === 1) {
    echo 1;
} elseif ($x === 2) {
    echo 2;
} elseif ($x === 3) {
    echo 3;
} else {
    echo 4;
}




// MESMA COISA, MAS COM SWITCH-CASE (também executa apenas 1 única vez)....

// switch (x()) {
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
