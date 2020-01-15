<?php

include("../connection.php");

    if(isset($_GET['songId'])){
        $songId = $_GET['songId'];
        $deleteSongQuery = $pdo->prepare("DELETE FROM songs WHERE id = ?");
        $deleteSongQuery->execute([$songId]);
        header('Location: ../../mySongsList.php');
    }else{
        header('Location: mySongsList.php');
    }
?>
