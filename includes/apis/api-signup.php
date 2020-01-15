<?php

function cleanTextInput($inputValue){
    $inputValue = strip_tags($inputValue);
    $inputValue = str_replace(" ", "", $inputValue);
    $inputValue = strtolower($inputValue);

    return $inputValue;
}


function cleanPasswordInput($pass){
    $pass = strip_tags($pass);

    return $pass;
}

function returnPreviousValue($value){
    if(isset($_POST[$value])){
        echo $_POST[$value];
    }
}

if(isset($_POST['signupButton'])){
    $username = cleanTextInput($_POST['signupUsername']);
    $email1 = cleanTextInput($_POST['signupEmail1']);
    $email2 = cleanTextInput($_POST['signupEmail2']);
    $firstName = cleanTextInput($_POST['firstName']);
    $lastName = cleanTextInput($_POST['lastName']);
    $cpr = cleanPasswordInput($_POST['cpr']);
    $address = cleanPasswordInput($_POST['address']);
    $phoneNumber = cleanTextInput($_POST['phoneNumber']);
    $password1 = cleanPasswordInput($_POST['signupPassword1']);
    $password2 = cleanPasswordInput($_POST['signupPassword2']);
    
    if(isset($_POST['isMusician'])){
        $isMusician = 1;
    }else{
        $isMusician = 0;
    }
    

    if($validationClass->validateAllSignup($username,$email1,$email2,$firstName,$lastName,$cpr,$address,$phoneNumber,$password1,$password2,$isMusician)){
        $_SESSION['username'] = $username;
        header('Location: index.php');
    }else{
        echo 'There were a problem with the validation of your user details. Please try again!';
    }

}