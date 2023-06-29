<?php

include 'db_connection.php';

$userId = $_GET['user_id'];

$sql = "SELECT * FROM tasks WHERE user_id = '$userId'";
$result = $conn->query($sql);

$tasks = [];

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $task = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'status' => $row['status']
        );

        $tasks[] = $task;

    }
}

$conn->close();

header('Content-Type: application/json');

echo json_encode($tasks);