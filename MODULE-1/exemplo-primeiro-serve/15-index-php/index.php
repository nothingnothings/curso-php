






<?php


// CONTROL STRUCTURES --> if / else / elseif /else if 



$score = 95;





if ($score >= 90) {
    echo 'A';  //essa condition vai falhar.... se temos 1 else block, ele é triggado.
} elseif ($score >= 80) {
    echo 'B';
} elseif ($score >= 70) {
    echo 'C';
} elseif ($score >= 60) {
    echo 'D';
} else {
    echo 'F';
}





// if ($score >= 90)  //ESSA SINTAXE É POSSÍVEL, MAS É RUIM (deixa o código menos readable)...
//     echo 'A';




// ELSE --> É O DEFAULT CODE BLOCk...












// --> OK...





// E PODEMOS CHAINAR QUANTOS ELSEIF STATEMENTS QUISERMOS...








// A OUTRA MANEIRA DE DEFINIR 



// ELSEIF É COM ""else if""









// EXISTE A SINTAXE ""else if"", MAS QUASE NUNCA É USADA... DEVEMOS USAR elseif, pq funciona no html (a outra nao funciona)...





