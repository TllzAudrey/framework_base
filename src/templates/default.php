<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php $this->css(["style"]) ?>
    <!-- la fonction reviens à faire la balise link ci dessous -->
    <!--link rel="stylesheet" href="\assets\css\style"-->
</head>
<body>
    <?= $content_for_layout?>


    <!-- script-->
    <?php $this->js(["script"]) ?>
</body>
</html>