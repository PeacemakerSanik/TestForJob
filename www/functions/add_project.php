<?php
require_once '..\functions\connect.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавление проекта</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    body {
        background: url("https://catherineasquithgallery.com/uploads/posts/2021-02/1614533962_50-p-belii-fon-bumaga-59.jpg") no-repeat center center fixed;
        background-size: cover;
    }
</style>
<body>
<div style="text-align: center">
    <form action="send_picture.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td> Имя проекта </td>
                <td><input type="text" name="project_name"></td>
            </tr>
            <tr>
                <td> Описание </td>
                <td> <input type="text" name="Description"></td>
            </tr>
            <tr>
                <td> Картинка </td>
                <td> <input type="file" name="project_image"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Отправить"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>