<?php
include ("includes/header.php");
include ("includes/classes/SongValidation.php");
$songValidationClass = new SongValidation($pdo);

include ("includes/apis/api-upload-song.php");

if($userClass->findMusicianOnly() < 0){
    header('Location: songs-list.php');
}
?>
  

    <form enctype="multipart/form-data" method="post">
        <div class="errorMessage">
            <?php if(!empty($songValidationClass->errorArray)){
                        echo $songValidationClass->errorArray[0];
                    } 
            ?>
        </div>
        <p>
            <input type="file" name="song">
        </p>

        <p>
            <label>song title</label>
            <input type="text" name="songTitle">
        </p>

        <p>
            <label>Song duration</label>
            <input type="text" name="songDuration">
        </p>

        <p>
            <label>Year of the song</label>
            <input type="text" name="songYear">
        </p>

        <p>
            <label>Genre of the song</label>
            <input type="text" name="songGenre">
        </p>

        <p>
            <label>Price of the song</label>
            <input type="text" name="songPrice">
        </p>
        <input type="submit" name="uploadSong" value="upload">
    </form>
</body>
</html>