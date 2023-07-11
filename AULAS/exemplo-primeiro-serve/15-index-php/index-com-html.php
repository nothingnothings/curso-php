<!-- <html>

<head>

<body>

    <?php

    // if ($score >= 90) {
    //     echo 'A';  //essa condition vai falhar.... se temos 1 else block, ele é triggado.
    // } elseif ($score >= 80) {
    //     echo 'B';
    // } elseif ($score >= 70) {
    //     echo 'C';
    // } elseif ($score >= 60) {
    //     echo 'D';
    // } else {
    //     echo 'F';
    // }

    ?>


</body>
</head>

</html> -->





<html>

<head>

<body>

    <?php $score = 95 ?>

    <?php if ($score >= 90): ?>
        <strong style="color: green;">CONDIITIONAL OUTPUT - A</strong>
    <?php elseif ($score >= 80): ?>
        <strong>CONDIITIONAL OUTPUT - B</strong>
    <?php elseif ($score >= 70): ?>
        <strong>CONDIITIONAL OUTPUT - C</strong>
    <?php elseif ($score >= 60): ?>
        <strong>CONDIITIONAL OUTPUT - D</strong>
    <?php else: ?>
        <strong>CONDIITIONAL OUTPUT - F</strong>
    <?php endif ?>
</body>
</head>

</html>