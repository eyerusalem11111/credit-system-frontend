<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name         = $_POST['name'];
    $phone        = $_POST['phone'];
    $email        = $_POST['email'];
    $credit_limit = $_POST['credit_limit'];
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handle profile image upload
    $profile_image = null;
    if (!empty($_FILES['profile_image']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES['profile_image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
            $profile_image = "uploads/" . $fileName;
        }
    }

    $stmt = $conn->prepare("INSERT INTO users (name, role, phone, email, credit_limit, password, profile_image)
                            VALUES (?, 'customer', ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdss", $name, $phone, $email, $credit_limit, $password, $profile_image);

    if ($stmt->execute()) {
        header("Location: ../frontend/login.html?registered=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
