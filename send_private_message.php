<?php
header('Content-Type: application/json');
session_start();

$sender_id = isset($_POST['sender_id']) ? $_POST['sender_id'] : 0;
$receiver_id = isset($_POST['receiver_id']) ? $_POST['receiver_id'] : 0;
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

// Kiểm tra quyền gửi tin nhắn
$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
if ($current_user_id != $sender_id) {
    echo json_encode(['error' => 'Unauthorized access']);
    exit();
}

$query = "INSERT INTO private_messages (sender_id, receiver_id, content, image) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('iiss', $sender_id, $receiver_id, $content, $image);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to send private message']);
}

$stmt->close();
$conn->close();
?>