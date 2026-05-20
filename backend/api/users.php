<?php
header('Content-Type: application/json');
include '../db.php';

$data = json_decode(file_get_contents("php://input"), true);
$role = $data['role'];

$response = [];

if ($role === 'owner') {
    $sql = "SELECT id, name, email, phone, role FROM users ORDER BY role, name";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Access denied';
}

echo json_encode($response);
$conn->close();
?>
