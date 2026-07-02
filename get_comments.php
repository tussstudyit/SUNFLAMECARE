<?php
session_start();
require_once 'config.php';

if (!isset($_GET['post_id'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit();
}

$post_id = $_GET['post_id'];

$stmt = $conn->prepare("SELECT c.content, c.created_at, u.name, u.avatar 
                       FROM comments c 
                       JOIN user u ON c.user_id = u.id 
                       WHERE c.post_id = ? 
                       ORDER BY c.created_at ASC");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = [
        'content' => $row['content'],
        'created_at' => (new DateTime($row['created_at']))->format('Y-m-d H:i:s'),
        'name' => $row['name'],
        'avatar' => $row['avatar'] ?? 'img/default_avatar.jpg'
    ];
}

echo json_encode($comments);
$stmt->close();
$conn->close();
?>