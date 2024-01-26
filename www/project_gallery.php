<?php
require_once '..\www\functions\connect.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список проектов</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    body {
        background: url("https://catherineasquithgallery.com/uploads/posts/2021-02/1614533962_50-p-belii-fon-bumaga-59.jpg") no-repeat center center fixed;
        background-size: cover;
    }
</style>
<body>
<div style="text-align: left">
    <h1>Список проектов</h1>
<?php
if (!empty($_SESSION["login"])):
$sql=$pdo->prepare("select * from projects");
$sql->execute();
$projects=$sql->fetchAll(PDO::FETCH_OBJ);
foreach ($projects as $project) {
    echo 'Название проекта: <input type="text" name="project_name" readonly value="' . $project->project_name . '"><br>';
    echo 'Описание проекта: <input type="text" size="100" name="Description" readonly value="' . $project->Description . '"><br><br>';
    $absolutepath = '../images/' . $project->image;
    echo 'Фотография проекта: <img src="' . $absolutepath . '" width="250" height="250"><br><br>';
}
else:
    echo '<h2>Давайте жить дружно, хацкеры)</h2>';
    echo '<a href="/">На главную</a>';
endif;
