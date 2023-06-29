<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'db_connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        echo json_encode(array('status' => 'error', 'message' => 'O email já está sendo utilizado!'));
        exit;
    }

    $sql = "INSERT INTO users (email, password, created_at, updated_at) VALUES ('$email', '$password', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success'));
        exit;
    }

    $conn->close();

}

?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="guest.js"></script>
    <link rel="stylesheet" href="css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Tasks Manager - Register</title>
</head>
<body>

    <h1>Minhas Tarefas</h1>

    <div class="registerContainer display-flex">

        <h2>Cadastrar</h2>

        <div id="message"></div>

        <form id="registerForm" class="display-flex">
            
            <div class="form-group display-flex">
                <label>Email</label>
                <input id="email" type="email" name="email" required>
            </div>

            <div class="form-group display-flex">
                <label>Senha</label>
                <input id="password" type="password" name="password" required>
            </div>

            <button type="submit">Register</button>

        </form>

        <a href="index.php">Já possui conta? <b>Login!</b></a>

    </div>

</body>
</html>