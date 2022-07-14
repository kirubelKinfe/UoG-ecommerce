<?php 

  // Start Session
  session_start();

  define('SITURL', "http://localhost/UoG-ecommerce/AdminPage/");
  define('LOCALHOST', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define("DB_NAME", 'UoG-ecommerce');


  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); // database connection

  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //Selecting database

?>