<?php

class SongValidation {
    public $errorArray;
    public $pdo;

    public function __construct($pdo)
    {
        $this->errorArray = array();
        $this->pdo = $pdo;
    }

    
    public function validateUpdateSong($title,$price){
        $this->validateTitle($title);
        $this->validatePrice($price);

        if(empty($this->errorArray)){
            return true;
        }
    }

    public function validateAllSongAttributes($uniqueSongName,$title,$duration,$year,$genre,$price,$musicianId){
        $this->validateTitle($title);
        $this->validateDuration($duration);
        $this->validateYear($year);
        $this->validateGenre($genre);
        $this->validatePrice($price);

        if(empty($this->errorArray)){
            return true;
        }

    }

    private function validateTitle($title){
        if(strlen($title) < 2 || strlen($title) > 250){
            array_push($this->errorArray,'The title should be between 2 and 250 characters!');
            return;
        }
    }

    private function validateDuration($duration){
        $durationPattern = '/^[\d]{2}[:]{1}[\d]{2}$/';
        if(!preg_match($durationPattern,$duration)){
            array_push($this->errorArray,'The duration should be in this format 00:00');
            return;
        }
    }

    private function validateYear($year){
        $yearPattern = '/^[\d]{4}$/';
        if(!preg_match($yearPattern,$year)){
            array_push($this->errorArray,'The year should be only 4 DIGITS');
            return;
        }
        if($year < 1900 || $year > 2100){
            array_push($this->errorArray,'The year should be between 1900 and 2100');
            return;
        }
    }

    private function validateGenre($genre){
        $genrePattern = '/^[a-z]{2,70}$/';
        if(!preg_match($genrePattern,$genre)){
            array_push($this->errorArray,'The genre should contain only between 2 and 70 letters');
            return;
        }
    }
    
    private function validatePrice($price){
        $pricePattern = '/^[\d]{1,3}$/';
        if(!preg_match($pricePattern,$price)){
            array_push($this->errorArray,'The price should be betwenn 0 to 999 dkk');
            return;
        }
    }

}