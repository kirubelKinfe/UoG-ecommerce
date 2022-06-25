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
  <title>UoG-ecommerce-mobile-assesaries</title>
  <link rel="stylesheet" href="css/content.css">
  <link rel="stylesheet" href="css/navbar .css">
  <link rel="stylesheet" href="css/general.css">
</head>
<body>
  <?php require_once "includes/header.php"?>

  
  <div class="products-view">
        <div class="products-view-title">Mobile Assesaries</div>
        <div class="products-view-desc">
          mobile assesaries like earphone, charger and leatest phones
        </div>

        <div class="products-list">
            <?php
$sql = "SELECT * FROM productTable WHERE catagory = 'mobile'";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $row = mysqli_num_rows($res);

    if ($row > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            productComponent($row['product_name'], $row['product_price'], $row['product_image'], $row['product_id'], './mobile.php');
        }
    }
}
?>
        </div>
  </div>
</body>
</html>