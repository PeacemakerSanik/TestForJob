<?php
require_once '..\functions\connect.php';
session_start();

if (isset($_POST["submit"])) {
    if (isset($_POST["project_name"]) and isset($_POST["Description"])) {
        // Путь для сохранения загруженного файла
        $target_dir = "../images/";
        $target_file =  $target_dir . basename($_FILES["project_image"]["name"]);

        // Сохранение пути в базу данных
        $image_path = basename($_FILES["project_image"]["name"]); // Это значение можно сохранить в базу данных

        // Перемещение загруженного файла в указанную директорию
        move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file);

        // Запись в базу данных
        $sql = $pdo->prepare("INSERT INTO projects (project_name, Description, image) VALUES (:project_name, :Description, :image)");
        $sql->bindParam(':project_name', $_POST['project_name']);
        $sql->bindParam(':Description', $_POST['Description']);
        $sql->bindParam(':image', $image_path);
        $sql->execute();
        header('Location:/project_list/project_list.php');
    }
}
?>
