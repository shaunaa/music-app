<?php
function cleanUserInput($inputValue){
    $inputValue = strip_tags($inputValue);
    return $inputValue;
}

if(isset($_POST['loginButton'])){
    $username = cleanUserInput($_POST['loginUsername']);
    $password = cleanUserInput($_POST['loginPassword']);

    if($validationClass->login($username,$password)){
        $_SESSION['username'] = $username;
        header('Location: index.php');
    }
}