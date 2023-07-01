<?php
    $title = 'Login';
    ob_start();
?>

<div class="container display-flex">

    <h2>Login</h2>

    <div id="message"></div>

    <form id="loginForm" class="display-flex">

        <div class="form-group">
            <label>Email</label>
            <input id="email" type="email" name="email" required autofocus>
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input id="password" type="password" name="password" required>
        </div>

        <button type="submit">Entrar</button>

    </form>

    <a href="register.php">Crie uma conta!</a>

</div>

<?php
    $content = ob_get_clean();
    include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/guest.php';
?>