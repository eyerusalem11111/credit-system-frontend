<?php
header('Content-Type: application/json');
include '../db.php';

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data['user_id'];
$role = $data['role'];

if ($role === 'owner') {
    $sql = "SELECT t.id, u.name, t.type, t.amount, t.date
            FROM transactions t
            JOIN users u ON t.user_id = u.id
            ORDER BY t.date DESC";
} else {
    $sql = "SELECT t.id, u.name, t.type, t.amount, t.date
            FROM transactions t
            JOIN users u ON t.user_id = u.id
            WHERE t.user_id = $user_id
            ORDER BY t.date DESC";
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
