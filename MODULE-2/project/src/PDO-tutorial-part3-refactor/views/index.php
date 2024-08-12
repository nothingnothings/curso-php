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

    <div>
        <?php if (!empty($invoice)): ?>
            Invoice ID: <?= htmlspecialchars($invoice['id'], ENT_QUOTES) ?><br />
            Amount: <?= htmlspecialchars($invoice['amount'], ENT_QUOTES) ?><br />
            User: <?= htmlspecialchars($invoice['full_name'], ENT_QUOTES) ?><br />
        <?php endif ?>
    </div>
</body>

</html>