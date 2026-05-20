<?php
session_start();
include '../frontend/navbar.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Users</title>
  <link rel="stylesheet" href="../frontend/style.css">
</head>
<body>
  <h2>Users</h2>
  <?php
  if ($_SESSION['role'] === 'owner') {
      // Owners see all users
      $sql = "SELECT id, name, email, phone, role, profile_image FROM users ORDER BY role, name";
      $result = $conn->query($sql);

      echo "<table>
              <tr><th>ID</th><th>Profile</th><th>Name</th><th>Email</th><th>Phone</th><th>Role</th></tr>";

      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $imgPath = !empty($row['profile_image']) ? $row['profile_image'] : '../assets/default.png';
              echo "<tr>
                      <td>".$row['id']."</td>
                      <td><img src='".$imgPath."' alt='Profile' style='width:50px;height:50px;border-radius:50%;'></td>
                      <td>".$row['name']."</td>
                      <td>".$row['email']."</td>
                      <td>".$row['phone']."</td>
                      <td>".$row['role']."</td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='6'>No users found</td></tr>";
      }
      echo "</table>";
  } else {
      // Customers see only their own profile
      $userId = $_SESSION['user_id'];
      $sql = "SELECT id, name, email, phone, role, credit_limit, profile_image 
              FROM users WHERE id='$userId'";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $imgPath = !empty($row['profile_image']) ? $row['profile_image'] : '../assets/default.png';

          echo "<div style='max-width:400px;margin:auto;text-align:center;'>
                  <img src='".$imgPath."' alt='Profile' style='width:100px;height:100px;border-radius:50%;'>
                  <h3>".$row['name']."</h3>
                  <p>Email: ".$row['email']."</p>
                  <p>Phone: ".$row['phone']."</p>
                  <p>Role: ".$row['role']."</p>
                  <p>Credit Limit: ".$row['credit_limit']."</p>
                </div>";
      } else {
          echo "<p>No profile found.</p>";
      }
  }

  $conn->close();
  ?>
  <footer><h4>Powered by Credit System</h4></footer>
</body>
</html>
