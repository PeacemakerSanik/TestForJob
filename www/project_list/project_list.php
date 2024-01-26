<?php
require_once '../functions/connect.php';
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
<div style="text-align: center">
    <h1>Список проектов</h1>
    <?php
    if (!empty($_SESSION["login"])):
        echo "Вы в режиме администратора. Сессия ".$_SESSION['login'];
        $sql=$pdo->prepare("select * from projects");
        $sql->execute();
        $projects=$sql->fetchAll(PDO::FETCH_OBJ);
        foreach ($projects as $project) {
            echo '<br><input type="checkbox" name="some_project" id="some_project" data-project-id="'.$project->id.'"><a href="/functions/edit_project.php?id='.$project->id.'">'.$project->project_name.'</a>';
        }
        ?>
        <br><form action="/functions/add_project.php" method="post"><button id="createButton">Создать</button></form>
        <button id="deleteButton">Удалить</button>
        <a href="/logout.php">Выйти</a>
    <?php else:
        echo '<h2>Давайте жить дружно, хацкеры)</h2>';
        echo '<a href="/">На главную</a>';
    endif; ?>
    <script>
        document.getElementById('deleteButton').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            var projectIds = [];
            checkboxes.forEach(function(checkbox) {
                projectIds.push(checkbox.getAttribute('data-project-id'));
            });
            if (projectIds.length > 0) {
                var confirmDelete=confirm("Вы уверены, что хотите удалить эти проекты?");
                if (confirmDelete) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '/functions/delete_project.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Обработка ответа от сервера
                            location.reload(); // Перезагрузка страницы после удаления проектов
                        }
                    };
                    xhr.send('projectIds=' + projectIds.join(','));
                }
            }
        });
    </script>
</div>
</body>
</html>