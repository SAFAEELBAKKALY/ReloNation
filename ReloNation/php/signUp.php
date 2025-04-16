<?php
$nbrErr =0;
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(!empty($_POST['name'])  && !empty($_POST['email'])  && !empty($_POST['password'])  && !empty($_POST['passwordConf'])){
    
        $fullname = validate($_POST['name']);
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);
        $passwordConf = validate($_POST['passwordConf']);
    
        // validate password
        if(strlen($password) < 8){
            $nbrErr++;
            echo "Password must be longer than 8 characters";
        }else if($password !=  $passwordConf){
            $nbrErr++;
            echo "Passwords do not match";
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //validate email
            $nbrErr++;
            echo "Invalid email format";
        }else{
            try{
                include_once 'connection.php';
                $stm = $db->prepare("SELECT * FROM `client` WHERE mail=:email");
                $stm->bindParam(":email", $email);
                $stm->execute();
    
                if($stm->rowCount() >0){
                    $nbrErr++;
                    echo "Email already exist!";
                }
                
    
                //insert data of client
    
                if($nbrErr<=0){
                    $hashedData = hash('sha3-256', $password);
                    $stm = $db->prepare("INSERT INTO `client` (nomClt, mail, pwd) VALUES(:fullname, :email, :password)");
                    $stm->bindParam(":fullname", $fullname);
                    $stm->bindParam(":email", $email);
                    $stm->bindParam(":password", $hashedData);
                    $stm->execute();
    
                    echo "true";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
}else{
    echo "Please fill out all the fields!";
}


