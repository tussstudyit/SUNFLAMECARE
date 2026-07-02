<?php
header('Content-Type: application/json');
session_start();

$group_id = isset($_POST['group_id']) ? $_POST['group_id'] : '';
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : null;
$image = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = 'uploads/';
    $image = $upload_dir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image);
}

$conn = new mysqli('127.0.0.1', 'root', '', 'users_db', 3306);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$query = "INSERT INTO messages (group_id, user_id, content, image) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('siss', $group_id, $user_id, $content, $image);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to send message']);
}

$stmt->close();
$conn->close();
?>