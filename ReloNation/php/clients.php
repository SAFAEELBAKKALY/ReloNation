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
    <title>Clients</title>
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
    <div class="content">
        <!-- Clients content -->
        <table>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
            </tr>
            <?php
            require 'connection.php';
            $stm = $db->query("SELECT nomClt, mail, pwd FROM client");
            while ($client = $stm->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                    <td>{$client['nomClt']}</td>
                    <td>{$client['mail']}</td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
