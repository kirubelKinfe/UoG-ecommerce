<?php
require_once 'includes/connection.php';
require_once 'includes/component.php';

cartSession();
if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
    <link rel="stylesheet" href="css/navbar .css" />
    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/cart.css" />
  </head>
  <body>
    <?php require_once "includes/header.php"?>


   <main class="container">
    <h1>Order Now!</h1>
    <div class="cart-list">
      <div class="cart-title">
        <div class="product-title">Product</div>
        <div class="price-title">Price</div>
        <div class="quntity-title">Quantity</div>
        <div class="remove-title">Remove</div>
      </div>

<?php
$total = 0;
if (isset($_SESSION['cart'])) {
    $product_id = array_column($_SESSION['cart'], 'product_id');
    $sql = "SELECT * FROM productTable";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $rows = mysqli_num_rows($res);
        if ($rows > 0) {
            while ($rows = mysqli_fetch_assoc($res)) {
                foreach ($product_id as $id) {
                    if ($rows['product_id'] == $id) {
                        cartComponent($rows['product_name'], $rows['product_price'], $rows['product_image'], $rows['product_id']);
                        $total = $total + (int) $rows['product_price'];

                    }
                }
            }
        }
    }
} else {
    echo "<h5>Cart is Empty</h5>";
}

?>
    </div>
   </main>
  </body>
</html>
