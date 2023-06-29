<?php

session_start();

if (!isset($_SESSION["userId"])) {
    header("Location: index.php");
    exit;
}

$userId = $_SESSION['userId'];

?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="app.js"></script>
    <title>Tasks Manager - My Tasks</title>
</head>
<body>

    <h2>Welcome!</h2>

    <div id="message"></div>

    <form id="taskInsertForm">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $userId ?>">
        <div class="form-group">
            <label>Task Title</label>
            <input id="title" type="text" name="title">
        </div>
        <div class="form-group">
            <label>Task Description</label>
            <textarea id="description" type="text" name="description"></textarea>
        </div>
        <button type="submit">Add Task</button>
    </form>

    <div class="tasksList" data-user="<?php echo $userId ?>"></div>

    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>

</body>
</html>