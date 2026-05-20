<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'register') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, role, credit_limit) VALUES (?, ?, ?, ?, ?, ?)");
        $credit_limit = ($role === 'customer') ? 1000.00 : 0.00;
        $stmt->bind_param("sssssd", $name, $phone, $email, $hashedPassword, $role, $credit_limit);

        if ($stmt->execute()) {
            echo "Registration successful. <a href='../frontend/auth.html'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

    } elseif ($action === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'owner') {
                    header("Location: ../frontend/dashboard.php");
                } else {
                    header("Location: ../frontend/reports.php");
                }
                exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
        }
        $stmt->close();
    }
}
$conn->close();
?>
