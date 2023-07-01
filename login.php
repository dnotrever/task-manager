<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    session_start();
    
    include 'db_connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $userId = $row['id'];

        $_SESSION['userId'] = $userId;

        echo json_encode(array('status' => 'success'));

    } else {

        echo json_encode(array('status' => 'failed', 'message' => 'Email e/ou senha inválidos.'));

    }

    $conn->close();

}

?>