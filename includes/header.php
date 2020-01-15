<?php
include ("includes/connection.php");
include ("includes/classes/User.php");

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $userClass = new User($pdo,$username);
    $userId = $userClass->getUserId();
    echo "<script>let username ='$username';</script>";
}else{
  print_r($_SESSION);
  echo 'not working';
    header('Location: user-signup.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/styles/style.css">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/scripts/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">All songs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search.php">Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user-settings.php">Profile Settings</a>
      </li>
     
      <?php
      if($userClass->findMusicianOnly() > 0){
      ?>
      <li class="nav-item">
        <a class="nav-link" href="mySongsList.php">My songs</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="song-upload.php">Upload song</a>
      </li>
      <?php
    }
      ?>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log out</a>
      </li>

    </ul>
  </div>
</nav>