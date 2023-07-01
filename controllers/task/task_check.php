<?php

include include $_SERVER['DOCUMENT_ROOT'] . '/middlewares/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $taskId = $_POST['taskId'];
    $status = $_POST['status'];

    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db_connection.php';

    $sql = "UPDATE tasks SET status = '$status' WHERE id = $taskId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => $status));
    }

    $conn->close();

}
