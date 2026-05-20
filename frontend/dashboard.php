<?php
session_start();
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2 style="text-align:center; margin-top:20px;">
    Welcome, <?php echo $_SESSION['name']; ?>
  </h2>

  <?php if ($_SESSION['role'] === 'owner') { ?>
    <p style="text-align:center;">Owner dashboard: manage users, view all reports, and track transactions.</p>
  <?php } else { ?>
    <p style="text-align:center;">Customer dashboard: view your reports and transactions.</p>
  <?php } ?>
</body>
</html>
