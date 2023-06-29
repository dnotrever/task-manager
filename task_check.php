<?php

$taskId = $_POST['taskId'];
$status = $_POST['status'];

include 'db_connection.php';

$sql = "UPDATE tasks SET status = '$status' WHERE id = $taskId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array('status' => $status));
}

$conn->close();
