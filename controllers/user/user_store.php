<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include $_SERVER['DOCUMENT_ROOT'] . '/configs/db_connection.php';

        $email = $_POST['email'];
        $password = $_POST['password'];

        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkEmailResult = $conn->query($checkEmailQuery);

        if ($checkEmailResult->num_rows > 0) {
            echo json_encode(array('status' => 'error', 'message' => 'Esse email já está sendo utilizado!'));
            exit;
        }

        $sql = "INSERT INTO users (email, password, created_at, updated_at) VALUES ('$email', '$password', NOW(), NOW())";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('status' => 'success'));
            exit;
        }

        return $conn->close();

    }

?>