<?php

class Song{
    private $pdo;
    private $songId;
    private $fetchedData;
    private $musicianId;
    private $title;
    private $duration;
    private $year;
    private $genre;
    private $price;
    private $songFile;

    public function __construct($pdo, $songId)
    {
        $this->pdo = $pdo;
        $this->songId = $songId;

        $songQuery = $this->pdo->prepare("SELECT * FROM songs WHERE id = ?");
        $songQuery->execute([$this->songId]);
        $this->fetchedData = $songQuery->fetch();
        $this->musicianId = $this->fetchedData['musicianId'];
        $this->title = $this->fetchedData['title'];
        $this->duration = $this->fetchedData['duration'];
        $this->year = $this->fetchedData['year'];
        $this->genre = $this->fetchedData['genre'];
        $this->price = $this->fetchedData['price'];
        $this->songFile = $this->fetchedData['songFile'];
    }

    public function getTitle(){
        return $this->title;
    }

    public function getSongId(){
        return $this->songId;
    }

    public function getMusicianId(){
        return $this->musicianId;
    }

    public function getDuration(){
        return $this->duration;
    }

    public function getGenre(){
        return $this->genre;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getYear(){
        return $this->year;
    }


}