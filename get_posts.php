<?php
session_start();

// Kiểm tra session
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$conn = new mysqli('127.0.0.1', 'root', '', 'users_db', 3306);


// Kiểm tra kết nối cơ sở dữ liệu
if (!$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT p.*, u.name, u.avatar FROM post p JOIN user u ON p.user_id = u.id WHERE p.user_id = ? ORDER BY p.created_at DESC";
$stmt = $conn->prepare($sql);

// Kiểm tra prepare
if (!$stmt) {
    echo json_encode(['error' => 'Failed to prepare statement']);
    $conn->close();
    exit();
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra kết quả truy vấn
if ($result === false) {
    echo json_encode(['error' => 'Failed to get posts']);
    $stmt->close();
    $conn->close();
    exit();
}

$posts = $result->fetch_all(MYSQLI_ASSOC);

// Lấy bình luận cho từng bài đăng
foreach ($posts as $index => $post) {
    $post_id = $post['id'];
    $sql_comments = "SELECT c.*, u.name AS commenter_name, u.avatar AS commenter_avatar 
                     FROM comments c 
                     JOIN user u ON c.user_id = u.id 
                     WHERE c.post_id = ? 
                     ORDER BY c.created_at ASC";
    $stmt_comments = $conn->prepare($sql_comments);

    if (!$stmt_comments) {
        echo json_encode(['error' => 'Failed to prepare comments statement']);
        $stmt->close();
        $conn->close();
        exit();
    }

    $stmt_comments->bind_param("i", $post_id);
    $stmt_comments->execute();
    $result_comments = $stmt_comments->get_result();

    if ($result_comments === false) {
        echo json_encode(['error' => 'Failed to get comments']);
        $stmt_comments->close();
        $stmt->close();
        $conn->close();
        exit();
    }

    $posts[$index]['comments'] = $result_comments->fetch_all(MYSQLI_ASSOC);
    $stmt_comments->close();
}

header('Content-Type: application/json');
echo json_encode($posts);

$stmt->close();
$conn->close();
?>