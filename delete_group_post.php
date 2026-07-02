<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Bạn cần đăng nhập để xóa bài']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Phương thức không hợp lệ']);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'] ?? 0;

// Kiểm tra quyền xóa
$stmt = $conn->prepare("SELECT user_id, image FROM post WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo json_encode(['error' => 'Bài viết không tồn tại']);
    exit();
}
$post = $result->fetch_assoc();
if ($post['user_id'] !== $user_id) {
    echo json_encode(['error' => 'Bạn không có quyền xóa bài viết này']);
    exit();
}

// Xóa ảnh nếu có
if ($post['image'] && file_exists($post['image'])) {
    unlink($post['image']);
}

// Xóa bình luận liên quan
$stmt = $conn->prepare("DELETE FROM comments WHERE post_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();

// Xóa lượt thích liên quan
$stmt = $conn->prepare("DELETE FROM likes WHERE post_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();

// Xóa bài viết
$stmt = $conn->prepare("DELETE FROM post WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $post_id, $user_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Lỗi khi xóa bài viết']);
}

$stmt->close();
$conn->close();
?>