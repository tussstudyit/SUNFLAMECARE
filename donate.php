<?php
require_once 'config.php';

// Thiết lập header cho JSON response
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
header('Access-Control-Allow-Credentials: true');

// Xử lý preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Hàm phản hồi JSON
function jsonResponse($success, $message, $data = null) {
    $response = [
        'success' => $success,
        'message' => $message,
        'data' => $data
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// Hàm làm sạch đầu vào
function validateInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Hàm validate số điện thoại
function validatePhone($phone) {
    $phone = preg_replace('/[\s\-\(\)]/', '', $phone);
    return preg_match('/^[0-9]{10,11}$/', $phone);
}

// Hàm validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Chỉ cho phép phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Phương thức request không hợp lệ');
}

// Lấy và xử lý dữ liệu từ POST
$data = $_POST;

// Debug log
error_log("POST Data received: " . print_r($_POST, true));

$activity_code    = validateInput($data['activity_code'] ?? '');
$donation_amount  = floatval($data['donation_amount'] ?? 0);
$full_name        = validateInput($data['full_name'] ?? '');
$phone            = validateInput($data['phone'] ?? '');
$email            = validateInput($data['email'] ?? '');
$address          = validateInput($data['address'] ?? '');
$message          = validateInput($data['message'] ?? '');

// Kiểm tra đầu vào
$errors = [];

if (empty($activity_code) || $activity_code === 'UNKNOWN') {
    $errors[] = 'Mã hoạt động là bắt buộc';
}
if ($donation_amount <= 0) {
    $errors[] = 'Số tiền quyên góp phải lớn hơn 0';
}
if ($donation_amount < 1000) {
    $errors[] = 'Số tiền quyên góp tối thiểu là 1.000 VND';
}
if (empty($full_name)) {
    $errors[] = 'Họ và tên là bắt buộc';
}
if (strlen($full_name) < 2) {
    $errors[] = 'Họ và tên phải có ít nhất 2 ký tự';
}
if (empty($phone)) {
    $errors[] = 'Số điện thoại là bắt buộc';
} elseif (!validatePhone($phone)) {
    $errors[] = 'Số điện thoại không hợp lệ (10-11 số)';
}
if (!empty($email) && !validateEmail($email)) {
    $errors[] = 'Email không hợp lệ';
}
if (empty($address)) {
    $errors[] = 'Địa chỉ là bắt buộc';
}
if (strlen($address) < 10) {
    $errors[] = 'Địa chỉ phải có ít nhất 10 ký tự';
}

if (!empty($errors)) {
    jsonResponse(false, implode(', ', $errors));
}

try {
    // Kiểm tra số lần quyên góp trong ngày để tránh spam
    $today = date('Y-m-d');
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM donations WHERE phone = ? AND DATE(created_at) = ?");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $phone, $today);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row['count'] >= 5) {
        jsonResponse(false, 'Bạn đã quyên góp quá nhiều lần trong ngày. Vui lòng thử lại vào ngày mai.');
    }

    // Chuẩn bị dữ liệu để insert
    $temp_transfer = "QUYENGOP_{$activity_code}";
    $stmt = $conn->prepare("INSERT INTO donations (activity_code, transfer_content, amount, full_name, phone, email, address, message, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ssdsssss", $activity_code, $temp_transfer, $donation_amount, $full_name, $phone, $email, $address, $message);

    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $donation_id = $conn->insert_id;
    $stmt->close();

    // Cập nhật nội dung chuyển khoản có donation_id để admin quản lý
    $transfer_content = "QUYENGOP_{$activity_code}_{$donation_id}";
    $stmt_update = $conn->prepare("UPDATE donations SET transfer_content = ? WHERE id = ?");
    
    if (!$stmt_update) {
        throw new Exception("Prepare update failed: " . $conn->error);
    }
    
    $stmt_update->bind_param("si", $transfer_content, $donation_id);
    
    if (!$stmt_update->execute()) {
        throw new Exception("Update failed: " . $stmt_update->error);
    }
    
    $stmt_update->close();

    // Log thành công
    error_log("Donation saved successfully - ID: {$donation_id}, Transfer: {$transfer_content}");

    // Trả về kết quả thành công với QR code và mã chuyển khoản
    jsonResponse(true, 'Đăng ký quyên góp thành công! Vui lòng quét mã QR để hoàn tất thanh toán.', [
        'donation_id' => $donation_id,
        'transfer_content' => $transfer_content,
        'qr_image' => 'imgthuyennguyen/qr.jpg',
        'amount' => $donation_amount,
        'activity_code' => $activity_code,
        'full_name' => $full_name
    ]);

} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    jsonResponse(false, 'Đã xảy ra lỗi khi xử lý dữ liệu. Vui lòng thử lại sau.');
} finally {
    if (isset($stmt) && $stmt instanceof mysqli_stmt) {
        @$stmt->close();
    }
    if (isset($stmt_update) && $stmt_update instanceof mysqli_stmt) {
        @$stmt_update->close();
    }
    if (isset($conn) && $conn instanceof mysqli) {
        @$conn->close();
    }
}
?>
