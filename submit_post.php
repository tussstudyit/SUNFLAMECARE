<?php
header('Content-Type: application/json');
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Bạn cần đăng nhập để đăng bài!']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Phương thức không hợp lệ']);
    exit();
}

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo json_encode(['success' => false, 'error' => 'CSRF token không hợp lệ']);
    exit();
}

$user_id = $_SESSION['user_id'];
$group_id = $_POST['group_id'] ?? '';
$content = $_POST['content'] ?? '';
$image_path = null;

if (empty($group_id)) {
    echo json_encode(['success' => false, 'error' => 'Thiếu group_id']);
    exit();
}

if (empty($content)) {
    echo json_encode(['success' => false, 'error' => 'Nội dung không được để trống']);
    exit();
}

$stmt = $conn->prepare("SELECT * FROM group_members WHERE group_id = ? AND user_id = ? AND status = 'approved'");
$stmt->bind_param("si", $group_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'Bạn chưa được duyệt tham gia nhóm này']);
    exit();
}
$stmt->close();

if (!empty($_FILES['image']['name'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
    $image_name = time() . '_' . basename($_FILES['image']['name']);
    $target_file = $target_dir . $image_name;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_path = $target_file;
    }
}

$stmt = $conn->prepare("INSERT INTO community_posts (user_id, group_id, content, image, status) VALUES (?, ?, ?, ?, 'pending')");
$stmt->bind_param("isss", $user_id, $group_id, $content, $image_path);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Lỗi khi gửi bài: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>