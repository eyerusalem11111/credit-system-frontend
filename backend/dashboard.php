<?php 
include 'session.php'; 
include 'db.php';

echo "<h1>Dashboard</h1>";

if ($_SESSION['role'] === 'owner') {
    // Summary queries
    $total_customers = $conn->query("SELECT COUNT(*) AS count FROM users WHERE role='customer'")->fetch_assoc()['count'];
    $total_transactions = $conn->query("SELECT COUNT(*) AS count FROM transactions")->fetch_assoc()['count'];
    $total_credit = $conn->query("SELECT SUM(amount) AS sum FROM transactions WHERE type='credit'")->fetch_assoc()['sum'];
    $total_repayment = $conn->query("SELECT SUM(amount) AS sum FROM transactions WHERE type='repayment'")->fetch_assoc()['sum'];
    $outstanding_balance = $total_credit - $total_repayment;
    $upcoming_reminders = $conn->query("SELECT COUNT(*) AS count FROM reminders WHERE status='pending'")->fetch_assoc()['count'];

    // Summary cards
    echo "<div class='cards'>";
    echo "<div class='card'><h3>Total Customers</h3><p>$total_customers</p></div>";
    echo "<div class='card'><h3>Total Transactions</h3><p>$total_transactions</p></div>";
    echo "<div class='card'><h3>Outstanding Balance</h3><p>$outstanding_balance</p></div>";
    echo "<div class='card'><h3>Upcoming Reminders</h3><p>$upcoming_reminders</p></div>";
    echo "</div>";

    // Navigation
    echo "<ul>
            <li><a href='../frontend/add_customer.html'>➕ Add Customer</a></li>
            <li><a href='../backend/users.php'>👥 View Customers</a></li>
            <li><a href='../frontend/record_transaction.html'>💰 Record Transaction</a></li>
            <li><a href='../backend/transactions.php'>📜 Transaction History</a></li>
            <li><a href='../frontend/reports.html'>📊 Customer Reports</a></li>
            <li><a href='../frontend/add_reminder.html'>⏰ Add Reminder</a></li>
            <li><a href='../backend/reminders.php'>📅 View Reminders</a></li>
            <li><a href='../backend/logout.php'>🚪 Logout</a></li>
          </ul>";
} else {
    // Customer view
    echo "<ul>
            <li><a href='../backend/transactions.php'>📜 My Transactions</a></li>
            <li><a href='../frontend/reports.html'>📊 My Report</a></li>
            <li><a href='../backend/logout.php'>🚪 Logout</a></li>
          </ul>";
}

$conn->close();
?>

<footer>
    <h4>Powered by Credit System</h4>
    <div class="anime-banner">
        <img src="../assets/anime1.jpg" alt="Anime Visual 1">
        <img src="../assets/anime2.jpg" alt="Anime Visual 2">
        <img src="../assets/anime3.jpg" alt="Anime Visual 3">
    </div>
</footer>
