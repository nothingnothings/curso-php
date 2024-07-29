
<?php






// STRING DATA TYPES

$firstName = "eu";



$firstName2 = 'eu2';



$completeName = "voce e {$firstName}";




$failedCompleteName = 'voce e {$firstName}';









// CONCATENATION EXAMPLE:

$myFirstName = "Arthur";


$mySecondName = "Panazolo";


$myFirstName[0] = strtolower($myFirstName[0]); //com isso, transformei a primeira letra do primeiro nome em MINÚSCULA..


$myFullName = $myFirstName . " " . $mySecondName; ///o DOT é o CONCATENATE OPERATOR.




$firstNameFirstLetter = $myFirstName[0];


$firstNameLastLetter = $myFirstName[-1]; // "r"

$penultimate = $myFirstName[-2];   // "u"

echo $name;

echo '<br />';


echo $firstNameFirstLetter;

echo $firstNameLastLetter;

echo $penultimate;



// echo $name{
//     1}; //esta sintaxe foi deprecada desde o php 7.4....





// SINGLE QUOTES E DOUBLE QUOTES SAO AS MANEIRAS TRADICIONAIS DE REPRESENTAR STRINGS...



// MAS EXISTEM OUTRAS MANEIRAS...







// AS MANEIRAS SAO HEREDOC E NOWDOC.... --> SAO MANEIRAS DE HANDLAR LONGAS E MULTILINE STRINGS, QUE TALVEZ CONTENHAM EXPRESSOES COMPLEXAS...











// A DIFERENCA ENTRE OS 2 É QUE O ""HEREDOC"" CONSIDERA STRINGS COMO ENCASED IN DOUBLE QUOTES...








// JÁ O NOWDOCS TRATA STRINGS COMO SINGLE QUOTES..








// NO HEREDOC, PODEMOS TER VARIABLES DENTRO DA NOSSA STRING... 


// NO NOWDOC, NAO PODEMOS TER VARIABLES DENTRO DA STRING...




// SINTAXE HEREDOC:


// É UMA SINTAXE BEM ESQUISITA...

// "<<<" (isso identifica que é um heredoc) "IDENTIFIER" (pode ser qualquer coisa)  ___CONTEÚDO__  "IDENTIFIER_DE_NOVO;"




// EXEMPLO DE HEREDOC... (podemos usar variables no seu interior)
$hereDocText = <<<TEXT
  conteúdo da string: $myFullName
  exemplo-multiline
  exemplo-multiline
  exemplo-multiline
  exemplo-multiline
  exemplo-multiline
  exemplo-multiline
 TEXT;





 $hereDocText2 = <<<TEXT
    <p>THIS IS AN EXAMPLE PARAGRAPH</p>
 TEXT;

echo $hereDocText; //vai displayar tudo em 1 linha só


echo nl2br($hereDocText); //vai displayar tudo em MULTILINE, no browser...



echo $hereDocText2; // VAI DISPLAYAR TAMBÉM HTML (o heredoc e o nowdoc sao capazes disso)....

















// SINTAXE NOWDOC (é a mesma sintaxe do HEREDOC, mas seu identifier tem que ficar em SINGLE QUOTES):





// EXEMPLO DE NOWDOC... (NÃO podemos usar variables no seu interior)
$nowDocText = <<<'TEXT'
conteúdo da string: $myFullName
exemplo-multiline
exemplo-multiline
exemplo-multiline
exemplo-multiline
exemplo-multiline
exemplo-multiline
TEXT;


echo $nowDocText; //vai displayar tudo em 1 linha só


echo nl2br($nowDocText); //vai displayar tudo em MULTILINE, no browser...
