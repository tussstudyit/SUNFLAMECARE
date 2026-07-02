<?php
session_start();
require_once 'config.php'; // Kết nối cơ sở dữ liệu

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Bạn cần đăng nhập để đăng bài']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Phương thức không hợp lệ']);
    exit();
}

$user_id = $_SESSION['user_id'];
$content = $_POST['content'] ?? '';
$group_name = $_POST['group_name'] ?? '';
$csrf_token = $_POST['csrf_token'] ?? '';

if ($csrf_token !== $_SESSION['csrf_token']) {
    echo json_encode(['error' => 'CSRF token không hợp lệ']);
    exit();
}

if (empty($content) && empty($_FILES['image']['name'])) {
    echo json_encode(['error' => 'Vui lòng nhập nội dung hoặc chọn ảnh']);
    exit();
}

// Xử lý upload ảnh
$image_path = '';
if (!empty($_FILES['image']['name'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $image_name = time() . '_' . basename($_FILES['image']['name']);
    $target_file = $target_dir . $image_name;
    $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!in_array($image_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo json_encode(['error' => 'Định dạng ảnh không hợp lệ']);
        exit();
    }

    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        echo json_encode(['error' => 'Ảnh quá lớn, tối đa 5MB']);
        exit();
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_path = $target_file;
    } else {
        echo json_encode(['error' => 'Lỗi khi upload ảnh']);
        exit();
    }
}

// Thêm bài viết vào cơ sở dữ liệu
$stmt = $conn->prepare("INSERT INTO post (user_id, content, image, group_name, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("isss", $user_id, $content, $image_path, $group_name);
if ($stmt->execute()) {
    $post_id = $stmt->insert_id;
    $stmt->close();

    // Lấy thông tin bài viết vừa thêm
    $stmt = $conn->prepare("SELECT p.id, p.content, p.image, p.created_at, p.likes, p.group_name, u.name, u.avatar 
                            FROM post p 
                            JOIN user u ON p.user_id = u.id 
                            WHERE p.id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    echo json_encode([
        'success' => true,
        'post' => [
            'id' => $post['id'],
            'content' => $post['content'],
            'image' => $post['image'],
            'created_at' => $post['created_at'],
            'likes' => $post['likes'] ?? 0,
            'group_name' => $post['group_name'],
            'author' => [
                'name' => $post['name'],
                'avatar' => $post['avatar'] ?? 'img/default_avatar.jpg'
            ]
        ]
    ]);
} else {
    echo json_encode(['error' => 'Lỗi khi đăng bài']);
}

$conn->close();
?>