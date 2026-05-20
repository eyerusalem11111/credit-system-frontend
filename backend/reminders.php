<?php
session_start();
include '../frontend/navbar.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reminders</title>
  <link rel="stylesheet" href="../frontend/style.css">
</head>
<body>
  <h2>Reminders</h2>
  <?php
  if ($_SESSION['role'] === 'owner') {
      $sql = "SELECT r.id, u.name, r.message, r.due_date, r.status
              FROM reminders r
              JOIN users u ON r.user_id = u.id
              ORDER BY r.due_date DESC";
  } else {
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT r.id, u.name, r.message, r.due_date, r.status
              FROM reminders r
              JOIN users u ON r.user_id = u.id
              WHERE r.user_id = $user_id
              ORDER BY r.due_date DESC";
  }

  $result = $conn->query($sql);

  echo "<table>
          <tr><th>ID</th><th>User</th><th>Message</th><th>Due Date</th><th>Status</th></tr>";

  if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".$row['id']."</td>
                  <td>".$row['name']."</td>
                  <td>".$row['message']."</td>
                  <td>".$row['due_date']."</td>
                  <td>".$row['status']."</td>
                </tr>";
      }
  } else {
      echo "<tr><td colspan='5'>No reminders found</td></tr>";
  }
  echo "</table>";

  $conn->close();
  ?>
  <footer><h4>Powered by Credit System</h4></footer>
</body>
</html>
