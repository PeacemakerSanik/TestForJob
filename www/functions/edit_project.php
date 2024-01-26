<?php
require_once '../functions/connect.php';
session_start();

if (isset($_GET['id'])) {
    $projectId = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
    $sql->bindParam(':id', $projectId);
    $sql->execute();
    $project = $sql->fetch(PDO::FETCH_OBJ);

    if ($project) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["Submit"])) {
            if (isset($_POST['project_name']) && isset($_POST['Description'])) {
                $newProjectName = $_POST['project_name'];
                $newDescription = $_POST['Description'];

                // Обновляем название и описание проекта в базе данных
                $updateSql = $pdo->prepare("UPDATE projects SET project_name = :name, Description = :description WHERE id = :id");
                $updateSql->bindParam(':name', $newProjectName);
                $updateSql->bindParam(':description', $newDescription);
                $updateSql->bindParam(':id', $projectId);
                $updateSql->execute();
            }

            if (isset($_POST['delete_image'])) {
                // Удаление изображения из базы данных
                $sqlDelete = $pdo->prepare("UPDATE projects SET image = NULL WHERE id = :id");
                $sqlDelete->bindParam(':id', $projectId);
                $sqlDelete->execute();

                // Удаление файла изображения с сервера
            }

            // Обработка загрузки новой фотографии
            if (!empty($_FILES['new_image']['name']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "../images/";
                $target_file = $target_dir . basename($_FILES["new_image"]["name"]);
                $image_path = basename($_FILES["new_image"]["name"]);

                // Перемещение загруженного файла в указанную директорию
                move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file);

                // Удаление старой фотографии из базы данных
                $sqlDelete = $pdo->prepare("UPDATE projects SET image = NULL WHERE id = :id");
                $sqlDelete->bindParam(':id', $projectId);
                $sqlDelete->execute();

                // Запись нового пути фотографии в базу данных
                $sql = $pdo->prepare("UPDATE projects SET image = :image WHERE id = :id");
                $sql->bindParam(':image', $image_path);
                $sql->bindParam(':id', $projectId);
                $sql->execute();
            }

            header('Location:/project_list/project_list.php');
            exit;
        }

        echo '<h1>Редактирование информации о проекте: ' . $project->project_name . '</h1>';
        echo '<form action="" method="post" enctype="multipart/form-data">'; // Добавляем атрибут enctype для передачи файлов
        echo 'Название проекта: <input type="text" name="project_name" value="' . $project->project_name . '"><br>';
        echo 'Описание проекта: <input type="text" size="100" name="Description" value="' . $project->Description .'"<br><br>';
        $absolutepath='../images/'.$project->image;
        echo 'Фотография проекта: <img src="'.$absolutepath.'" width="250" height="250"><br>';
        echo '<input type="checkbox" name="delete_image" id="delete_image">Удалить фотографию проекта<br>';
        echo 'Загрузить новую фотографию: <input type="file" name="new_image"><br>';
        echo '<input type="submit" name="Submit" value="Сохранить">';
        echo '</form>';
    } else {
        echo 'Проект не найден';
    }
} else {
    echo 'Идентификатор проекта не указан';
}

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
</body>
</html>