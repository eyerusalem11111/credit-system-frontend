<?php
header('Content-Type: application/json');
include '../db.php';

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data['user_id'];
$role = $data['role'];

if ($role === 'owner') {
    $sql = "SELECT u.name, u.email, u.credit_limit
            FROM users u
            WHERE u.role='customer'";
} else {
    $sql = "SELECT u.name, u.email, u.credit_limit
            FROM users u
            WHERE u.id = $user_id";
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
