<?php
header('Content-Type: application/json');

$conn = new mysqli('127.0.0.1', 'root', '', 'users_db', 3306);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$query = "SELECT id, name, avatar FROM user WHERE id != ?";
$stmt = $conn->prepare($query);
$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$stmt->bind_param('i', $current_user_id);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($users);
$stmt->close();
$conn->close();
?>