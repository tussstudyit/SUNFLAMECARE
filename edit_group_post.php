<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Bạn cần đăng nhập để chỉnh sửa bài']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Phương thức không hợp lệ']);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'] ?? 0;
$content = $_POST['content'] ?? '';
$group_name = $_POST['group_name'] ?? '';

// Kiểm tra quyền chỉnh sửa
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
    echo json_encode(['error' => 'Bạn không có quyền chỉnh sửa bài viết này']);
    exit();
}

$image_path = $post['image'];
if (!empty($_FILES['image']['name'])) {
    // Xóa ảnh cũ nếu có
    if ($image_path && file_exists($image_path)) {
        unlink($image_path);
    }

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

$stmt = $conn->prepare("UPDATE post SET content = ?, image = ?, group_name = ? WHERE id = ? AND user_id = ?");
$stmt->bind_param("sssii", $content, $image_path, $group_name, $post_id, $user_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Lỗi khi chỉnh sửa bài viết']);
}

$stmt->close();
$conn->close();
?>