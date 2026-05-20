<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

include("../db.php");

// Read JSON body from Flutter
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

$response = [];

if (empty($email) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Missing credentials"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Accept both plain text and hashed passwords
    if ($password === $user['password'] || password_verify($password, $user['password'])) {
        $response = [
            "status" => "success",
            "user" => [
                "id" => $user['id'],
                "name" => $user['name'],
                "role" => $user['role']
            ]
        ];
    } else {
        $response = ["status" => "error", "message" => "Invalid password"];
    }
} else {
    $response = ["status" => "error", "message" => "User not found"];
}

echo json_encode($response);
$conn->close();
?>
