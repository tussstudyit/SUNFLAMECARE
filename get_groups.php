<?php
header('Content-Type: application/json');

$conn = new mysqli('127.0.0.1', 'root', '', 'users_db', 3306);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$query = "SELECT group_id, title, avatar FROM groups";
$result = $conn->query($query);
$groups = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($groups);
$conn->close();
?>