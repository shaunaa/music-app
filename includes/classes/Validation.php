<?php

class Validation{
    public $errorArray;
    public $pdo;

    public function __construct($pdo)
    {
        $this->errorArray = array();
        $this->pdo = $pdo;
        
    }

    public function login($username,$password){
        $encrPass = md5($password);

        $loginQuery = $this->pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $loginQuery->execute([$username, $encrPass]);
        $rows = $loginQuery->fetchAll();
        $num_rows = count($rows);
        if($num_rows > 0){
            return $loginQuery;
        }else{
            array_push($this->errorArray,'Wrong username or password');
        }

    }


    public function validateAllSignup($username,$email1,$email2,$fName,$lName,$cpr,$address,$phoneNumber,$pass1,$pass2,$isMusician){
        $this->validateUsername($username);
        $this->validateEmail($email1,$email2);
        $this->validateFName($fName);
        $this->validateLName($lName);
        $this->validateCpr($cpr);
        $this->validateAddress($address);
        $this->validatePhoneNumber($phoneNumber);
        $this->validatePassword($pass1,$pass2);
       

        if(empty($this->errorArray)){
            $dateOfCreation = date("Y-m-d h:i:sa");
            $encrPass = md5($pass1);
            
            $query = $this->pdo->prepare("INSERT INTO users VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->execute(['',$username,$email1,$fName,$lName,$encrPass,$dateOfCreation,$address,$phoneNumber,'',$cpr,$isMusician,'']);

            return $query;
        }

    }

    private function validateUsername($username){

        $usernameQuery = $this->pdo->prepare("SELECT username FROM users WHERE username = ?");
        $usernameQuery->execute([$username]);
        $rows = $usernameQuery->fetchAll();
        $num_rows = count($rows);
        if($num_rows > 0){
            array_push($this->errorArray, 'The username already exists');
            return;
        }
        

       if(strlen($username) < 2 || strlen($username) > 25){
           array_push($this->errorArray,'Your username should be between 2 and 25 characters!');
           return;
       }
    }

    private function validatePhoneNumber($phoneNumber){
        $phonePattern = '/^[\d]{8}$/';
        if(!preg_match($phonePattern,$phoneNumber)){
            array_push($this->errorArray,'Your phone number should be only 8 DIGITS');
            return;
        }
    }

    private function validateCpr($cpr){
        $cprPattern = '/^[\d]{6}[-]{1}[\d]{4}$/';
        if(!preg_match($cprPattern,$cpr)){
            array_push($this->errorArray,'Your CPR input should look like 220396-0466');
            return;
        }
    }

    private function validateAddress($address){
        if(strlen($address) < 2 || strlen($address) > 500){
            array_push($this->errorArray,'Your address should be between 2 and 500 characters!');
            return;
        }
    }

    private function validateEmail($email1, $email2){

        $emailQuery = $this->pdo->prepare("SELECT email FROM users WHERE email = ?");
        $emailQuery->execute([$email1]);
        $rows = $emailQuery->fetchAll();
        $num_rows = count($rows);
        if($num_rows > 0){
            array_push($this->errorArray, 'The email already exists');
            return;
        }

        if($email1 != $email2){
            array_push($this->errorArray,'Emails do not match!');
            return;
        }

        if(!filter_var($email1, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray,'Please enter a valid email!');
            return;
        }

        if(strlen($email1) < 2 || strlen($email1) > 50 ){
            array_push($this->errorArray,'Your email should be between 2 and 50 characters!');
            return;
        }
   
    }

    private function validateFName($fName){
        if(is_numeric($fName)){
            array_push($this->errorArray,'Your first name should contain only letters!');
            return;
        }

        if(strlen($fName) < 2 || strlen($fName) > 50){
            array_push($this->errorArray,'Your first name should be between 2 and 50 characters!');
            return;
        }
    }

    private function validateLName($lName){
        if(is_numeric($lName)){
            array_push($this->errorArray,'Your last name should contain only letters!');
            return;
        }

        if(strlen($lName) < 2 ||strlen($lName) > 70){
            array_push($this->errorArray,'Your last name should be between 2 and 70 characters!');
            return;
        }
    }

    private function validatePassword($pass1,$pass2){
        if($pass1 != $pass2){
            array_push($this->errorArray,'Your passwords do not match');
            return;
        }

        if(strlen($pass1) < 10 || strlen($pass1) > 75){
            array_push($this->errorArray,'Your password should be bewteen 10 and 75 characters');
            return;
        }

    }
}