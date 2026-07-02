<?php
// Bắt đầu session (nếu cần)
session_start();

// Kết nối cơ sở dữ liệu
include 'config.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Lấy tham số lọc nếu có (activity_code và transfer_content)
$activityCode = isset($_GET['activity_code']) ? $_GET['activity_code'] : '';
$transferContent = isset($_GET['transfer_content']) ? $_GET['transfer_content'] : '';

// Xây dựng câu truy vấn SQL
$sql = "SELECT id, activity_code, transfer_content, amount, full_name, email, created_at FROM donations";
if ($activityCode !== '' || $transferContent !== '') {
    $sql .= " WHERE 1=1";
    if ($activityCode !== '') {
        $sql .= " AND activity_code = '$activityCode'";
    }
    if ($transferContent !== '') {
        $sql .= " AND transfer_content = '$transfer_content'";
    }
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table id='donationsTable'><tr><th>Id</th><th>Mã hoạt động</th><th>Mã chuyển khoản</th><th>Số tiền</th><th>Họ và tên</th><th>Gmail</th><th>Thời gian</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>" . htmlspecialchars($row['id']) . "</td>
            <td>" . htmlspecialchars($row['activity_code']) . "</td>
            <td>" . htmlspecialchars($row['transfer_content']) . "</td>
            <td>" . number_format($row['amount'], 2) . "</td>
            <td>" . htmlspecialchars($row['full_name']) . "</td>
            <td>" . htmlspecialchars($row['email']) . "</td>
            <td>" . htmlspecialchars($row['created_at']) . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<table id='donationsTable'><tr><td colspan='7'>Không có dữ liệu</td></tr></table>";
}

mysqli_close($conn);
?>