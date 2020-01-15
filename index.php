<?php
    include ("includes/header.php");
    include("includes/classes/Musician.php");
?>

<h1>songs</h1>
<div>
    <?php

        $songQuery = $pdo->prepare("SELECT * FROM songs");
        $songQuery->execute();
        $songsArray = $songQuery->fetchAll();
        
        foreach($songsArray as $song){
            echo "<p>song title: ".$song['title']."</p>";
            echo "<p>song duration: ".$song['duration']."</p>";
            echo "<p>song price: ".$song['price']."</p>";
                
    
            $musicianId = $song['musicianId'];
            $musicianClass = new Musician($pdo, $musicianId);
            $musicianFirstName = $musicianClass->getFirstName();
            $musicianLastName = $musicianClass->getLastName();
            echo "<a href='musician-profile.php?musicianId=".$musicianId."'>musician: ".$musicianFirstName." ".$musicianLastName."</a>";
            echo "<a href='buy.php?id=".$song['id']."'><button>BUY</button></a><br>";
            echo "<br><br>";
        }

    ?>
</div>