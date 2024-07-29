
<?php


// LOOPS SAO USADOS PARA EXECUTAR STATEMENTS MÚLTIPLAS VEZEs...


// existem 4 tipos:


// WHILE LOOP

// DO-WHILE LOOP

// FOR LOOP

// FOREACH LOOP...







// WHILE LOOP SIMPLES:







$i = 0;


while ($i <= 15) {
    echo $i++;  //0123456789101112131415
}




// OK... FAZ SENTIDO...








// ESSE CONDITIONAL STATEMENT DE ""$i <= 15 """ É EVALUATED AO INÍCIO DE CADA ITERATION....




// --> ASSIM QUE ESSA EXPRESSION 

// FOR EVALUATED COMO FALSE,
// O 


// LOOP TERMIINARÁ...




// --> SE A CONDICAO INICIAL ($i <= 15; se i for 20, por exemplo...) NUNCA FOR SATISFEITA,


// O LOOP NUNCA NEM MESMO COMECARÁ...








// JÁ SE NÓS TIRARMOS O INCREMENT DE $i++,

// VAMOS INTRODUZIR 1 INFINITE LOOP NO NOSSO CÓDIGO....






// INFINITE LOOP --> É ALGO QUE VAI CONTINUAMENTE RODAR SEUS STATEMETNS,


// PQ A EXPRESSION VAI CONTINUAMENTE RESULTAR EM ""TRUE""






// while (true) {
// }




// --> UM DOS USE-CASES PARA __ INFINITE LOOPS 

// É 


// AQUELAS SITUACOES EM QUE 



// """"ESPERAMOS POR ALGO ACONTECER"""... aí, quando isso acontece,

// fazemos 

// BREAK __ condicionalmente daquele loop, usando o BREAK statement...


// EX:


$i = 0;

while (true) {
    if ($i >= 15) {
        break;
    }
    echo $i++;
}







// --> OK... MAS O BREAK STATEMENT _ TAMBÉM ACEITA 


// 1 ARGUMENTO OPCIONAL...





// E ESSE ARGUMENT, POR DEFAULT,


// É ""1"" -->  tipo ""True""




// MAS VC PODERIA TAMBÉM PASSAR OUTRO NUMERIC ARGUMENT,

// COMO ""2""







// --> MAS O QUE ""2"" FARIA...? ---> BEM, O PROPÓSITO DISSO 

// É 

// FAZER ""BREAK"" POR DIVERSOS NÍVEIS... (levels)... -> isso faz sentido se vc tiver 1 nested loop...







// EXEMPLO COM NESTED LOOP, E COM ""break 2"" :



$i = 0;


while (true) {
    while ($i > 10) {
        break 2; //fazemos break 2 NIVEIS PARA CIMA, para sair completamente desses nested loops....
    }

    echo $i++;
}





// SE USÁSSEMOS SÓ O ARGUMENTO DEFAULT NESSE EXEMPLO,


// DE APENAS 
// ""break"" (ou break 1),



// SÓ 

// SAIRÍAMOS DO PRIMEIRO LOOP,


// E CONTINUARÍAMOS NO SEGUNDO... (ficaríamos no infinite loop de ""while(true)"")...

















// --> VC TAMBÉM PODE SKIPPAR __ 


// A """""cURRENT LOOP ITERATION"""",



// POR MEIO do ""continue"" statement...






// $i = 0;


// while($i <= 15) {

//     if($i % 2 === 0) {
//         continue;
//     }

//     echo $i++;
// }








// --> COM ISSO,


// DIZEMOS QUE 

// """SE FOR 1 NÚMERO EVEN, CONTINUE"" ( ou seja, skippe as iterations 

// com números 

// pares...
// )













// --> nesse caso, ficamos com 1 infinite loop,



// pq a parte de baixo do código é skippada (o que quer dizer que o i nao é incrementado,

// o que quer dizer que ficamos com 0 para sempre)...




// ------> OK... INFINITE LOOP....













// PARA CONSERTAR __ ESSE INFINITE LOOP,



// DEVEMOS OU ESCREVER O $i++ ANTES DA CONDICAO 



// DO CONTINUE,




// OU ENTAO 


// ANTES __ DO CONTINUE STATEMNET,

// TIPO ASSIM:






$i = 0;


while ($i <= 15) {

    if ($i % 2 === 0) {
        $i++;
        continue;
    }

    echo $i++;
}






// CERTO.... AÍ FICAMOS COM APENAS ODD NUMBERS...







// SIMILARMENTE AO _ _BREAK STATEMENT,



// O CONTINUE STATEMENT 



// -_TAMBÉM _ ACEITA 1 



// OPTIONAL ARGUMENT,



// QUE __ TAMBÉM TE DEIXA _ CONTINUAR _ AO LONGO DE MÚLTIPLOS NESTED LOOPS (para 

// dar continue em todos eles)...











// TAMBÉM TEMOS SINTAXES ALTERNATIVAS PARA OS WHILE LOOPS,



// SIMILARMENTE AOS IF-ELSE STATEMENTS...








// --> A SINTAXE ALTERNATIVA É TIPICAMENTE USADA 

// QUANDO 


// __ESTAMOS _ FAZENDO _O  EMBED__ DE 



// __ PHP __DENTRO __ DE HTML...



// É ASSIM:



$i = 0;


while ($i <= 15) : // voce usa "":"" NO LUGAR DA CURLY BRACE OPENING...

    if ($i % 2 === 0) {
        $i++;
        continue;
    }

    echo $i++;

endwhile;  //voce usa ""endwhile;" PARA TERMINAR O WHILE LOOP... (como se fosse a curly brace closing)..











// do-while loop -->  É PARECIDO COM O WHILE LOOP NORMAL,


// COM A diferenca 





// PRINCIPAL 

// SENDO QUE 



// O ""DO-WHILE"" 





// VAI __ GARANTIR __ QUE _ OS STATEMENTS DENTRO 

// DO LOOP  



// ___ VAO _ RODAR  PELO MENOS 1 ÚNICA VEZ, 

// GARANTIDAMENTE...








// sua escrita é assim:







$t = 0;


do { //ORDEM DE EXECUCAO:
    echo $t++; //?   1111111 -- É EXECUTADO PRIMEIRO (Quer dizer que SEMPRE SERÁ EXECUTADO PELO MENOS 1 ÚNICA VEZ)....
} while ($t <= 15); //? 2222222 --- É EXECUTADO DEPOIS...








// --> OK... MAS PQ ISSO ACONTECE..?






// ACONTECE PQ __ AQUELA CONDITION,


// A 

// ""$t <= 15"",




// ELA É  ___CHECADA_ _ AO FINAL _dE UMA ITERATION, E NAO AO INÍCIO....











// --> OK...



// AGORA DEIXAMOS A PARTE DO 

// ""WHILE"" e ""DO-WHILE"" LOOP,



// E ENTRAMOS NA PARTE DOS FOR LOOPS....














// FOR LOOPS --> SAO 1 POUCO MAIS __ COMPLICADOS__ DO QUE 

// WHILE E DO-WHILE LOOPS...







// EX:


for ($i = 0; $i < 15; $i++) {
    echo $i;
}








// $i = 0 --> ISSO É EVALUATED APENAS NA PRIMEIRA ITERACAO... 



// $i < 15 --> ISSO É A __ CONDITIONAL EXPRESSION --> É EVALUATED NO INÍCIO DE CADA ITERATION..



// $i++ --> ISSO É RODADO _ AO FINAL DE CADA ITERATION....








// --> OK... 


// É POR ISSO QUE FICAMOS COM 1 OUTPUT DE 


// 01234567891011121314







// E CADA UMA DESSAS EXPRESSIONS É ""EMPTY"",


// nao é exatamente required...



// QUER DIZER QUE 


// PODERÍAMOS ESCREVER ASSIM:







// for( ; ; ) {
//     echo $i;
// }







///^^^^^^ ISSO É BASICAMENTE A MESMA COISA QUE while(true) {echo $i;}, PQ É BASICAMENTE 1 INFINITE LOOP...










// --> CERTO...





// NÓS TAMBÉM PODEMOS CONTER MÚLTIPLAS EXPRESSIONS EM 1 STATEMENT,


// EXPRESSIONS SEPARADAS POR COMMAS,



// TIPO ASSIM:


for (
    $i = 0;
    $i < 15;
    print $i, $i++ //eis o código em questao
) {
    echo $i;
}








// PODEMOS TAMBÉM COLOCAR MÚLTIPLOS EXPRESSIONS DENTRO 

// DA CONDITIONAL EXPRESSION





// de "$i < 15;" ->  TIPO ASSIM:



for (
    $i = 0;
    print $i, $i < 15; //eis o código em questao.
    print $i, $i++
) {
    echo $i;
}







// SE VC ESCREVER ASSIM,

// A EVALUATION 


// """""SE O LOOP DEVE CONTINUAR OU NAO"""""



// VAI SER DETERMINADA __ PELA ÚLTIMA EXPRESSION 


// do statement.... (pelo $i < 15, no caso)..








// E FOR LOOPS TAMBÉM PODEM SER USADOS PARA FAZER ITERATE 

// OVER STRINGS...




// -> PODE FAZER ISSO PARA PRINTAR CADA  1 DOS CARACTERES NA STRING,



// OU ENTAO 


// ""READ IT"" EM CIMA DE ARRAYS...
















// --> PARA DEMONSTRAR, O PROFESSOR ESCREVE:



$text = 'Hello World';


for ($i = 0; $i < strlen($text); $i++) {
    echo $text[$i] . '<br />';
}








// --> CERTO...






// SE TROCARMOS A STRING POR 1 ARRAY,

// PODEMOS RODAR O MESMO CÓDIGO, MAS COM UNS AJUSTES (trocar strlen por count())..




// ex:






$text = 'Hello World';


for ($i = 0; $i < strlen($text); $i++) {
    echo $text[$i] . '<br />';
}




// VIRA ISTO:


$arrayExample = ['a', 'b', 'c', 'd', 'e', 'f'];


for ($i = 0; $i < count($arrayExample); $i++) {
    echo $arrayExample[$i] . '<br />';
}








// MAS AQUI TEMOS 1 PERFORMANCE ISSUE,

// NESSE FOR LOOP STATEMENT...


// --> COMO JÁ SABEMOS,


// CONDITIONAL EXPRESSIONS, EM LOOPS,

// GERALMENTE RODAM __ NO __ INÍCIO DE CADA ITERATION...







// ---> AQUI, NESSE EXEMPLO,




// ESTAMOS RODANDO "count()",

// essa funcao aí,



// QUATRO VEZES... --> ISSO NAO É UM BIG DEAL,



// MAS TER ESSE METHOD CALL



// EM LISTAS MAIORES,


// ARRAYS MAIORES,

// OU 

// SUA FUNCTION CALL PODE SER EXPENSIVE,


// ISSO _ PODE __ CUSTAR BOA PERFORMANCE...







//  O MESMO FOR LOOP, CONSERTADO, FICA ASSIM:



$arrayExample = ['a', 'b', 'c', 'd', 'e', 'f'];




$arrayLength = count($arrayExample);

for ($i = 0; $i < $arrayLength; $i++) {
    echo $arrayExample[$i] . '<br />';
}











// OUTRA MANEIRA DE ESCREVER ESSE LOOP, CONSERTADA, SERIA ASSIM:






for ($i = 0, $length = count($arrayExample); $i < $length; $i++) {
    echo $arrayExample[$i] . '<br />';
}




// COMO A PRIMEIRA PARTE DO LOOP (""""$i=0, $length = count($arrayExample)"""" )



// EXECUTA/EXECUTARÁ APENAS 1 ÚNICA VEZ,


// ESSE FUNCTION CALL de ""count()"" NAO VAI SE REPETIR 200x... --> ficamos sem PERFORMANCE
// problems...






// --> O PROFESSOR 





// APONTA QUE ESSES PROBLEMAS DE PERFORMANCE PODEM ACONTECER 

// TANTO COM 


// WHILE LOOPS COMO 
// FOR LOOPS...






// -->  FINALMENTE,


// TEMOS 


// O 


// FOREACH LOOP,

// QUE É UM DOS MAIS IMPORTANTES...






// COM O FOREACH LOOP,

// PODEMOS ITERAR POR DENTRO _ DE ARRAYS 


// __ OU OBJECTS...










// OUTRO EXEMPLO, AGORA COM FOREACH LOOP:









$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];



foreach ($programmingLanguages as $language) {
}








// --> QUER DIZER QUE 


// A _ SINTAXE_ _ É O INVERSO DAQUILO QUE ESTAMOS ACOSTUMADOS (

//     ""$programmingLanguages"" é o array,



//     o termo 

//     é ""as"",



//     e a variável para cada 1 dos elements é 

//     "$language"...
// )




$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];


foreach ($programmingLanguages as $language) { //language = php, go, rust, java, c++

    echo $language . '<br />';
}





// QUER DIZER QUE 

// CADA ITERATION USA/ASSIGNA O VALUE 



// DE 

// CADA 



// ELEMENTO NO ARRAY...



// --> SE VC TENTA USAR O FOREACH EM 1 VARIÁVEL/VALUE QUE NAO É UM ARRAY OU OBJECT,

// VC RECEBE 1 ERRO...






// --> OK... QUER DIZER QUE 


// STRINGS NAO FUNCIONAM COM ISSO...










// --> OUTRA COISA POSSÍVEL É __ ACESSAR __ A KEY__ DE CADA 


// UM DOS ELEMENTOS DENTRO DE 1 ARRAY/OBJECT...






// FAZEMOS ISSO 


// POR MEIO DA 

// ESCRITA 



// ""as $key => $language"""...






$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];


foreach ($programmingLanguages as $key => $language) { // usamos essa sintaxe para acessar o KEY-VALUE PAIR __ DE CADA ELEMENTO EM 1 ARRAY, NO PHP...
    // $key = 0,1,2,3,4,5   $language = php, go, java, c++, rust
    echo $key . ': ' . $language . '<br />';
}






// OK.... CONFORME O PROFESSOR MENCIONOU,


// EM CADA ITERATION,



// O CURRENT ELEMENT DO ARRAY É ASSIGNADO 

// À VARIÁVEL

// DE $language,



// E É ASSIGNADA 



// POR _ _VALUE...  php, go, java, c++, rust














// ISSO É VERDADE, SIM,


// MAS  _TAMBÉM _ PODEMOS ASSIGNAR 


// __ COISAS _ _POR MEIO _ DE REFERENCE,



// POR MEIO 




// DO OPERATOR 



// DE 


// "&",


// TIPO ASSIM:








$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];


foreach ($programmingLanguages as $key => &$language) { // usamos essa sintaxe para acessar o KEY-VALUE PAIR __ DE CADA ELEMENTO EM 1 ARRAY, NO PHP...
    echo $key . ': ' . $language . '<br />';
}







// -----> COMO ASSIM """""POR REFERENCE????"""""









// bem, quer dizer que 


// SE VC 

// ALTERAR ALGUMA COISA DESSA VARIÁVEL "$language",


// VC 

// VAI ACABAR ALTERANDO 
// O VALUE 


// DO ELEMENTO _____ORIGINAL___ $language,


// armazenado lá dentro do array de $programmingLanguages






// EX:







$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];


foreach ($programmingLanguages as $key => &$language) { // usamos "&$variableName" PARA _ ACESSAR O _ REFERENCE VALUE _ DESSE ELEMENTO (ou seja, o elemento ORIGINAL, DE VERDADE, LÁ NO ARRAY ORIGINAL DE "$programmingLanguages")....
    //  com isso, trabalhamos com o REFERENTIAL VALUE, E NAO COM O PRIMITIVE/SCALAR VALUE DESSA VARIABLE...

    echo $key . ': ' . $language . '<br />';
}



// ////////////////////////////



$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];


foreach ($programmingLanguages as $key => &$language) { // usamos "&$variableName" PARA _ ACESSAR O _ REFERENCE VALUE _ DESSE ELEMENTO (ou seja, o elemento ORIGINAL, DE VERDADE, LÁ NO ARRAY ORIGINAL DE "$programmingLanguages")....
    //  com isso, trabalhamos com o REFERENTIAL VALUE, E NAO COM O PRIMITIVE/SCALAR VALUE DESSA VARIABLE...

    $language = 'php'; // TODO GRACAS AO "&" na variável de $language, essa alteracao vai ser aplicada no ARRAY ORIGINAL, de $programmingLanguages...
    echo $key . ': ' . $language . '<br />';
}



print_r($programmingLanguages); ///ISSO ACABARÁ PRINTANDO 1 ARRAY DE ['php', 'php', 'php', 'php'], JUSTAMENTE PQ AQUELE ASSIGNMENT ALI TERÁ ALTERADO CADA 1 DOS VALUES ORIGINAIS (graças ao "&")...












// -> CERTO...





// JÁ SE FAZEMOS ISSO DA MANEIRA COMUM,

// SEM USAR 

// "&",



// O ARRAY ORIGINAL FICA INTOCADO (comportamento igual ao do javascript, por exemplo)...










// MAS AQUI TEMOS 1 DETALHE...


// A VARIÁVEL 

// DE 

// """"$language"""",


// no php,


// VAI __ CONTINUAR__ ATÉ MESMO DEPOIS 



// ___ DO FOREACH LOOP TER ACABADO...




// EXEMPLO:


$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];


foreach ($programmingLanguages as $key => $language) {
    echo $key . ': ' . $language . '<br />';
}


echo $language; //vai printar 'rust', pq esse foi o ÚLTIMO ELEMENTO QUE O ARRAY ""PASS THROUGH""...





// QUER DIZER QUE A VARIÁVEL FINAL  DO SEU FOR EACH LOOP 


// NAO VAI SER DESTRUÍDA,

// DEPOIS DO FOR EACH LOOP....








// ->  E ISSO PODE LEVAR A PROBLEMAS NO SEU CÓDIGO --> VC PODE ACABAR USANDO 

// ESSA VARIÁVEL SEM QUERER, MAIS TARDE...











// ISSO ACONTECE PRINCIPALMENTE SE VC 




// USA O OPERATOR DE "&"

// PARA ACESSAR O REFERENTIAL VALUE DE SEUS ELEMENTOS,




// PQ SE VC TENTAR 



// ESCREVER 






// ALGO COMO 




// $language = 'php';




// ,


// ISSO VAI ACABAR ALTERANDO O ÚLTIMO ITEM DO SEU ARRAY ORIGINAL,





// COMO PODEMOS VER NESTE EXEMPLO:










$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];


foreach ($programmingLanguages as $key => &$language) { // com &... (referential value)
    echo $key . ': ' . $language . '<br />';
}


$language = 'php'; // ISSO VAI ACABAR ALTERANDO O VALUE DE 'rust' DENTRO DE $programmingLanguages, tudo por conta de "&$language", que é uma variable que ACABA NAO SENDO DESTRUÍDA (comportamento do php)..

print_r($programmingLanguages); // vai printar ['Php', 'go', 'java', 'c++', 'php']; (último elemento foi alterado pelo statement logo acima)...












// --> O QUE O PROFESSOR FAZ, PARA CONSERTAR ISSO,


// __QUANDO __ ELE USA "&" (referential values),



// é, depois _ do _ 


//  FOR EACH LOOP,



//  ELE  __ 
//  DESTRÓI A VARIÁVEL,

//  USANDO 


//  ____ 




//  """""unset($language);"""""








//  tipo assim (forma correta de usar "&" com seus foreach loops):










$programmingLanguages = ['Php', 'go', 'java', 'c++', 'rust'];


foreach ($programmingLanguages as $key => &$language) { // com &... (referential value)
    echo $key . ': ' . $language . '<br />';
}


unset($language); //* isso vai limpar/DESTRUIR a variável de $language anterior, o que vai deixar safe o código posterior de """$language = xxxx"".....

$language = 'php'; // ISSO NAO VAI ACABAR ALTERANDO O VALUE DE 'rust' DENTRO DE $programmingLanguages, tudo por conta de "&$language", que é uma variable que ACABA NAO SENDO DESTRUÍDA (comportamento do php)..

echo $language; // vai printar ['Php', 'go', 'java', 'c++', 'rust']; (último elemento ficou intacto, nao foi alterado pelo statement logo acim a)...





// OUTRO BOM USE-CASE PARA FOREACH LOOPS 


// é 




// AQUELES 
// EM QUE 


// __ VC QUER __ ITERATE __ 


// EM CIMA __ DE ASSOCIATIVE ARRAYS....




// TIPO ASSIM:






$user = [
    'name' => 'Gio',
    'email' => 'gio@email.com',
    'skills' => ['php', 'graphql', 'react']
];


foreach ($user as $key => $value) {
    echo $key . ': ' . $value . '<br />';
}




// RODAMOS ESSE FOREACH,

// MAS AÍ GANHAMOS 1 ERROR...

// WARNING: ARRAY TO STRING CONVERSION ...  --> É CLARO QUE GANHAMOS ESSE ERROR...

//  GANHAMOS ESSE ERROR PQ TENTAMOS FAZER ECHO DE 1 ARRAY, E ISSO NAO É PERMITIDO (apenas podemos fazer echo de STRINGS)...



//  para printar tudo isso, podemos usar outro approach....


//  um approach clássico é usar """json_encode()""", PARA TRANSFORMAR ESSE ARRAY TODO EM 1 STRING...




// tipo assim:






$user = [
    'name' => 'Gio',
    'email' => 'gio@email.com',
    'skills' => ['php', 'graphql', 'react']
];


foreach ($user as $key => $value) {
    echo $key . ': ' . json_encode($value) . '<br />'; //json_encode vai transformar esse value de array em 1 string...
}






// IMPLODE É A MESMA COISA QUE ""JOIN""....


// E ""EXPLODE"" É A MESMA COISA QUE ""SPLIT""...



// 1) IMPLODE PODE SER USADO __ APENAS COM ARRAYS.. (junta várias strings, em 1 array, em 1 string única)...


// 2) EXPLODE PODE SER USADO APENAS COM STRINGS (explode 1 string em várias substrings)




// EXEMPLO COM IMPLODE (que deve ser usado apenas com arrays):










foreach ($user as $key => $value) {

    if (is_array($value)) {
        $value = implode(',', $value); //1o param é a coisa que vai separar os values, o segundo é o ARRAY...
    }

    echo $key . ': ' + $value . '<br />';
}







// HÁ TAMBÉM UMA SINTAXE ALTERNATIVA 

// PARA FOR EACH E FOR LOOPS...






// ELA É ASSIM:








foreach ($user as $key => $value): //AQUI

    if (is_array($value)) {
        $value = implode(',', $value); //1o param é a coisa que vai separar os values, o segundo é o ARRAY...
    }

    echo $key . ': ' + $value . '<br />';

endforeach; //E AQUI


