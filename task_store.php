<?php

session_start();

if (!isset($_SESSION["userId"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'db_connection.php';

    $userId = $_POST['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tasks (user_id, title, description, created_at, updated_at) VALUES ('$userId', '$title', '$description', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success'));
    }

    $conn->close();
    
}
