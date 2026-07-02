<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id']) && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    // Kiểm tra xem bài đăng có thuộc về người dùng không
    $stmt = $conn->prepare("SELECT image FROM post WHERE id = ? AND user_id = ?");
    if (!$stmt) {
        echo "error: Failed to prepare statement";
        exit();
    }
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if ($post) {
        // Xóa ảnh nếu tồn tại
        if ($post['image'] && file_exists($post['image'])) {
            unlink($post['image']);
        }

        // Xóa các bình luận liên quan trước
        $stmt_comments = $conn->prepare("DELETE FROM comments WHERE post_id = ?");
        if (!$stmt_comments) {
            echo "error: Failed to prepare delete comments statement";
            exit();
        }
        $stmt_comments->bind_param("i", $post_id);
        $stmt_comments->execute();
        $stmt_comments->close();

        // Xóa bài đăng
        $stmt = $conn->prepare("DELETE FROM post WHERE id = ? AND user_id = ?");
        if (!$stmt) {
            echo "error: Failed to prepare delete statement";
            exit();
        }
        $stmt->bind_param("ii", $post_id, $user_id);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error: Failed to delete post";
        }
    } else {
        echo "error: Post not found or not authorized";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "invalid request";
}
?>