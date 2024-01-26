<?php
require_once '../functions/connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['projectIds'])) {
    $projectIds = explode(',', $_POST['projectIds']);
    $placeholders = rtrim(str_repeat('?,', count($projectIds)), ',');
    $sql = "DELETE FROM projects WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($projectIds);
}
?>