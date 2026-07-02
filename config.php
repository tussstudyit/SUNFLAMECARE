<?php
// Thông tin kết nối cơ sở dữ liệu
$host = 'localhost';
$dbname = 'users_db';
$username = 'root';
$password = '';
$port = 3306;

// Tạo kết nối
try {
    $conn = new mysqli($host, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        throw new Exception("Kết nối thất bại: " . $conn->connect_error);
    }
    // Thiết lập charset để hỗ trợ tiếng Việt và emoji
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    error_log("Database connection failed: " . $e->getMessage());
    http_response_code(500);
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'message' => 'Không thể kết nối cơ sở dữ liệu. Vui lòng thử lại sau.']);
    } else {
        echo '<div style="color: red; text-align: center; padding: 20px;">Không thể kết nối cơ sở dữ liệu. Vui lòng thử lại sau.</div>';
    }
    exit;
}
?>