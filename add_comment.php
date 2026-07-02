<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['post_id']) || !isset($_POST['content'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$content = trim($_POST['content']);

if (empty($content)) {
    echo json_encode(['error' => 'Nội dung bình luận không được để trống']);
    exit();
}

// Thêm bình luận
$stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $post_id, $user_id, $content);
if ($stmt->execute()) {
    $comment_id = $stmt->insert_id;
    $stmt = $conn->prepare("SELECT c.content, c.created_at, u.name, u.avatar 
                           FROM comments c 
                           JOIN user u ON c.user_id = u.id 
                           WHERE c.id = ?");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comment = $result->fetch_assoc();

    echo json_encode([
        'success' => true,
        'comment' => [
            'content' => $comment['content'],
            'created_at' => (new DateTime($comment['created_at']))->format('d/m/Y H:i'),
            'name' => $comment['name'],
            'avatar' => $comment['avatar'] ?? 'img/default_avatar.jpg'
        ]
    ]);
} else {
    echo json_encode(['error' => 'Không thể thêm bình luận']);
}

$stmt->close();
$conn->close();

?>