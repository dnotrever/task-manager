<?php

include 'user_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'db_connection.php';

    $taskId = $_POST['task_id'];

    $sql = "DELETE FROM tasks WHERE id = $taskId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success'));
    }

    $conn->close();

}
