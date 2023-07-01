<?php
    $title = 'Cadastrar';
    ob_start();
?>

<div class="container display-flex">

    <h2>Cadastrar</h2>

    <div id="message"></div>

    <form id="registerForm" class="display-flex">
        
        <div class="form-group">
            <label>Email</label>
            <input id="email" type="email" name="email" required autofocus>
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input id="password" type="password" name="password" required>
        </div>

        <button type="submit">Cadastrar</button>

    </form>

    <a href="login.php">Já possui conta? <b>Login!</b></a>

</div>

<?php
    $content = ob_get_clean();
    include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/guest.php';
?>