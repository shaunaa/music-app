<?php

class User{
    private $pdo;
    private $username;
    private $fetchedData;
    private $email;
    private $id;
    private $isMusician;
    private $firstName;

    public function __construct($pdo,$username)
    {
        $this->pdo = $pdo;
        $this->username = $username;

        $userQuery = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $userQuery->execute([$this->username]);
        $this->fetchedData = $userQuery->fetch();
        $this->email = $this->fetchedData['email'];
        $this->id = $this->fetchedData['id'];
        $this->isMusician = $this->fetchedData['isMusician'];
        $this->firstName = $this->fetchedData['firstName'];

    }

    public function getUserId(){
        return $this->id;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getUsername(){
       return $this->username;
    }

    public function findMusicianOnly(){
        return $this->isMusician;
     }
}