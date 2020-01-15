<?php

class Musician{
    private $cpdoon;
    private $musicianId;
    private $fetchedData;
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;

    public function __construct($pdo, $musicianId)
    {
        $this->pdo = $pdo;
        $this->musicianId = $musicianId;

        $musicianQuery = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $musicianQuery->execute([$this->musicianId]);
        $this->fetchedData = $musicianQuery->fetch();
        $this->firstName = $this->fetchedData['firstName'];
        $this->lastName = $this->fetchedData['lastName'];
        $this->email = $this->fetchedData['email'];
        $this->phoneNumber = $this->fetchedData['phoneNumber'];
    }

    public function getFirstName(){
        return $this->firstName;   
    }

    public function getLastName(){
        return $this->lastName;   
    }

    public function getEmaile(){
        return $this->email;   
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;   
    }

    public function getSongsId(){

        $songsQuery = $this->pdo->prepare("SELECT id FROM songs WHERE musicianId = ?");
        $songsQuery->execute([$this->musicianId]);
        $result = $songsQuery->fetchAll();

        $songArray = array();
        foreach($result as $song){
            array_push($songArray, $song['id']);
        }
        return $songArray;
    }
}