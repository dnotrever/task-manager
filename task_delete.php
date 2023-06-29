<?php

$taskId = $_POST['taskId'];
$title = $_POST['title'];
$description = $_POST['description'];

include 'db_connection.php';

$sql = "UPDATE tasks SET (title = '$title', description = '$description') WHERE id = $taskId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array('status' => $status));
}

$conn->close();
