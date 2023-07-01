<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/configs/db_connection.php';
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userPassword = $row['password'];
            if (password_verify($password, $userPassword)) {
                $userId = $row['id'];
                $_SESSION['userId'] = $userId;
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Email e/ou senha inválidos.'));
            }
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Usuário não encontrado.'));
        }
        return $conn->close();
    }
?>