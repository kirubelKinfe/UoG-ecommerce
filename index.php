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

   <div class="banner">
    <div>
      <p>Trade-in-offer</p>
     <h1>Shopping Time</h1>
     <h3>Ontime Delivery</h3>
     <a href="#catagory"><button>Check Catagories </button></a>
    </div>
    <img class="banner-image" src="img/banner-image.png">
   </div>

<?php
$sql = "SELECT * FROM productTable WHERE featured = true";
$res = mysqli_query($conn, $sql);
$val = mysqli_fetch_array($res);

$product_id = $val['product_id'];
$product_name = $val['product_name'];
$product_price = $val['product_price'];
$product_image = $val['product_image'];
  echo "
   <div class='products-view-title'>Featured Product</div>
      <div class='products-view-desc'>
           This is the best product of this year
      </div>
      <br><br>
      <main class='container'>
      <form action='index.php' method='post'>
        <div id='featured' class='featured-product'>
          <div class='product-title'>Nike</div>
        <div class='product-feature'>$product_name</div>
        <div class='product-catagory'>Shoe</div>
          <button type='submit' name='add' class='cart-button'>Add to cart</button>
          <input type='hidden' name='product_id' value=$product_id>
          <img class='product' src='img/$product_image'alt='featured-shoe' />
          <div class='product-desc'>
          <div class='product-desc-title'>Description</div>
          <div class='product-desc-details'>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
            pariatur aperiam quam laudantium maxime enim ducimus quidem nulla
            sed cum?
          </div>
        </div>
        </div>
        
      </form>
  "
?>          
        
<?php
          if (isset($_SESSION['message'])) {
              echo $_SESSION['message'];
              unset($_SESSION['message']);
          }
        ?>
        <div id="best-sellers" class="products-view">
        <div class="products-view-title">Best Seller Products</div>
        <div class="products-view-desc">
          Those are our best selling products this year
        </div>
        <div class="products-list">
     
<?php
$sql = "SELECT * FROM productTable WHERE buy_count > 10";
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
        <a name='catagory'></a>
        <div class="catagories-title">Catagories</div>
        <div class="catagories-desc">
          You have got 3 catagories to choose from
        </div>
        <div class="catagories-view">
          <a href="men.php">
            <div class="catagorie">
              <img class="thumbnail" src="img/men5.jpg" alt="" />
              <div class="men-catagorie">Men's</div>
          </div>
        </a>
        <a href="women.php">
          <div class="catagorie">
            <img class="thumbnail" src="img/women1.jpg" alt="" />
            <div class="men-catagorie">Women's</div>
          </div>
        </a>
        <a href="electronics.php">
          <div class="catagorie">
            <img class="thumbnail" src="img/electronics37.jpg"/>
            <div class="men-catagorie">Electronics</div>
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
