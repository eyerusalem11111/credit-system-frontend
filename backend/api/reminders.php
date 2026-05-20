<?php
header('Content-Type: application/json');
include '../db.php';

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data['user_id'];
$role = $data['role'];

if ($role === 'owner') {
    $sql = "SELECT r.id, u.name, r.message, r.due_date, r.status
            FROM reminders r
            JOIN users u ON r.user_id = u.id
            ORDER BY r.due_date DESC";
} else {
    $sql = "SELECT r.id, u.name, r.message, r.due_date, r.status
            FROM reminders r
            JOIN users u ON r.user_id = u.id
            WHERE r.user_id = $user_id
            ORDER BY r.due_date DESC";
}

$result = $conn->query($sql);
$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

echo json_encode($response);
$conn->close();
?>
