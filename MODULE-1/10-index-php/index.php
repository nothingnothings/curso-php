<?php





// ESTUDAREMOS ARRAYS...


$programmingLanguage1 = 'PHP';
$programmingLanguage2 = 'Java';
$programmingLanguage3 = 'Python';







// $programmingLanguages = [];

// SINTAXE ANTIGA --> array(exemplo1, exemplo2, exemplo3)

$programmingLanguages = ['PHP', 'Java', 'Python', 'Ruby'];



$exampleString = 'Exemplo';

$iniitalLetter = $exampleString[0]; ///retorna 'E'
$finalLetter = $exampleString[-1]; //retorna 'o' (letra final)... --> ESSA SINTAXE DE ""DE TRÁS PRA FRENTE" no indexing NAO FUNCIONA COM ARRAYS...


$item1 = $programmingLanguages[0];
$item2 = $programmingLanguages[1];
$item3 = $programmingLanguages[2];
$item4 = $programmingLanguages[3];
// $item5 = $programmingLanguages[-1]; //! ISSO VAI DAR O THROW DE 1 ERROR... (pq nao podemos usar a sintaxe de números negativos com ARRAYS... apenas com strings)






$programmingLanguages[2] = 'Algol'; //Python vira 'Algol'



// -> QUER DIZER QUE 

// O NÚMERO QUE TEMOS DENTRO DE [], 

// NOS ARRAYS,

// É CHAMADO 




// DE """"INDEX"""",


// ou de KEY...



// -> VC É CAPAZ _ DE DEFINIR SUAS PRÓPRIAS KEYS,

// DENTRO 

// DE ARRAYS,

// NO PHP... (como se fossem objects... tipo isso)....



// MAS SE VC NAO DEFINIR NENHUMA KEY PARA 1 ITEM, DENTRO 

// DE 1 ARRAY,


// O PHP VAI AUTOMATICAMENTE 

// ASSIGNAR 



// NUMBERS A ESSES ITEMS... (comecando por 0)...






// VOCE É BASICAMENTE 

// CAPAZ 
// DE 

// TRATAR 




// ___ ARRAYS __ COMO SE FOSSEM __ DIFERENTES TIPOS 

// DE DATA STRUCTURES,


// COMO 


// __ STACKS, QUEUES, COLLECTIONS,

// HASH TABLES,
// E ASSIM POR DIANTE... ISSO DEIXA ARRAYS MT POWERFUL...







// E SE VC TENTA ACESSAR 1 ITEM QUE NAO EXISTE, 

// DENTRO 


// DE 1 ARRAY,

// VC 
// VAI GANHAR 1 WARNING... --> como ganhamos quando tentamos acessar o index de -1...










//  se fazemos o var_dump de 1 key QUE NAO EXISTE dentro de 1 array (index que nao existe),
// vamos ganhar um WARNING e entao ele vai dizer que o value está como null..


ex:



var_dump($programmingLanguages[1000]); ///vai retornar NULL e o warning...











// --> PARA CHECARMOS SE O ITEM EXISTE NESSA 
// KEY/INDEX, SEM TER 1 ERROR (no caso de nao existir),


// PODEMOS 

// USAR 



// A FUNCTION/METHOD DE 



// isset(array[index]),



// TIPO ASSIM:


var_dump(isset($programmingLanguages[1000])); ///vai retornar bool(false);






// A ALTERNATIVA A ""isset()"" é """"array_key_exists()""""



array_key_exists(0, $programmingLanguages); //array_key_exists(key, nome_do_array); // VAI PRINTAR TRUE...



///COMO VER TODOS OS CONTEÚDOS DE 1 ARRAY.... 




// 1a maneira -> var_dump() --> É BEM MAIS VERBOSE (te diz os types de cada 1 dos item no array)...


var_dump($programmingLanguages);


// 2a maneira -> print_r() --> É MENOS VERBOSE...



print_r($programmingLanguages);




// 3a maneira --> VERSAO MAIS BONITA DE print_r() -> 

echo '<pre>';
print_r($programmingLanguages);
echo '</pre>';






// PARA CONSEGUIRMOS A LENGTH DE UM ARRAY,


// PODEMOS 

// USAR  1 FUNCTION CHAMADA DE ""count""


//  TIPO ASSIM:


count($programmingLanguages);










// COMO PODEMOS ADICIONAR 1 ITEM AO FINAL DE UM ARRAY (tipo push)?




// DEVEMOS USAR $arrayName[] = 'CoisaQueQueremosPushar'



// EX:





$programmingLanguages[] = 'C++'; // isso vai fazer """PUSH"" dessa string para dentro do array, no último slot...








// OUTRA MANEIRA DE FAZER ISSO É COM ""array_push()"" --> 




array_push($programmingLanguages, 'Opa', 'Que', 'Legal');



echo '<pre>';
print_r($programmingLanguages);
echo '<pre>';







// --> array_push() --> ISSO __ MUTA__ O ARRAY... -> 



// QUER DIZER QUE 









// TUDO QUE ESSE METHOD FAZ __ VAI _MODIFICAR _ O ORIGINAL ARRAY (

// ou seja,

// é como se fosse push, mesmo...

// )





// OK... CONFORME O PROFESSOR HAVIA MENCIONADO,


// SOMOS CAPAZES DE DEFINIR E NAME NOSSAS KEYS dentro de um array....


// -> CADA KEY _ DEVE __ SER OU 1 STRING OU 1 INTEGER...




//
// --> QUANDO TEMOS __ NAMED__ KEYS DENTRO 

// DE 

// 1 ARRAY,


// ESSE ARRAY É CHAMADO DE UM  ""ASSOCIATIVE ARRAY"...













// COMO PODEMOS ACESSAR ELEMENTOS POR MEIO DE KEYS "strings"" dentro de 1 array?

//  com aquela sintaxe de  ''$programmingLanguages['Opa'];''
















// $frontendFrameworks = ['Angular', 'React', 'Vue']; //versao SEM CUSTOM KEYS (sem cada key ser 1 string)...







$frontendFrameworks = [
    'ang' => 'Angular',
    'v' => 'Vue',
    'r' => 'React'
];



$val1 = $frontendFrameworks['ang']; //podemos tentar acessar os values POR MEIO DAS KEYS..
$val2 = $frontendFrameworks['v'];
$val2 = $frontendFrameworks['r'];


$val2 = $frontendFrameworks['node']; // se tentamos acessar 1 key que nao existe, ganhamos 1 error/warning. (undefined array key ""asdsadasd"")

echo ($val1);
echo ($val2);
echo ($val3);




$frontendFrameworks['novo-framework'] = 'jQuery'; //maneira de adicionar novas keys/items no seu array.. (key 'novo-framework', value jquery)







$dynamicVariable = 'ang';



var_dump($frontendFrameworks[$dynamicVariable]);



$nestedProgrammingLanguages = [
    'end' => null,
    'php' => [

        'creator' => 'Someone',
        'extension' => '.php',
        'website' => 'php.net',
        'isOpenSource' => true,
        'versions' => [
            ['version' => 8, 'releaseDate' => 'Nov 26, 2020'],
            ['version' => 7.4, 'releaseDate' => 'Nov 28, 2019'],
        ]
    ],

    'python' => [
        'creator' => 'Guido',
        'extension' => '.py',
        'website' => 'python.org',
        'isOpenSource' => true,
        'versions' => [
            ['version' => 3.9, 'releaseDate' => 'Oct 5, 2020'],
            ['version' => 3.8, 'releaseDate' => 'Nov 14, 2019'],
        ]
    ],

];






// --> ACESSAR MULTI-DIMENSIONAL ARRAYS É BEM SIMPLES...

// -> BASTA IR ESPECIFICANDO AS KEYS QUE VC QUER ENTRAR,


// NOS DIVERSOS NÍVEIS,

// TIPO ASSIM:



$neededValue = $nestedProgrammingLanguages['php']['creator'];


$neededValue2 = $nestedProgrammingLanguages['php']['versions'][0]['releaseDate']; //como 'versions' é um array sem KEYS especificadas para os array items, acessamo-nos com 0,1, os indexes...







// SE VC TIVER MÚLTIPLAS KEYS 



// QUE __ SAO DE MESMO NOME/VALUE,



// EM 

// 1 ARRAY,




// O _ ÚLTIMO ELEMENTO 

// SERÁ 

// AQUELE QUE SERÁ CONSIDERADO...


// ex:


// $array = [
//     0 => 'foo',
//     1 => 'bar',
//    '1' => 'baz'
// ]


// print_r($array);



// O QUE SERÁ PRINTADO, AQUI,

// SERÁ 



// """"""



// Array ( [0] => foo [1] => baz )


// """"""


// OU SEJA,

// O ÚLTIMO VALUE DEU """"OVERWRITE"""" NO PRIMEIRO, PQ TINHA A MESMA KEY...












// AS KEYS TAMBÉM DEVEM SER _ STRINGS OU INTEGERS...


// -> MAS O PHP VAI TENTAR FAZER __ CAST__ DAS KEYS,


// QUANDO POSSÍVEL...






$array = [
    true => 'a',
    1 => 'b',
    1.8 => 'd'
];



print_r($array);



// -> NESSE CASO,

// O ARRAY FICARÁ COM APENAS UM ÚNICO VALUE, 
// KEY DE nome "1",
// e seu value será de 'd'... (o true é cast como 1, e o float de 1.8 é cast como 1 também)...










// EX:




$array2 = [
    true => 'a',
    1 => 'b',
    null => 'd'
];



echo $array['']; //ISSO VAI PRINTAR O d... pq o null é castado como EMPTY STRING...




$array[null]; //isso também vai printar 'd'....








$arrayDelta = ['a', 'b', 'c', 'd', 'e']; //a = 0, b = 1, c = 2, d = 3, e = 4





print_r($arrayDelta);







$arrayGamma = ['a', 'b', 50 => 'c', 'd', 'e']; // a = 0, b = 1, c = 50, d = 51, e = 52.


print_r($arrayGamma);






// POP E SHIFT, QUANDO ALTERAM OS ARRAYS (sempre), VAO REINDEXAR OS ARRAYS (reassignar index numbers a cada item)...

echo array_pop($arrayGamma); // array_pop é a mesma coisa que array.pop ---> ele modifica o array, removendo o último elemento (que é 'e', nesse caso).. E RETORNANDO ESSE ELEMENTO (podemos armazenar em uma variable, por exemplo)..




print_r($arrayGamma); //PERCEBEMOS QUE O ELEMENTO NAO ESTARÁ MAIS NO ÚLTIMO SLOT DO ARRAY...




echo array_shift($arrayGamma); ///mesma coisa que array_pop(), mas com o PRIMEIRO ELEMENTO DE 1 ARRAY...



// OUTRA MANEIRA DE REMOVER 1 ELEMENTO DE 1 ARRAY É POR MEIO DA FUNCTION DE unset()...

// USAMOS O unset() anteriormente, para remover 1 variable...
// MAS O unset() COM ARRAYS  VAI __ REMOVER __ O ELEMENT _ DO ARRAY...
// A DIFERENCA DE __ UNSET__ PARA POP E SHIFT _ É QUE __ UNSET__ NAO VAI REINDEXAR O ARRAY...


// SE VC RODAR O UNSET EM 1 ARRAY, SEM ESPECIFICAR O INDEX, VC REMOVE O ARRAY INTEIRO...




// unset($arrayGamma); //isso vai DESTRUIR O ARRAY INTEIRO.



unset($arrayGamma[2]); ///isso vai destruir apenas o terceiro elemento do array...



$arrayGamma = ['a', 'b', 'c', 'd', 'e'];

unset($arrayGamma[0], $arrayGamma[1], $arrayGamma[2]); // isso vai remover 3 elements do array... 



print_r($arrayGamma); // vai printar  ( [3] => d, [4] => e)



array_push($arrayGamma, 'f');



print_r($arrayGamma); // vai printar  ( [3] => d, [4] => e, [5] => f)











// -------------- POR FIM, O TÓPICO DE ARRAY CASTING:









$xxxxx = (array) 5; //queremos castar 5 como se fosse 1 array...



var_dump($xxxxx); // SE TENTAMOS CASTAR 1 SCALAR VALUE (primitive) COMO SE FOSSE 1 ARRAY, O QUE O PHP VAI FAZER É _ CONVERTER/CASTAR ESSE VALUE COMO 1 ARRAY,

// tipo Array(1) { [0] => int(5) }








$sss = (array) null;


var_dump($sss); /// PRINTARÁ 1 ARRAY VAZIO (pq null CASTADO como array type VIRA 1 ARRAY VAZIO)







// A ALTERNATIVA A ""isset()"" é """"array_key_exists()"""" (para checar se alguma key existe em 1 array)...



var_dump(array_key_exists('php', $nestedProgrammingLanguages)); //array_key_exists(key, nome_do_array); // VAI PRINTAR TRUE...
//  vai retornar bool(true)



// isset É DIFERENTE DE array_key_exists...
var_dump(isset($nestedProgrammingLanguages['php']));
//  vai retornar bool(true)





// A DIFERENCA ENTRE OS DOIS:

// ->  O array_key_exists


// TE 

// DIZ 


// SE
// A 


// KEY EXISTE NO ARRAY OU NAO...


// -> JÁ  isset TE DIZ __ SE A KEY EXISTE _ E ___ SE ELA NAO É NULL...




// ex:



var_dump(array_key_exists('end', $nestedProgrammingLanguages));
// vai retornar bool(true) --> ISSO PQ ELA EXISTE, REALMENTE

var_dump(isset($nestedProgrammingLanguages['end']));
// vai retornar bool(false) --> ISSO PQ ELA EXISTE, MAS NAO FOI SETTADA... (value está como NULL)