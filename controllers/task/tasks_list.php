<?php
include $_SERVER['DOCUMENT_ROOT'] . '/middlewares/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db_connection.php';
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
            'status' => $row['status'],
            'created_at' => date('d/m/Y \à\s H:i', strtotime($row['created_at'])),
            'completed_at' => date('d/m/Y \à\s H:i', strtotime($row['completed_at'])),
        );
        $tasks[] = $task;
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($tasks);