<?php
require_once 'config.php';

// Thiết lập header cho JSON response
header('Content-Type: application/json; charset=utf-8');
// Thêm header CORS để cho phép gửi từ Live Server (cổng 5500) đến PHP Server (cổng 3000)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Hàm response JSON
function jsonResponse($success, $message, $data = null) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Hàm validate input
function validateInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Hàm validate số điện thoại
function validatePhone($phone) {
    $phone = preg_replace('/\s+/', '', $phone);
    return preg_match('/^[0-9]{10,11}$/', $phone);
}

// Hàm validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Lấy phương thức request
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' || $method === 'GET') {
    $data = ($method === 'POST') ? $_POST : $_GET;

    // Xử lý action tra cứu trạng thái (cho GET)
    if (isset($data['action']) && $data['action'] === 'track') {
        $phone = validateInput($data['phone'] ?? '');

        if (empty($phone)) {
            jsonResponse(false, 'Vui lòng nhập số điện thoại');
        }

        if (!validatePhone($phone)) {
            jsonResponse(false, 'Số điện thoại không hợp lệ');
        }

        try {
            $stmt = $conn->prepare("SELECT id, item_type, quantity, unit, status, created_at FROM donation_items WHERE phone = ? ORDER BY created_at DESC");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $result = $stmt->get_result();

            $donation_items = [];
            while ($row = $result->fetch_assoc()) {
                $donation_items[] = $row;
            }

            jsonResponse(true, 'Tra cứu thành công', $donation_items);

        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            jsonResponse(false, 'Có lỗi xảy ra khi tra cứu dữ liệu');
        }
    }
    // Xử lý đăng ký quyên góp (chỉ cho POST)
    else if ($method === 'POST') {
        // Lấy và validate dữ liệu
        $full_name = validateInput($data['full_name'] ?? '');
        $phone = validateInput($data['phone'] ?? '');
        $email = validateInput($data['email'] ?? '');
        $address = validateInput($data['address'] ?? '');
        $item_type = validateInput($data['item_type'] ?? '');
        $item_description = validateInput($data['item_description'] ?? '');
        $quantity = intval($data['quantity'] ?? 0);
        $unit = validateInput($data['unit'] ?? 'cái');
        $pickup_time = validateInput($data['pickup_time'] ?? '');
        $notes = validateInput($data['notes'] ?? '');

        // Kiểm tra dữ liệu hợp lệ
        $errors = [];

        if (empty($full_name)) {
            $errors[] = 'Họ và tên là bắt buộc';
        }

        if (empty($phone)) {
            $errors[] = 'Số điện thoại là bắt buộc';
        } elseif (!validatePhone($phone)) {
            $errors[] = 'Số điện thoại không hợp lệ';
        }

        if (!empty($email) && !validateEmail($email)) {
            $errors[] = 'Email không hợp lệ';
        }

        if (empty($address)) {
            $errors[] = 'Địa chỉ là bắt buộc';
        }

        if (empty($item_type)) {
            $errors[] = 'Loại hiện vật là bắt buộc';
        }

        if ($quantity < 1) {
            $errors[] = 'Số lượng phải lớn hơn 0';
        }

        if (!empty($errors)) {
            jsonResponse(false, implode(', ', $errors));
        }

        try {
            // Kiểm tra số lần đăng ký trong ngày
            $today = date('Y-m-d');
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM donation_items WHERE phone = ? AND DATE(created_at) = ?");
            $stmt->bind_param("ss", $phone, $today);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] >= 3) {
                jsonResponse(false, 'Bạn đã đăng ký quá nhiều lần trong ngày. Vui lòng thử lại vào ngày mai.');
            }

            // Thêm dữ liệu vào bảng donation_items
            $stmt = $conn->prepare("INSERT INTO donation_items (full_name, phone, email, address, item_type, item_description, quantity, unit, pickup_time, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'received')");
            $stmt->bind_param("ssssssssss", $full_name, $phone, $email, $address, $item_type, $item_description, $quantity, $unit, $pickup_time, $notes);

            if ($stmt->execute()) {
                $donation_id = $conn->insert_id;

                // Thêm lịch sử trạng thái (comment tạm thời nếu bảng status_history chưa có)
                /*
                $stmt2 = $conn->prepare("INSERT INTO status_history (donation_id, new_status, notes) VALUES (?, 'received', 'Đăng ký quyên góp mới')");
                $stmt2->bind_param("i", $donation_id);
                $stmt2->execute();
                */

                jsonResponse(true, 'Đăng ký quyên góp thành công! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.', ['donation_id' => $donation_id]);
            } else {
                throw new Exception("Không thể thêm dữ liệu");
            }

        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            jsonResponse(false, 'Có lỗi xảy ra khi lưu dữ liệu. Vui lòng thử lại sau.');
        }
    } else {
        // Xử lý khi truy cập trực tiếp bằng GET mà không có action=track
        jsonResponse(false, 'Đây là API xử lý quyên góp. Vui lòng gửi dữ liệu qua form hoặc sử dụng action=track để tra cứu.');
    }
} else {
    jsonResponse(false, 'Phương thức request không hợp lệ');
}

?>