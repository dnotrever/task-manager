<?php

include include $_SERVER['DOCUMENT_ROOT'] . '/middlewares/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db_connection.php';

    $userId = $_POST['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tasks (user_id, title, description, created_at, updated_at) VALUES ('$userId', '$title', '$description', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success'));
    }

    return $conn->close();
    
}
