<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

require_once 'config.php';

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'] ?? null;

if (!$post_id) {
    echo json_encode(['success' => false, 'message' => 'Missing post ID']);
    exit();
}

try {
    // Tăng số lượt thích
    $stmt = $conn->prepare("UPDATE post SET likes = likes + 1 WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    // Lấy số lượt thích mới
    $stmt = $conn->prepare("SELECT likes FROM post WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    echo json_encode(['success' => true, 'likes' => $post['likes']]);

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
}
?>