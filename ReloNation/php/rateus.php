<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $timestamp = date("Y-m-d H:i:s");

    $sql = "INSERT INTO review (name, rating, title, description, timestamp) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $rating, PDO::PARAM_INT);
    $stmt->bindParam(3, $title, PDO::PARAM_STR);
    $stmt->bindParam(4, $description, PDO::PARAM_STR);
    $stmt->bindParam(5, $timestamp, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: ../php/review.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->errorInfo()[2];
    }

    $stmt = null; 
}

$db = null; 
?>
