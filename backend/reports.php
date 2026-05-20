<?php
session_start();
include '../frontend/navbar.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reports</title>
  <link rel="stylesheet" href="../frontend/style.css"> <!-- global style -->
</head>
<body>
  <h2>Reports</h2>
  <?php
  if ($_SESSION['role'] === 'owner') {
      $sql = "SELECT u.name, u.email, u.credit_limit
              FROM users u
              WHERE u.role='customer'";
  } else {
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT u.name, u.email, u.credit_limit
              FROM users u
              WHERE u.id = $user_id";
  }

  $result = $conn->query($sql);

  echo "<table>
          <tr><th>Name</th><th>Email</th><th>Credit Limit</th></tr>";

  if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".$row['name']."</td>
                  <td>".$row['email']."</td>
                  <td>".$row['credit_limit']."</td>
                </tr>";
      }
  } else {
      echo "<tr><td colspan='3'>No reports found</td></tr>";
  }
  echo "</table>";

  $conn->close();
  ?>
  <footer><h4>Powered by Credit System</h4></footer>
</body>
</html>
