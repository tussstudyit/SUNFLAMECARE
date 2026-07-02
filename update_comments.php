<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

require_once 'db_connect.php';

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'] ?? null;

if (!$post_id) {
    echo json_encode(['success' => false, 'message' => 'Missing post ID']);
    exit();
}

try {
    // Tăng số bình luận
    $stmt = $conn->prepare("UPDATE post SET comments = comments + 1 WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    // Lấy số bình luận mới
    $stmt = $conn->prepare("SELECT comments FROM post WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    echo json_encode(['success' => true, 'comments' => $post['comments']]);

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
}
?>