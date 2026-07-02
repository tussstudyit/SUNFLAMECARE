<?php
header('Content-Type: application/json');
$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : '';
$last_id = isset($_GET['last_id']) ? $_GET['last_id'] : 0;
$conn = new mysqli('127.0.0.1', 'root', '', 'users_db', 3306);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

$query = "
    SELECT m.*, u.name, u.avatar 
    FROM messages m
    JOIN user u ON m.user_id = u.id
    WHERE m.group_id = ?
    ORDER BY m.timestamp ASC
";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $group_id);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($messages);
$stmt->close();
$conn->close();
?>