<?php
session_start();
require_once 'config.php';

$group_name = $_GET['group_name'] ?? '';

$stmt = $conn->prepare("SELECT p.id, p.content, p.image, p.created_at, p.likes, 
                        (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.id) as comments_count, 
                        u.name, u.avatar 
                        FROM post p 
                        JOIN user u ON p.user_id = u.id 
                        WHERE p.group_name = ?");
$stmt->bind_param("s", $group_name);
$stmt->execute();
$result = $stmt->get_result();

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = [
        'id' => $row['id'],
        'content' => $row['content'],
        'image' => $row['image'],
        'created_at' => $row['created_at'],
        'likes' => $row['likes'] ?? 0,
        'comments_count' => $row['comments_count'],
        'author' => [
            'name' => $row['name'],
            'avatar' => $row['avatar'] ?? 'img/default_avatar.jpg'
        ]
    ];
}

echo json_encode($posts);

$conn->close();
?>