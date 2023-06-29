<?php

session_start();

if (!isset($_SESSION["userId"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'db_connection.php';

    $taskId = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE tasks SET title = '$title', description = '$description' WHERE id = $taskId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success'));
    }

    $conn->close();

}
