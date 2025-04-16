<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'safaebakkaly@gmail.com' ) {
    header("Location:../html/login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_status'])) {
    require 'connection.php';

    $email = $_POST['email'];
    $newStatus = $_POST['new_status'];

    $stmt = $db->prepare("UPDATE demande SET `status` = :new_status WHERE `Email` = :email");
    $stmt->execute(['new_status' => $newStatus, 'email' => $email]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script>
        function updateStatus(email, newStatus) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.href = "orders.php";
                }
            };
            xhttp.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("email=" + email + "&new_status=" + newStatus);
        }
    </script>
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
        <!-- Orders content -->
        <table>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Date</th>
                <th>City</th>
                <th>Service</th>
                <th>Status</th>
                <th>Video</th>
            </tr>
            <?php
            require 'connection.php';
            $stm = $db->query("SELECT `FullName`, `Email`, `PhoneNumber`, `date`, `video`, `city`, `Service`, `status` FROM demande");
            while ($order = $stm->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                    <td>{$order['FullName']}</td>
                    <td>{$order['Email']}</td>
                    <td>{$order['PhoneNumber']}</td>
                    <td>{$order['date']}</td>
                    <td>{$order['city']}</td>
                    <td>{$order['Service']}</td>
                     <td>
                        <select  onchange=\"updateStatus('{$order['Email']}', this.value)\">
                            <option value=\"0\"";
                            if ($order['status'] == 0) echo " selected";
                            echo ">Not Yet</option>
                            <option value=\"1\"";
                            if ($order['status'] == 1) echo " selected";
                            echo ">In Progress</option>
                            <option value=\"2\"";
                            if ($order['status'] == 2) echo " selected";
                            echo ">Done</option>
                        </select>
                    </td>
                    <td><video src=\"../vedios/{$order['video']}". "\" controls></video></td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
