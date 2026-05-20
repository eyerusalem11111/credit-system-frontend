<?php
// Always start session so role is available
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav style="background: linear-gradient(90deg, #4a90e2, #50c9c3); padding: 10px; display: flex; justify-content: center; gap: 20px;">
  <?php if ($_SESSION['role'] === 'owner') { ?>
    <a href="dashboard.php">Dashboard</a>
    <a href="reports.php">Reports</a>
    <a href="../backend/transactions.php">Transactions</a>
    <a href="../backend/users.php">Users</a>
    <a href="../backend/reminders.php">Reminders</a>
  <?php } else { ?>
    <a href="reports.php">Reports</a>
    <a href="../backend/transactions.php">Transactions</a>
    <a href="../backend/reminders.php">Reminders</a>
  <?php } ?>
  <a href="../backend/logout.php">Logout</a>
</nav>
