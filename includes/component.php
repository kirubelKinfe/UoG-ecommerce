<?php

function productComponent($procuctName, $procuctPrice, $productImg, $product_id, $url)
{
    echo "
    <form action=$url method='post'>
      <div class='product-item'>
          <div class='product-img'>
            <img class='thumbnail' src=$productImg alt=$procuctName />
          </div>
          <div class='product-info'>
            <div class='product-info-desc'>
              <div class='product-description'>$procuctName</div>
              <div class='product-price'>Br<span>$procuctPrice</span> </div>
            </div>
            <button type='submit' name='add' class='cart-button'>Add to cart</button>
            <label id='alert' style='color: red;
            display:none;'>Product already in the cart!</label>
            <input type='hidden' name='product_id' value=$product_id>
          </div>
      </div>
      </form>
    ";
}

function cartComponent($procuctName, $procuctPrice, $productImg, $product_id)
{
    echo "
    <form action='./cart.php?action=remove&id=$product_id' method='post'>
    
    <div class='cart-product'>
      <div class='cart-img'>
        <img src=$productImg>
      </div>
      <div class='cart-name'>$procuctName</div>
      <div class='cart-price'>Br<span id='price'>$procuctPrice</span></div>
      <input class='cart-quantity' id='quantity' type='number' value='1'>
      <div class='cart-subtotal'>Br<span id='subtotal'>$procuctPrice</span></div>
      <button type='submit' name='remove' class='remove'>X</button>
    </div>
    </form>
    ";
}

function cartSubtotal($productName, $productPrice) {
  echo "
  <div class='row'>
        <div>$productName</div>
        <div>Br<span id='payment-subtotal'>$productPrice</span></div>
      </div>";
}

function cartSession() {
  session_start();

  if (isset($_POST['add'])) {

      if (isset($_SESSION['cart'])) {

          $productArrayId = array_column($_SESSION['cart'], 'product_id');

          if (in_array($_POST['product_id'], $productArrayId)) {
              echo "<script>alert('product already in the cart!')</script>";
          } else {
              $count = count($_SESSION['cart']);
              $productArray = array(
                  'product_id' => $_POST['product_id'],
              );
              $_SESSION['cart'][$count] = $productArray;
          }
      } else {
          $productArray = array(
              'product_id' => $_POST['product_id'],
          );

          $_SESSION['cart'][0] = $productArray;
          print_r($_SESSION['cart']);

      }
  }

}