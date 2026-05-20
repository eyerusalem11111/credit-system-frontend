<?php
header('Content-Type: application/json');
include '../db.php';

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$phone = $data['phone'];
$email = $data['email'];
$password = $data['password'];
$role = $data['role'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$credit_limit = ($role === 'customer') ? 1000.00 : 0.00;

$stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, role, credit_limit) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssd", $name, $phone, $email, $hashedPassword, $role, $credit_limit);

$response = [];

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Registration successful';
} else {
    $response['status'] = 'error';
    $response['message'] = $stmt->error;
}

echo json_encode($response);
$stmt->close();
$conn->close();
?>
