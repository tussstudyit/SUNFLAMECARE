<?php
header('Content-Type: application/json');
session_start();

$sender_id = isset($_GET['sender_id']) ? $_GET['sender_id'] : 0;
$receiver_id = isset($_GET['receiver_id']) ? $_GET['receiver_id'] : 0;
$last_id = isset($_GET['last_id']) ? $_GET['last_id'] : 0;
$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

$conn = new mysqli('127.0.0.1', 'root', '', 'users_db', 3306);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// Kiểm tra quyền truy cập: chỉ người gửi hoặc người nhận mới thấy tin nhắn
if ($current_user_id != $sender_id && $current_user_id != $receiver_id) {
    echo json_encode(['error' => 'Unauthorized access']);
    exit();
}

$query = "SELECT pm.*, u.name, u.avatar 
          FROM private_messages pm 
          JOIN user u ON pm.sender_id = u.id 
          WHERE ((pm.sender_id = ? AND pm.receiver_id = ?) 
              OR (pm.sender_id = ? AND pm.receiver_id = ?)) 
              AND pm.id > ? 
          ORDER BY pm.timestamp ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param('iiiii', $sender_id, $receiver_id, $receiver_id, $sender_id, $last_id);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($messages);
$stmt->close();
$conn->close();
?>