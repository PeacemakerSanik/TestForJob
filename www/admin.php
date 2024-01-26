<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Админка</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    body{background: url("https://klike.net/uploads/posts/2023-06/1686628668_2-1.jpg") no-repeat center center fixed;
        background-size: cover;
    }
</style>
<div style="text-align: center">
<?php if (!empty($_SESSION["login"])):?>

<h5 style="width: auto; color: white">Вы в режиме администратора</h5>
<br>
<a href="/project_list/project_list.php"> Список проектов</a>
<a href="/logout.php"> Выйти</a>
<?php else:
    echo '<h2> Давайте жить дружно, хацкеры)</h2>';
    echo '<a href="/">На главную</a>';
?>
<?php endif ?>
</div>
</body>
</html>