<?php
session_start();
require_once 'config.php';

// Kiểm tra kết nối cơ sở dữ liệu
if (!$conn) {
    $_SESSION['register_error'] = "Không thể kết nối cơ sở dữ liệu!";
    header("Location: Register.php");
    exit();
}

// Đăng ký
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'user';

    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['register_error'] = "Vui lòng điền đầy đủ thông tin!";
        header("Location: Register.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register_error'] = "Email không hợp lệ!";
        header("Location: Register.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
    if (!$stmt) {
        $_SESSION['register_error'] = "Lỗi kết nối cơ sở dữ liệu!";
        header("Location: Register.php");
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $check = $stmt->get_result();

    if ($check->num_rows > 0) {
        $_SESSION['register_error'] = "Email đã được sử dụng!";
        header("Location: Register.php");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
    if (!$stmt) {
        $_SESSION['register_error'] = "Lỗi kết nối cơ sở dữ liệu!";
        header("Location: Register.php");
        exit();
    }
    $stmt->bind_param("ssss", $name, $email, $password_hash, $role);

    if ($stmt->execute()) {
        $_SESSION['register_success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
        header("Location: Login.php");
    } else {
        $_SESSION['register_error'] = "Đăng ký thất bại. Vui lòng thử lại!";
        header("Location: Register.php");
    }
    exit();
}

// Đăng nhập
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Vui lòng điền đầy đủ thông tin!";
        header("Location: Login.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, name, email, password, role, job, address, facebook, avatar FROM user WHERE email = ?");
    if (!$stmt) {
        $_SESSION['login_error'] = "Lỗi kết nối cơ sở dữ liệu!";
        header("Location: Login.php");
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'] ?? '';
            $_SESSION['email'] = $user['email'] ?? '';
            $_SESSION['role'] = $user['role'] ?? 'user';
            $_SESSION['job'] = $user['job'] ?? '';
            $_SESSION['address'] = $user['address'] ?? '';
            $_SESSION['facebook'] = $user['facebook'] ?? '';
            $_SESSION['avatar'] = $user['avatar'] ?? 'img/default.jpg';

            header("Location: trangchu.php");
            exit();
        }
    }

    $_SESSION['login_error'] = "Sai email hoặc mật khẩu!";
    header("Location: Login.php");
    exit();
}
?>