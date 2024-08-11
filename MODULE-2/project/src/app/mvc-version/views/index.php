<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        <?= $this->params['foo'] ?> <!--NOT IDEAL -->
        <?= $this->foo ?> <!-- ALSO NOT IDEAL -->
    </h1>
    <!-- … {{ content}} -->
</body>

</html>