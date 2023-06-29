<?php

session_start();

if (!isset($_SESSION["userId"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $taskId = $_POST['taskId'];
    $status = $_POST['status'];

    include 'db_connection.php';

    $sql = "UPDATE tasks SET status = '$status' WHERE id = $taskId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => $status));
    }

    $conn->close();

}
