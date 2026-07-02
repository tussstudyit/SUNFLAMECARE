<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['post_id'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];

// Kiểm tra xem người dùng đã thích bài viết chưa
$stmt = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND user_id = ?");
$stmt->bind_param("ii", $post_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Đã thích -> Bỏ thích
    $stmt = $conn->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();

    // Cập nhật số lượt thích
    $stmt = $conn->prepare("UPDATE post SET likes = likes - 1 WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT likes FROM post WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    echo json_encode(['success' => true, 'liked' => false, 'likes' => $post['likes']]);
} else {
    // Chưa thích -> Thích
    $stmt = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();

    // Cập nhật số lượt thích
    $stmt = $conn->prepare("UPDATE post SET likes = likes + 1 WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT likes FROM post WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    echo json_encode(['success' => true, 'liked' => true, 'likes' => $post['likes']]);
}

$stmt->close();
$conn->close();

?>