<?php 
  require_once ("../config/constants.php");

  if(!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div class='errorLogin'>Please login to access Admin Panel</div>";

    header('location:'.SITURL.'admin/');
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>admin</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
  <!-- Menu section starts -->
  <div class="menu">
      <h1>UoG-ecommerce</h1>
      <ul>
        <li><a href="manage-admin.php">Admin</a></li>
        <li><a href="manage-product.php">Products</a></li>
        <li><a href="manage-order.php">Orders</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
  </div>
  <!-- Menu section ends -->