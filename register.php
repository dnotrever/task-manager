<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'db_connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        echo json_encode(array('status' => 'error', 'message' => 'O email já está cadastrado.'));
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
    <script src="app.js"></script>
    <title>Tasks Manager - Register</title>
</head>
<body>

    <h2>Register</h2>

    <div id="message"></div>

    <form id="registerForm">
        
        <div class="form-group">
            <label>Email</label>
            <input id="email" type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input id="password" type="password" name="password" required>
        </div>

        <button type="submit">Register</button>

    </form>

    <a href="login.php">Already an account? Login!</a>

</body>
</html>