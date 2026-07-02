<?php
// Bắt đầu session nếu chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Xóa tất cả dữ liệu session
$_SESSION = [];

// Nếu muốn xóa cả cookie session (tùy chọn)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Hủy session
session_destroy();

// Chuyển hướng về trang đăng nhập
header("Location: Login.php");
exit();
?>