<?php
session_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

$conn = new mysqli('localhost', 'root', '', 'users_db');
if ($conn->connect_error) {
    echo "data: Lỗi kết nối cơ sở dữ liệu\n\n";
    exit();
}

$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$last_message_id = isset($_GET['last_id']) ? (int)$_GET['last_id'] : 0;

while (true) {
    // Truy vấn tin nhắn mới từ bảng private_messages
    $query = "SELECT pm.*, u.name, u.avatar 
              FROM private_messages pm 
              JOIN user u ON pm.sender_id = u.id 
              WHERE pm.id > ? AND (pm.sender_id = ? OR pm.receiver_id = ?) 
              ORDER BY pm.timestamp ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $last_message_id, $current_user_id, $current_user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $new_messages = $result->fetch_all(MYSQLI_ASSOC);

    if (!empty($new_messages)) {
        $last_message_id = $new_messages[count($new_messages) - 1]['id'];
        $data = json_encode(['messages' => $new_messages]);
        echo "data: $data\n\n";
        ob_flush();
        flush();
    }

    // Chờ 1 giây trước khi kiểm tra lại
    sleep(1);

    // Kiểm tra kết nối
    if (connection_aborted()) {
        break;
    }
}

$stmt->close();
$conn->close();
?>