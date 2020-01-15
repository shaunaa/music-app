<?php
session_start();
$dsn = "mysql:host=localhost;dbname=music_app_2019;charset=utf8mb4";
$options = [
  PDO::ATTR_EMULATE_PREPARES   => false, 
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
];
try {
  $pdo = new PDO($dsn, "root", "", $options);
} catch (Exception $e) {
  error_log($e->getMessage());
  exit('The connection was lost'); 
}