<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    include 'db_connection.php';

    session_start();

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

<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="app.js"></script>
    <title>Tasks Manager - Login</title>
</head>
<body>

    <h2>Login</h2>

    <div id="message"></div>

    <form id="loginForm">

        <div class="form-group">
            <label>Email</label>
            <input id="email" type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input id="password" type="password" name="password" required>
        </div>

        <button type="submit">Login</button>

    </form>

    <a href="register.php">Create an account</a>

</body>
</html>