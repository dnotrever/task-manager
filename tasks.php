<?php

include 'user_session.php';
include 'db_connection.php';

$userId = $_SESSION['userId'];

$sql = "SELECT * FROM users WHERE id = '$userId'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="app.js"></script>
    <link rel="stylesheet" href="css/tasks.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Minhas Tarefas</title>
</head>
<body>
    <div class="tasksContainer display-flex">
        <header>
            <h1>Minhas Tarefas</h1>
            <div>
                <span><?php echo $email ?></span>
                <form action="logout.php" method="POST">
                    <button type="submit">Logout</button>
                </form>
            </div>
        </header>
        <main>
            <form id="taskInsertForm">
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
                <div class="doneTasks">Tarefas Finalizadas <span id="quantity">(0)</span></div>
            </div>
        </main>
    </div>
</body>
</html>