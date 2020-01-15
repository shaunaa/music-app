<?php
    if(isset($_POST['editSong'])){

        $songId = $_POST['songId'];
        $songTitle = cleanSongInput($_POST['songTitle']);
        $songPrice = cleanSongInput($_POST['songPrice']);
    
        if($songValidationClass->validateUpdateSong($songTitle,$songPrice)){

           $songUpdateQuery = $pdo->prepare("UPDATE songs SET title = ?, price = ? WHERE id = ?");
           $songUpdateQuery->execute([$songTitle,$songPrice,$songId]);

           if($songUpdateQuery){
               echo 'song was successfully updated!';
           }else{
               echo 'There was a problem with updating your song details. Please try again!';
           }
        }  
    }

    function cleanSongInput($input){
        $inputValue = strip_tags($input);
    
        return $inputValue;
    }



?>