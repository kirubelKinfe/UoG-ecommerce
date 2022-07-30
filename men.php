<?php

require_once 'includes/connection.php';
require_once 'includes/component.php';

cartSession();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UoG-ecommerce-men</title>
  <link rel="stylesheet" href="css/content.css">
  <link rel="stylesheet" href="css/navbar .css">
  <link rel="stylesheet" href="css/general.css">
</head>
<body>
  <?php require_once "includes/header.php"?>

  <div class="products-view">
        <div class="products-view-title">Men's Clothing</div>
        <div class="products-view-desc">
          Clothes and shoes for men
        </div>
        <?php
          if (isset($_SESSION['message'])) {
              echo $_SESSION['message'];
              unset($_SESSION['message']);
          }
        ?>

        <div class="products-list">
            <?php
$sql = "SELECT * FROM productTable WHERE catagory = 'men' ORDER BY product_id DESC";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $row = mysqli_num_rows($res);

    if ($row > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            productComponent($row['product_name'], $row['product_price'],$row['quantity'], $row['product_image'], $row['product_id'], './men.php');
        }
    }
}
?>
        </div>
  </div>
</body>
</html>