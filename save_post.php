<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized";
    exit();
}

require_once 'config.php';

$user_id = $_SESSION['user_id'];
$content = $_POST['content'] ?? '';
$image = $_FILES['image'] ?? null;

// Đảm bảo thư mục uploads tồn tại
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$image_path = null; // Không dùng ảnh mặc định
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

try {
    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        // Kiểm tra loại file
        if (!in_array($image['type'], $allowed_types)) {
            echo "Chỉ hỗ trợ định dạng JPEG, PNG, GIF";
            exit();
        }

        // Kiểm tra kích thước (giới hạn 5MB)
        if ($image['size'] > 5 * 1024 * 1024) {
            echo "Ảnh quá lớn, tối đa 5MB";
            exit();
        }

        $image_name = uniqid() . '_' . basename($image['name']);
        $target_file = $upload_dir . $image_name;

        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            $image_path = $target_file;
        } else {
            echo "Lỗi khi lưu ảnh vào thư mục uploads";
            exit();
        }
    }

    // Lưu vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO post (user_id, content, image, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("iss", $user_id, $content, $image_path);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Lỗi khi lưu bài viết vào cơ sở dữ liệu";
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>