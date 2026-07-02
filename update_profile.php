<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'] ?? '';
    $job = $_POST['job'] ?? '';
    $address = $_POST['address'] ?? '';
    $facebook = $_POST['facebook'] ?? '';

    // Xử lý upload avatar
    $avatar = $_SESSION['avatar'] ?? 'img/default_avatar.jpg';
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (!is_writable($uploadDir)) {
            echo "error: Upload directory is not writable";
            exit();
        }
        $avatarName = uniqid() . '_' . basename($_FILES['avatar']['name']);
        $targetPath = $uploadDir . $avatarName;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
            $avatar = $targetPath;
        }
    }

    // Cập nhật database
    $stmt = $conn->prepare("UPDATE user SET name=?, job=?, address=?, facebook=?, avatar=? WHERE id=?");
    if (!$stmt) {
        echo "error: Failed to prepare statement";
        exit();
    }
    $stmt->bind_param("sssssi", $name, $job, $address, $facebook, $avatar, $user_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['name'] = $name;
            $_SESSION['job'] = $job;
            $_SESSION['address'] = $address;
            $_SESSION['facebook'] = $facebook;
            $_SESSION['avatar'] = $avatar;
            echo "success";
        } else {
            echo "error: No user found with this ID";
        }
    } else {
        echo "error: Database update failed";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "invalid request";
}
?>