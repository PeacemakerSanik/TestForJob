<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Пользовательский режим</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background: url("https://catherineasquithgallery.com/uploads/posts/2021-02/1614533962_50-p-belii-fon-bumaga-59.jpg") no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
<div style="text-align: center">
    <h1>Список проектов</h1>
    <?php if (!empty($_SESSION["login"])):?>
        <h5 style="width: auto; color: blue">Вы в режиме пользователя</h5>
        <br>
        <a href="/project_gallery.php"> Список проектов</a>
        <a href="/logout.php"> Выйти</a>
    <?php endif?>
</div>
</body>
</html>

