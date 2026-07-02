<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id']) && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'] ?? '';
    $image = null;

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
        // Xử lý upload ảnh mới
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            if (!is_writable($uploadDir)) {
                echo "error: Upload directory is not writable";
                exit();
            }
            $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $imageName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image = $targetPath;
                // Xóa ảnh cũ nếu tồn tại
                if ($post['image'] && file_exists($post['image'])) {
                    unlink($post['image']);
                }
            } else {
                echo "error: Failed to upload image";
                exit();
            }
        }

        // Cập nhật bài đăng
        $stmt = $conn->prepare("UPDATE post SET content = ?, image = ? WHERE id = ? AND user_id = ?");
        if (!$stmt) {
            echo "error: Failed to prepare update statement";
            exit();
        }
        $stmt->bind_param("ssii", $content, $image, $post_id, $user_id);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error: Failed to update post";
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