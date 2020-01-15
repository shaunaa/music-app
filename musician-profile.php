<?php
include ("includes/header.php");
include("includes/classes/Musician.php");
include("includes/classes/Song.php");

if(isset($_GET['musicianId'])){
    $musicianId = $_GET['musicianId'];
    $findMusicianInUsers = $pdo->prepare("SELECT id FROM users WHERE id=?"); 
    $findMusicianInUsers->execute([$musicianId]);
    $rows = $findMusicianInUsers->fetchAll();
    $num_rows = count($rows);
    if($num_rows > 0){
        $musicianClass = new Musician($pdo,$musicianId);
        $musicianFirstName = $musicianClass->getFirstName();
        $musicianLastName = $musicianClass->getLastName();
        $musicianEmail = $musicianClass->getEmaile();
        $musicianPhone = $musicianClass->getPhoneNumber();
    
        echo "
            Musician First name: $musicianFirstName<br>
            Musician Last name: $musicianLastName<br>
            Musician Email address: $musicianEmail<br>
            Musician Phone Number: $musicianPhone<br>
        ";
    
        $songIdArray = $musicianClass->getSongsId();
    
        foreach($songIdArray as $songId){
            $songClass = new Song ($pdo,$songId);
            $songTitle = $songClass->getTitle();
            $songPrice = $songClass->getPrice();
            $songId = $songClass->getSongId();
            echo "Song Title: $songTitle<br>
                    Song Price: $songPrice";
            echo "<a href='buy.php?id=".$songId."'><button>BUY</button></a><br>";
        }
    }else{   
        echo "
            Musician: The musician doesn't exists anymore.<br>
        ";

        $musicianClass = new Musician($pdo,$musicianId);
        $songIdArray = $musicianClass->getSongsId();
        foreach($songIdArray as $songId){
            $songClass = new Song ($pdo,$songId);
            $songTitle = $songClass->getTitle();
            $songPrice = $songClass->getPrice();
            $songId = $songClass->getSongId();
            echo "Song Title: $songTitle<br>
                    Song Price: $songPrice";
            echo "<a href='buy.php?id=".$songId."'><button>BUY</button></a><br>";
        }
    }
  
}else{
    header('Location: songs-list.php');
}



?>
