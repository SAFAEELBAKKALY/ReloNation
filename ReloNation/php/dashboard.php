<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'safaebakkaly@gmail.com' ) {
    header("Location:../html/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="dashboard.php">Dashbord</a>
        <a href="clients.php">Clients</a>
        <a href="orders.php">Orders</a>
        <a href="messages.php">Messages</a>
        <a href="reviewsAdmin.php">Reviews</a>
        <a href="logout.php">LOG OUT</a>
    </div>
    <div class="dashboard">
        <!-- Dashboard content -->
        <div class="widget">20 members in the cleaning service</div>
        <div class="widget">20 members in the moving service</div>
        <div class="widget">Total orders 200</div>
        <div class="widget">1 chef for each service</div>
    </div>
</body>
</html>
