<?php
    $title = 'Welcome';
    ob_start();
?>

<div class="homeContainer display-flex">

    <a href="/resources/views/guest/login.php">Faça Login</a>
    <a href="/resources/views/guest/register.php">Crie uma Conta</a>

</div>

<?php
    $content = ob_get_clean();
    include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/guest.php';
?>