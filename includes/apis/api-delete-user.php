<?php

include("../connection.php");

    if(isset($_GET['userId'])){
        $userId = $_GET['userId'];
        $deleteUserQuery = $pdo->prepare("DELETE FROM users WHERE id=?");
        $deleteUserQuery->execute([$userId]);

        header('Location: ../../user-signup.php');

    }else{
        header('Location: index.php');
    }
?>
