<?php

$codeTrue = $_POST["codeTrue"];
$code = $_POST["code"];

if($code == $codeTrue){
    echo "true";
}else{
    echo "code incorrect";
}
?>