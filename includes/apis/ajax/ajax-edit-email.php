<?php
include("../../connection.php");

if(!isset($_POST['username'])){
    echo 'ERROR: username not set';
    exit();
}

if(isset($_POST['email']) && $_POST['email'] != ''){
    $username = $_POST['username'];
    $userEmail = $_POST['email'];

    if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
        echo 'Email is invalid';
        exit();
    }

    $checkEmailIfExists = $pdo->prepare("SELECT email FROM users WHERE email = ? AND username != ?");
    $checkEmailIfExists->execute([$userEmail,$username]);
    $rows = $checkEmailIfExists->fetchAll();
    $num_rows = count($rows);
    if($num_rows > 0){
        echo 'Email already exists';
        exit();
    }

   $updateEmailQuery = $pdo->prepare("UPDATE users SET email = ? WHERE username = ? ");
   $updateEmailQuery->execute([$userEmail, $username]);
    
    if($updateEmailQuery){
        echo 'update was successful';
    }else{
        echo 'not suces';
    }
}else{
    echo 'provide an email';
}
?>