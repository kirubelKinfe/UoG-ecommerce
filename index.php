<?php

require_once 'includes/connection.php';
require_once 'includes/component.php';

cartSession();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UoG-ecommerce</title>
    <link rel="stylesheet" href="css/content.css" />
    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/navbar .css" />
  </head>
  <body>
    <div class="heading">Welcome to UoG-ecommerce!</div>
   <?php require_once 'includes/header.php'?>


    <main class="container">
      <div id="featured" class="featured-product">
        <div class="product-title">Nike</div>
        <div class="product-feature">Just Do It</div>
        <div class="product-catagory">Shoe</div>
        <button class="shop">Shop nike Shoe</button>
        <img class="product" src="img/Men/men10.png" alt="featured-shoe" />
        <div class="product-desc">
          <div class="product-desc-title">Description</div>
          <div class="product-desc-details">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
            pariatur aperiam quam laudantium maxime enim ducimus quidem nulla
            sed cum?
          </div>
        </div>
      </div>

      <div id="best-sellers" class="products-view">
        <div class="products-view-title">Best Seller Products</div>
        <div class="products-view-desc">
          Those are our best selling products this year
        </div>

        <div class="products-list">
          <?php
$sql = "SELECT * FROM productTable WHERE product_price >= 2000 and catagory = 'men'";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $row = mysqli_num_rows($res);

    if ($row > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            productComponent($row['product_name'], $row['product_price'], $row['product_image'], $row['product_id'], './index.php');
        }
    }
}
?>
     
<?php
$sql = "SELECT * FROM productTable WHERE product_price < 800 and catagory = 'women'";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $row = mysqli_num_rows($res);

    if ($row > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            productComponent($row['product_name'], $row['product_price'], $row['product_image'], $row['product_id'], './index.php');
        }
    }
}
?>

<?php
$sql = "SELECT * FROM productTable WHERE product_price >= 60000 and catagory = 'mobile'";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $row = mysqli_num_rows($res);

    if ($row > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            productComponent($row['product_name'], $row['product_price'], $row['product_image'], $row['product_id'], './index.php');
        }
    }
}
?>
        </div>
      </div>

      <div id="catagories" class="catagories">
        <div class="catagories-title">Catagories</div>
        <div class="catagories-desc">
          You have got 3 catagories to choose from
        </div>
        <div class="catagories-view">
          <a href="men.php">
            <div class="catagorie">
              <img class="thumbnail" src="img/Men/men8.jpg" alt="" />
              <div class="men-catagorie">Men's</div>
          </div>
        </a>
        <a href="women.php">
          <div class="catagorie">
            <img class="thumbnail" src="img/Women/women2.jpg" alt="" />
            <div class="men-catagorie">Women's</div>
          </div>
        </a>
        <a href="mobile.php">
          <div class="catagorie">
            <img class="thumbnail" src="img/MobileAssesories/mobile2.jpeg"/>
            <div class="men-catagorie">Mobile Assesaries</div>
          </div>
        </div>
        </a>
        
      </div>

      

      <footer class="footer">
        <div class="copyright">&copy; 2022 UoG ecommerce</div>
        <div class="social-medias"></div>
      </footer>
    </main>
  </body>
</html>
