<?php
session_start();
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(!empty($_POST['email'])  && !empty($_POST['password'])){

        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array("err" => "Invalid email format", "success" => ""));
        }else {
            try{
                include_once 'connection.php';
                $hashedData = hash('sha3-256', $password);
                $stm = $db->prepare("SELECT * FROM `client` WHERE `mail`=:email AND `pwd`=:password");
                $stm->bindParam(":email", $email);
                $stm->bindParam(":password", $hashedData);
                $stm->execute();
                $result = $stm->fetchAll();

                if(count($result) <= 0){
                    echo json_encode(array("err" => "Password or email incorrect", "success" => ""));
                }else{
                    $_SESSION['email'] = $email;
                    $obj = array();
                    if ($email == 'safaebakkaly@gmail.com' && $password == 'sfisfa2001') {
                        echo json_encode(array("err" => "", "success" => "admin"));
                    }else{
                        echo json_encode(array("err" => "", "success" => "user"));
                    }

                }
                
                  
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
  
}else{
    echo json_encode(array("err" => "Please fill out all the fields!", "success" => ""));
}




