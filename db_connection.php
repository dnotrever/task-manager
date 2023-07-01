<?php

$servername = 'localhost';
$username = 'root';
$password = 'admin123';
$dbname = 'task_manager';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$usersTable = "users";
$tasksTable = "tasks";

$createUsersTable = "CREATE TABLE IF NOT EXISTS $usersTable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
)";

$createTasksTable = "CREATE TABLE IF NOT EXISTS $tasksTable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES $usersTable(id)
)";

$conn->query($createUsersTable);
$conn->query($createTasksTable);