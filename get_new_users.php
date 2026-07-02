<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    $current_user_id = $_SESSION['user_id'];

    // Lấy danh sách người dùng (trừ người dùng hiện tại)
    $stmt = $conn->prepare("SELECT id, name, email, avatar FROM user WHERE id != ? ORDER BY created_at DESC LIMIT 5");
    if (!$stmt) {
        echo json_encode(['error' => 'Failed to prepare statement']);
        exit();
    }
    $stmt->bind_param("i", $current_user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'], // Hiển thị email như tên tài khoản
            'avatar' => $row['avatar'] ?? 'img/default_avatar.jpg'
        ];
    }

    echo json_encode($users);
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Unauthorized']);
}
?>