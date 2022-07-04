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
        <div class="subtotal">Subtotal</div>
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
    }else {
    echo "<h5>Cart is Empty</h5>";
}
} 

?>
    </div>
    <div class="payment-container">
    <div class="left-section">
      <h3>Billing Details</h3>
      <div class="name">
        <div>
          <label for="firstName">First Name</label>
          <input type="text" name="firstName">
        </div>
        <div>
          <label for="lastName">Last Name</label>
          <input type="text" name="lastName">
        </div>
      </div>
      <label for="country">Country</label>
      <input type="text" name="country" placeholder="ET" readonly>
      <label for="city">City</label>
      <input type="text" name="city">
      <label for="street">Street</label>
      <input type="text" name="street">
      <label for="phoneNumber">Phone Number</label>
      <input type="text" name="phoneNumber">
    </div>
    <div class="right-section">
        <h3>Your Order</h3>
      <div class="row">
        <h3>Product</h3>
        <h3>Subtotal</h3>
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
                        cartSubtotal($rows['product_name'], $rows['product_price']);
                        $total = $total + (int) $rows['product_price'];

                    }
                }
            }
        }
    } else {
        echo "<h5>Cart is Empty</h5>";
    }
}
?>
      <div class="row">
        <h4>Total</h4>
        <h4 id='total'>0</h4>
      </div>
      <div class="payment-section">
        <div>
          <input type="radio" name='pay' value="Pay as you receive" checked> Pay as you receive <br>
        </div>
        <div>
          <input type="radio" name='pay' value="Pay directly to bank"> Pay directly to bank
        </div>
        <div class="order-product">
          <div>
          Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy</a> 
        </div>
        <button type="submit" name="order" class="place-order">Place Order</button>
        </div>
        
      </div>
      
    </div>
  </div>

   </main>

   <script>
    const price = document.querySelectorAll('#price');
    const subtotal = document.querySelectorAll('#subtotal');
    const paymentSubtotal = document.querySelectorAll('#payment-subtotal');
    const quantity = document.querySelectorAll('#quantity');
    const total = document.querySelector('#total');
    let sum = 0;
    subtotal.forEach((value)=> {
        let res =  value.innerText;
        sum += Number(res);
    })
    console.log(sum);
    total.innerText = 'Br'+sum;


    quantity.forEach((item, index)=> {
        item.addEventListener('change', ()=>{
            subtotal[index].innerHTML = price[index].innerHTML * item.value;
            paymentSubtotal[index].innerHTML = price[index].innerHTML * item.value;
            let sum = 0;
            subtotal.forEach((value)=> {
                let res =  value.innerText;
                sum += Number(res);
            })
            console.log(sum);
            total.innerText = 'Br' + sum;
        });
    });
   
    
    console.log(price);
    console.log(subtotal);
    console.log(quantity);
    console.log(total);
   </script>
  </body>
</html>
