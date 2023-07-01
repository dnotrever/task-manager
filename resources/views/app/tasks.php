<?php

    include include $_SERVER['DOCUMENT_ROOT'] . '/middlewares/session.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db_connection.php';

    $userId = $_SESSION['userId'];

    $sql = "SELECT * FROM users WHERE id = '$userId'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
    }

    $conn->close();

?>

<?php
    $title = 'Gerenciar';
    ob_start();
?>

<div class="container display-flex">

    <header>

        <h1>Minhas Tarefas</h1>

        <div class="sideHeader">
            <span><?php echo $email ?></span>
            <form action="/controllers/user/user_logout.php" method="POST">
                <button type="submit">Logout</button>
            </form>
        </div>
        
    </header>

    <main>

        <form class="taskInsertForm">
            <h3>Adicionar Tarefa</h3>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $userId ?>">
            <div class="form-group">
                <label>Título</label>
                <input id="title" type="text" name="title" required autofocus>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea id="description" type="text" name="description" placeholder="Opcional"></textarea>
            </div>
            <button type="submit">Adicionar</button>
            <div id="message"></div>
        </form>

        <div class="showTasks">
            <div class="tasksList" data-user="<?php echo $userId ?>"></div>
            <div class="doneTasks">
                <h4>
                    Tarefas Finalizadas
                    <span id="quantity">(0)</span>
                </h4>
            </div>
        </div>

    </main>

</div>

<?php
    $content = ob_get_clean();
    include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/app.php';
?>