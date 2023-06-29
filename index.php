<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="guest.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Tasks Manager - Login</title>
</head>
<body>

    <h1>Minhas Tarefas</h1>

    <div class="loginContainer display-flex">

        <h2>Login</h2>

        <div id="message"></div>

        <form id="loginForm" class="display-flex">

            <div class="form-group display-flex">
                <label>Email</label>
                <input id="email" type="email" name="email" required>
            </div>

            <div class="form-group display-flex">
                <label>Senha</label>
                <input id="password" type="password" name="password" required>
            </div>

            <button type="submit">Entrar</button>

        </form>

        <a href="register.php">Crie uma conta</a>

    </div>

</body>
</html>