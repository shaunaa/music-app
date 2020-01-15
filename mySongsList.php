<?php

include ("includes/header.php");
include ("includes/classes/Musician.php");
include ("includes/classes/Song.php");
$musicianClass = new Musician($pdo, $userId);
$songsIdArray = $musicianClass->getSongsId();

if($userClass->findMusicianOnly() < 0){
    header('Location: songs-list.php');
}

if(empty($songsIdArray)){
    header('Location: index.php');
}else{
    foreach($songsIdArray as $songId){
        $songClass = new Song($pdo, $songId);
        $songTitle = $songClass->getTitle();
        $songPrice = $songClass->getPrice();
    
        echo "<table>
            <thead>
                <th>Song Title</th>
                <th>Song Price</th>
            </thead>";
    
        echo "<tr>
                <td>$songTitle</td>
                <td>$songPrice</td>
                <td><a href='song-edit.php?songId=$songId'>edit |</a></td>
                <td><a href='includes/apis/api-delete-song.php?songId=$songId'> delete</a></td>
            </tr>";
        echo "</table>";
    
    
    }
}

    

?>