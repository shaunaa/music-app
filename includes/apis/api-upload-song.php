<?php

if(isset($_POST['uploadSong'])){
    if($userClass->findMusicianOnly() > 0){
        
        $songExtention = pathinfo($_FILES['song']['name'], PATHINFO_EXTENSION);

        if($songExtention == 'mp3'){
            $uniqueSongName = uniqid().'.'.$songExtention;
            $songTitle = cleanSongInput($_POST['songTitle']);
            $songDuration = cleanSongInput($_POST['songDuration']);
            $songYear = cleanSongInput($_POST['songYear']);
            $songGenre = cleanSongInput($_POST['songGenre']);
            $songPrice = cleanSongInput($_POST['songPrice']);

    
            if($songValidationClass->validateAllSongAttributes($uniqueSongName,$songTitle,$songDuration,$songYear,$songGenre,$songPrice,$userId)){
               
       
               move_uploaded_file($_FILES['song']['tmp_name'],__DIR__."../../songs/$uniqueSongName");

               $songQuery = $pdo->prepare("INSERT INTO songs VALUE (?,?,?,?,?,?,?,?)");
               $songQuery->execute(['',$userId,$songTitle,$songDuration,$songYear,$songGenre,$songPrice,$uniqueSongName]);
               
               if($songQuery){
                   echo 'song was succesfully uploaded';
               }else{
                   echo 'your song was not uploaded. Please try again!';
                }
            }else{
                echo "something went wrong with song's atributes validation and we could not upload your song";
            }
    
        }
    }else{
        echo 'Only users registered as musicians can upload music';
    }


  

}

function cleanSongInput($input){
    $inputValue = strip_tags($input);

    return $inputValue;
}