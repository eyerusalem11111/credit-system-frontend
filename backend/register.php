<?php
// backend/register.php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO customers (name, email, password) VALUES ('$name','$email','$password')";
    mysqli_query($conn, $sql);
    $message = "Customer registered successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Registration</title>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:linear-gradient(135deg,#4facfe,#00f2fe);">

  <div style="margin:60px auto; width:350px; padding:20px; background:#fff; border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,0.2); text-align:center;">
    <h2 style="margin-bottom:20px; color:#333;">Customer Registration</h2>
    <?php if(isset($message)) echo "<p style='color:green;'>$message</p>"; ?>
    <form method="POST">
      <label style="display:block; text-align:left; margin-bottom:5px;">Name:</label>
      <input type="text" name="name" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">
      
      <label style="display:block; text-align:left; margin-bottom:5px;">Email:</label>
      <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">
      
      <label style="display:block; text-align:left; margin-bottom:5px;">Password:</label>
      <input type="password" name="password" required style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:4px;">
      
      <button type="submit" style="background:#0066cc; color:#fff; border:none; padding:12px; width:100%; border-radius:6px; cursor:pointer;">Register</button>
    </form>
  </div>

  <footer style="margin-top:40px; padding:20px; text-align:center; background:rgba(0,0,0,0.3); color:#fff;">
    © 2026 Credit System Project
  </footer>
</body>
</html>
