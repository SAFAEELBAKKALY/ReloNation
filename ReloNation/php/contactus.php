<?php
include_once "connection.php";

    $data = file_get_contents('php://input');
    $obj = json_decode($data, true);

    if ($obj) {
        $name = $obj['name'];
        $email = $obj['mail'];
        $subject = $obj['subject'];

        if (empty($name) || empty($email) || empty($subject)) {
            echo json_encode(["status" => 400, "message" => "Tous les champs sont obligatoires."]);
            exit;
        }

        $stmt = $db->prepare('INSERT INTO `message` (`name`, `email`, `content`) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $subject]);

        echo json_encode(["status" => 200, "message" => "Message envoyé avec succès !"]);
    } else {
        echo json_encode(["status" => 400, "message" => "Une erreur est survenue."]);
    }
?>
