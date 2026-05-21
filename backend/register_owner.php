<?php
// backend/register_owner.php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO owners (username, email, password) VALUES ('$username','$email','$password')";
    if (mysqli_query($conn, $sql)) {
        $message = "Owner registered successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Owner Registration</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:linear-gradient(135deg,#4facfe,#00f2fe);">

  <div style="margin:60px auto; width:350px; padding:20px; background:#fff; border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,0.2); text-align:center;">
    <h2 style="margin-bottom:20px; color:#333;">Owner Registration</h2>
    <?php if(isset($message)) echo "<p style='color:green;'>$message</p>"; ?>
    <form method="POST">
      <label for="username" style="display:block; text-align:left; margin-bottom:5px;">Username:</label>
      <input type="text" id="username" name="username" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">

      <label for="email" style="display:block; text-align:left; margin-bottom:5px;">Email:</label>
      <input type="email" id="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">

      <label for="password" style="display:block; text-align:left; margin-bottom:5px;">Password:</label>
      <input type="password" id="password" name="password" required style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:4px;">

      <button type="submit" style="background:#0066cc; color:#fff; border:none; padding:12px; width:100%; border-radius:6px; cursor:pointer;">Register Owner</button>
    </form>
  </div>

  <footer style="margin-top:40px; padding:20px; text-align:center; background:rgba(0,0,0,0.3); color:#fff;">
    © 2026 Credit System Project
  </footer>
</body>
</html>
