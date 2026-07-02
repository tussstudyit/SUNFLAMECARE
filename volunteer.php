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

// Hàm validate ngày sinh
function validateDateOfBirth($dob) {
    $date = DateTime::createFromFormat('Y-m-d', $dob);
    return $date && $date->format('Y-m-d') === $dob && $date <= new DateTime();
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
            // Query bảng volunteer_registrations
            $stmt = $conn->prepare("SELECT id, full_name, phone, email, status, registered_at FROM volunteer_registrations WHERE phone = ? ORDER BY registered_at DESC");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $result = $stmt->get_result();

            $volunteers = [];
            while ($row = $result->fetch_assoc()) {
                $volunteers[] = $row;
            }

            jsonResponse(true, 'Tra cứu thành công', $volunteers);

        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            jsonResponse(false, 'Có lỗi xảy ra khi tra cứu dữ liệu');
        }
    }
    // Xử lý đăng ký tình nguyện viên (chỉ cho POST)
    else if ($method === 'POST') {
        // Lấy và validate dữ liệu đăng ký tình nguyện viên
        $full_name = validateInput($data['full_name'] ?? '');
        $phone = validateInput($data['phone'] ?? '');
        $email = validateInput($data['email'] ?? '');
        $dob = validateInput($data['dob'] ?? '');
        $gender = validateInput($data['gender'] ?? '');
        $address = validateInput($data['address'] ?? '');
        $occupation = validateInput($data['occupation'] ?? '');
        $activity_type = validateInput($data['activity_type'] ?? '');
        $availability = validateInput($data['availability'] ?? '');
        $emergency_contact = validateInput($data['emergency_contact'] ?? '');
        $skills = validateInput($data['skills'] ?? '');
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

        if (empty($email)) {
            $errors[] = 'Email là bắt buộc';
        } elseif (!validateEmail($email)) {
            $errors[] = 'Email không hợp lệ';
        }

        if (empty($dob)) {
            $errors[] = 'Ngày sinh là bắt buộc';
        } elseif (!validateDateOfBirth($dob)) {
            $errors[] = 'Ngày sinh không hợp lệ';
        }

        if (empty($gender) || !in_array($gender, ['Nam', 'Nữ', 'Khác'])) {
            $errors[] = 'Giới tính không hợp lệ';
        }

        if (empty($address)) {
            $errors[] = 'Địa chỉ là bắt buộc';
        }

        if (empty($activity_type)) {
            $errors[] = 'Loại hoạt động là bắt buộc';
        }

        if (empty($availability)) {
            $errors[] = 'Thời gian tham gia là bắt buộc';
        }

        // Emergency contact và occupation là tùy chọn, không cần kiểm tra empty
        if (!empty($emergency_contact) && !validatePhone($emergency_contact)) {
            $errors[] = 'Số liên hệ khẩn cấp không hợp lệ';
        }

        if (!empty($errors)) {
            jsonResponse(false, implode(', ', $errors));
        }

        try {
            // Kiểm tra số lần đăng ký trong ngày để tránh spam
            $today = date('Y-m-d');
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM volunteer_registrations WHERE phone = ? AND DATE(registered_at) = ?");
            $stmt->bind_param("ss", $phone, $today);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] >= 3) {
                jsonResponse(false, 'Bạn đã đăng ký quá nhiều lần trong ngày. Vui lòng thử lại vào ngày mai.');
            }

            // Thêm dữ liệu vào bảng volunteer_registrations
            $stmt = $conn->prepare("INSERT INTO volunteer_registrations (full_name, phone, email, dob, gender, address, occupation, activity_type, availability, emergency_contact, skills, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
            $stmt->bind_param("ssssssssssss", $full_name, $phone, $email, $dob, $gender, $address, $occupation, $activity_type, $availability, $emergency_contact, $skills, $notes);

            if ($stmt->execute()) {
                $volunteer_id = $conn->insert_id;
                jsonResponse(true, 'Đăng ký tình nguyện viên thành công! Chúng tôi sẽ liên hệ với bạn.', ['volunteer_id' => $volunteer_id]);
            } else {
                throw new Exception("Không thể thêm dữ liệu");
            }

        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            jsonResponse(false, 'Có lỗi xảy ra khi lưu dữ liệu. Vui lòng thử lại sau.');
        }
    } else {
        // Xử lý khi truy cập trực tiếp bằng GET mà không có action=track
        jsonResponse(false, 'Đây là API xử lý đăng ký tình nguyện viên. Vui lòng gửi dữ liệu qua form hoặc sử dụng action=track để tra cứu.');
    }
} else {
    jsonResponse(false, 'Phương thức request không hợp lệ');
}
?>