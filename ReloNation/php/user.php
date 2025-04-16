<?php
    session_start();
    require 'connection.php';

    if (!isset($_SESSION['email'])) {
        header("Location: ../html/login.html");
        exit();
    }

    $email = $_SESSION['email'];

    $stmt = $db->prepare("SELECT `status` FROM demande WHERE `Email` = :email");
    $stmt->execute(['email' => $email]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Request Tracking</title>
    <link rel="stylesheet" href="../css/suivi.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <h1>Customer Request Tracking</h1>
        <div class="status">
            <h2>Tracking Result</h2>
            <?php  
                if ($res) {
                    if($res["status"] == 0){
                        echo "<p id='status' value='client789'>Not Yet</p>";
                    }elseif($res["status"] == 1){
                        echo "<p id='status' value='client123'>In progress</p>";
                    }else{
                        echo "<p id='status' value='client456'>Done</p>";
                    }
                } else {
                    echo "<p>No order</p>";
                }
            
            ?>
        </div>
        <div class="assistance">
            <p>For assistance, call: <a href="tel:+1234567890">+1 (234) 567-890</a></p>
        </div>
        <div class="liens">
            <button id="logoutButton"><a href="">Log Out</a></button>
            <button id="logoutButton"><a href="../home.html#page4">New Order</a></button>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/suivi.js"></script>
</body>
</html>
