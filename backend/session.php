<?php
session_start();

// If user is not logged in, redirect to login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../frontend/login.html");
    exit();
}

// Function to enforce role-based access
function requireRole($role) {
    if ($_SESSION['role'] !== $role) {
        echo "<p>Access denied. You must be an $role to view this page.</p>";
        exit();
    }
}
?>
