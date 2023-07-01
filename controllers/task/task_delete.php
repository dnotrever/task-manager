<?php
include $_SERVER['DOCUMENT_ROOT'] . '/middlewares/session.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db_connection.php';
    $taskId = $_POST['task_id'];
    $sql = "DELETE FROM tasks WHERE id = $taskId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success'));
    }
    $conn->close();
}
