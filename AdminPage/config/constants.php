<?php 

  // Start Session
  session_start();

  define('SITURL', "http://localhost/UoG-ecommerce/AdminPage/");
  $LOCALHOST= 'localhost';
  $DB_USERNAME= 'root';
  $DB_PASSWORD= '';
  $DB_NAME= 'UoG-ecommerce';




  $conn = mysqli_connect($LOCALHOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME) or die(mysqli_error($conn)); 


?>