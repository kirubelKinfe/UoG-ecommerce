
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
    <nav class="navbar">
      <div class="left">
        <div class="logo">
          <a href="index.php">UoG-ecommerce</a>
        </div>
        <ul>
          <li>
            <a href="#home" id="h">Home</a>
          </li>
          <li>
            <a href="#featured">Featured</a>
          </li>
          <li>
            <a href="#best-sellers">Best Sellers</a>
          </li>
          <li>
            <a href="#catagories">Catagories</a>
          </li>
          
        </ul>
      </div>

      <a class="cart" href="cart.php">
          <img src="img/cart.png" />
          <?php 
            if(isset($_SESSION['cart'])) {
              $count = count($_SESSION['cart']);
              echo "<div class='cart-count'>$count</div>";
            } else {
              echo "<div class='cart-count'>0</div>";
            }
          ?>
          
      </a>
  </nav>
  <a name='home'></a>

   <div class="banner">
    <div>
      <p>Welcome to UoG-ecommerce</p>
     <h1>Shopping Time</h1>
     <h3>Ontime Delivery</h3>
     <a href="#catagory"><button class="btn-catagories" role="button">Check Catagories</button></a>
    </div>
    <img class="banner-image" src="img//banner-image.png">
    
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
   <a name='featured'></a>
   <div class='products-view-title'>Featured Product</div>
      <div class='products-view-desc'>
           This is the best product of this year
      </div>
      <main class='container'>
      <form action='index.php' method='post'>
        <div id='featured' class='featured-product'>
          <div class='product-title'>$product_name</div>
        <div class='product-feature'>Just Do It</div>
        <div class='product-catagory'>Shoe</div>
          <button type='submit' name='add' class='featured-button'>Add to cart</button>
          <input type='hidden' name='product_id' value=$product_id>
          <img class='product' src='img/$product_image'alt='featured-shoe' />
          <div class='product-desc'>
          <div class='product-desc-title'>Description</div>
          <div class='product-desc-details'>
            Get laced up for training, sport and lifestyle with the latest designs 
            of men's shoes and sneakers from Nike.com.
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
        <a name="best-sellers"></a>
        <div class="products-view">
        <div class="products-view-title">Best Seller Products</div>
        <div class="products-view-desc">
          Those are our best selling products this year
        </div>
        <div class="products-list">
     
<?php
$sql = "SELECT * FROM productTable WHERE buy_count > 10 ORDER BY product_id DESC";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $row = mysqli_num_rows($res);

    if ($row > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            productComponent($row['product_name'], $row['product_price'], $row['quantity'], $row['product_image'], $row['product_id'], './index.php');
        }
    }
}

?>
        </div>
      </div>

      <a name="catagories"></a>
      <div class="catagories">
        <a name='catagory'></a>
        <div class="catagories-title">Catagories</div>
        <div class="catagories-desc">
          You have got 3 catagories to choose from
        </div>
        <div class="catagories-view">
          <a href="men.php">
            <div class="catagorie">
              <img class="thumbnail" src="img/14a71799-5888-4676-a3b3-6e61a0faef67.jpeg" alt="" />
              <div class="men-catagorie">Men's</div>
          </div>
        </a>
        <a href="women.php">
          <div class="catagorie">
            <img class="thumbnail" src="img/women5.jpg" alt="" />
            <div class="men-catagorie">Women's</div>
          </div>
        </a>
        <a href="electronics.php">
          <div class="catagorie">
            <img class="thumbnail" src="img/electronics31.jpg"/>
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
