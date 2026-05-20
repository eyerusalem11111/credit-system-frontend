<?php
session_start();
include '../frontend/navbar.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Transactions</title>
  <link rel="stylesheet" href="../frontend/style.css">
</head>
<body>
  <h2>Transactions</h2>
  <?php
  if ($_SESSION['role'] === 'owner') {
      $sql = "SELECT t.id, u.name, t.type, t.amount, t.date
              FROM transactions t
              JOIN users u ON t.user_id = u.id
              ORDER BY t.date DESC";
  } else {
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT t.id, u.name, t.type, t.amount, t.date
              FROM transactions t
              JOIN users u ON t.user_id = u.id
              WHERE t.user_id = $user_id
              ORDER BY t.date DESC";
  }

  $result = $conn->query($sql);

  echo "<table>
          <tr><th>ID</th><th>Customer</th><th>Type</th><th>Amount</th><th>Date</th></tr>";

  if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".$row['id']."</td>
                  <td>".$row['name']."</td>
                  <td>".$row['type']."</td>
                  <td>".$row['amount']."</td>
                  <td>".$row['date']."</td>
                </tr>";
      }
  } else {
      echo "<tr><td colspan='5'>No transactions found</td></tr>";
  }
  echo "</table>";

  $conn->close();
  ?>
  <footer><h4>Powered by Credit System</h4></footer>
</body>
</html>
