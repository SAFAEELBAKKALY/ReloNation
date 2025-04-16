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
    <title>Reviews</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>Reviews</h2>
        <a href="dashboard.php">Dashbord</a>
        <a href="clients.php">Clients</a>
        <a href="orders.php">Orders</a>
        <a href="messages.php">Messages</a>
        <a href="reviewsAdmin.php">Reviews</a>
        <a href="logout.php">LOG OUT</a>
    </div>
    <div class="content">
        <!-- messages content -->
        <table>
            <tr>
                <th>Name</th>
                <th>Rating</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
            <?php
            require 'connection.php';
            $stm = $db->query("SELECT  `name`, `rating`, `title`, `description`, `timestamp` FROM `review`");
            while ($message = $stm->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$message['name']}</td>
                        <td>{$message['rating']}</td>
                        <td>{$message['title']}</td>
                        <td>{$message['description']}</td>
                        <td>{$message['timestamp']}</td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
