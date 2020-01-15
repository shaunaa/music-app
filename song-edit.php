<?php
include ("includes/header.php");
include ("includes/classes/SongValidation.php");
include ("includes/classes/Song.php");
$songValidationClass = new SongValidation($pdo);

include ("includes/apis/api-edit-song.php");

if($userClass->findMusicianOnly() < 0){
    header('Location: songs-list.php');
}

if(isset($_GET['songId'])){
    $songId = $_GET['songId'];
    $songClass = new Song($pdo,$songId);
    $songTitle = $songClass->getTitle();
    $songPrice = $songClass->getPrice();

    $validateUserAndSongQuery = $pdo->prepare("SELECT * FROM songs WHERE id = ? AND musicianId = ?");
    $validateUserAndSongQuery->execute([$songId, $userId]);
    $rows = $validateUserAndSongQuery->fetchAll();
    $num_rows = count($rows);
    if($num_rows > 0){

    ?>
    <form method="post">
        <div class="errorMessage">
                <?php if(!empty($songValidationClass->errorArray)){
                            echo $songValidationClass->errorArray[0];
                        } 
                ?>
            </div>
        <input type="hidden" name="songId" value="<?php echo $songId ?>">
        <input type="text" name="songTitle" placeholder="song title" value="<?php echo $songTitle; ?>">
        <input type="text" name="songPrice" placeholder="song price" value="<?php echo $songPrice; ?>">
        <input type="submit" name="editSong" value="Edit">
    </form>
    <?php
    }else{
        header('Location: index.php');
    }
}else{
    header('Location: mySongsList.php');
}
?>
