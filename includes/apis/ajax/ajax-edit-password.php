<?php


include("../../connection.php");

if(!isset($_POST['username'])){
    echo 'ERROR: username not set';
    exit();
}

if(!isset($_POST['oldPass']) || !isset($_POST['newPass1']) || !isset($_POST['newPass2'])){
    echo 'Not all passwords have been set';
    exit();
}

if($_POST['oldPass'] == '' || $_POST['newPass1'] == '' || $_POST['newPass2'] == ''){
    echo 'Please set all fields';
    exit();
}

$username = $_POST['username'];
$oldPass = md5($_POST['oldPass']);
$newPass1 = $_POST['newPass1'];
$newPass2 = $_POST['newPass2'];

$passwordExistQuery = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$passwordExistQuery->execute([$username,$oldPass]);
$rows = $passwordExistQuery->fetchAll();
$num_rows = count($rows);
if($num_rows != 1){
    echo 'The old password is incorect';
    exit();
}


if($newPass1 != $newPass2){
    echo 'Your passwords do not match';
    exit();
}

if(strlen($newPass1) < 10 || strlen($newPass1) > 75){
    echo 'Your password should be bewteen 10 and 75 characters';
    exit();
}

$newPassEncr = md5($newPass1);

$updatePassword = $pdo->prepare("UPDATE users SET password = ? WHERE username = ? ");
$updatePassword->execute([$newPassEncr, $username]);

if($updatePassword){
    echo 'your password have been updated';
}
?>