<?php

session_start();
$email = $_POST["email"];

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if(!empty($_POST['pass'])  && !empty($_POST['passConf'])){
    $pass = validate($_POST["pass"]);
    $passConf = validate($_POST["passConf"]);

    if(strlen($pass) < 8){
        echo "The password must be longer than 8 characters";
    }else if($pass !=  $passConf){
        echo "Passwords do not match";
    }else{
        try{

            include_once 'connection.php';
            $hashedData = hash('sha3-256', $pass);
            $stm = $db->prepare("UPDATE `client` SET `pwd`=:password WHERE `mail` = :email");
            $stm->bindParam(":password", $hashedData);
            $stm->bindParam(":email", $email);
            $stm->execute();
            echo "true";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}else{
    echo "Please fill out this field";
}
?>