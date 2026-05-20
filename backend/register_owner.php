<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = 'owner';
    $credit_limit = 0.00;

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

    $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, role, credit_limit, profile_image) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $name, $phone, $email, $password, $role, $credit_limit, $profile_image);

    if ($stmt->execute()) {
        header("Location: ../frontend/login.html?registered=owner");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
