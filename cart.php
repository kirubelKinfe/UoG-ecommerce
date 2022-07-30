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

if(isset($_POST['submit'])){
  $first_name =$_POST['firstName'];
  $last_name = $_POST['lastName'];
  $city = $_POST['city'];
  $street = $_POST['street'];
  $phone_number = $_POST['phoneNumber'];
  $totalField = $_POST['total'];
  $radio_status = '';

$selected_radio = $_POST['pay'];

if ($selected_radio == 'as received') {

    $radio_status = 'as received';

} else if ($selected_radio == 'to bank') {

    $radio_status = 'to bank';

}


  if (isset($_SESSION['cart'])) {
    $count = 0;
    $product_id = array_column($_SESSION['cart'], 'product_id');
    $sql = "SELECT * FROM productTable ORDER BY product_id DESC";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $rows = mysqli_num_rows($res);
        if ($rows > 0) {
            $orders = '';
            while ($rows = mysqli_fetch_assoc($res)) {
                foreach ($product_id as $id) {
                    if ($rows['product_id'] == $id) {
                        $newQuantity = $rows['quantity'];
                        $quantity = $_POST['quan' . $count++];
                        if($newQuantity < $quantity) {
                          $_SESSION['orders'] = "<div class='danger'>Ordered Quantity Not Available!</div>";
                          echo("<script>alert('Ordered quantiry doesn't exist')</script>");
                          header("location: cart.php");
                          die;
                        }
                        $newQuantity -= $quantity;
                        $sql3 = "UPDATE productTable SET quantity = $newQuantity, buy_count = $rows[buy_count] + $quantity WHERE product_id = $id";
                        $res3 = mysqli_query($conn, $sql3);

                        $orders = $orders . "Ordered Product " . $rows['product_name'] . " Quantity " . $quantity. " ";
                    }
                }
            }
            $sql4 = "INSERT INTO transactionTable(firstName, lastName, city, street, phoneNumber,paymentType,orders,total) VALUES ( '$first_name', '$last_name', '$city', '$street', '$phone_number','$radio_status', '$orders', '$totalField')";
            $res4 = mysqli_query($conn, $sql4);
        }
    } else {
        echo "<h5>Cart is Empty</h5>";
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
    <?php
    if(isset($_SESSION['orders'])) {
      echo $_SESSION['orders'];
      unset($_SESSION['orders']);
    }
    ?>
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
          $sql = "SELECT * FROM productTable ORDER BY product_id DESC";
          $res = mysqli_query($conn, $sql);
          if ($res == true) {
              $rows = mysqli_num_rows($res);
              if ($rows > 0) {
                  while ($rows = mysqli_fetch_assoc($res)) {
                      foreach ($product_id as $id) {
                          if ($rows['product_id'] == $id) {
                              cartComponent($rows['product_name'], $rows['product_price'],$rows['quantity'], $rows['product_image'], $rows['product_id']);
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
    
    <form action="cart.php" method="POST" name="form" onsubmit="return formValidation()">
      <div class="payment-container">
        <div class="left-section">
          <h3>Billing Details</h3>
          <div class="name">
            <div>
              <label>First Name</label>
              <input type="text" name="firstName">
            </div>
            <div>
              <label>Last Name</label>
              <input type="text" name="lastName">
            </div>
          </div>
          <label>Country</label>
          <input type="text" name="country" placeholder="ET" readonly>
          <label>City</label>
          <input type="text" name="city">
          <label>Street</label>
          <input type="text" name="street">
          <label>Phone Number</label>
          <input type="number" name="phoneNumber">
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
              $sql = "SELECT * FROM productTable ORDER BY product_id DESC";
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
            <input type="text" id='total'value='0' name='total' readonly>
          </div>
          <div class="payment-section">
            <div>
              <input type="radio" name='pay' value="as received" checked> Pay as you receive <br>
            </div>
            <div>
              <input type="radio" name='pay' value="to bank"> Pay directly to bank
            </div>
            <div class="order-product">
              <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy.</a></p>
              <textarea cols='30' rows='10' style='display: none' id='orders' name='orders'></textarea>
              <div id='quans'></div>
            </div>
            <button type="submit" name="submit" class="place-order">Place Order</button>
            </div>       
          </div>     
        </div>
      </div>
    </form>  
   
  </main>

   <script>
    const price = document.querySelectorAll('#price');
    const product_name = document.querySelectorAll('#product_name');
    const subtotal = document.querySelectorAll('#subtotal');
    const paymentSubtotal = document.querySelectorAll('#payment-subtotal');
    const quantity = document.querySelectorAll('#quantity');
    const total = document.querySelector('#total');
    const orders = document.querySelector('#orders');

    let counter = 1;
    let order = '';
    let sum = 0;
    let input = '';
    let product = '';
    let quantityArray = [''];

    for(var i = 0; i < quantity.length; i++) {
      var quan = quantity[i].value;
      var ord = product_name[i].innerText;
      var res =  subtotal[i].innerText;
      order += 'Ordered item ' + ord + ' ' + ' Ordered quantity ' + quan + '\n';
      quantityArray = new Array();

      input = document.createElement('input');
      input.type ='hidden';
      input.name = 'quan'+i;
      input.id = 'quan'+i;
      input.value = quan;
      quantityArray.push(quantity[i].value);

      document.getElementById('quans').appendChild(input);
       sum += Number(res);
    }
    console.log(quantityArray);

    total.value = 'Br'+ sum;
    orders.value = order;

    quantity.forEach((item, index)=> {
        item.addEventListener('change', ()=>{
            var ord = product_name[index].innerText;
            subtotal[index].innerHTML = price[index].innerHTML * item.value;
            paymentSubtotal[index].innerHTML = price[index].innerHTML * item.value;
            let sum = 0;
            subtotal.forEach((value)=> {
                let res =  value.innerText;
                sum += Number(res);
            })
            total.value = 'Br' + sum;
            counter = item.value;
            order = ' Ordered item ' + ord + ' ' + ' Ordered quantity ' + counter + '\n';
              document.getElementById('quan'+index).value = counter;
            
            if(orders.value.indexOf(ord) == -1) {
              orders.value += order;
            } else {
              if(orders.value.indexOf(ord) > order.length) {
                 const newValue = orders.value.replace(String(orders.value.slice(0, -1)),String(counter));
                 const subString = orders.value.substring(0, (orders.value.length - order.length));
                 orders.value = subString + '\n'+ 'Ordered item '+ord+' '+' Ordered quantity '+newValue;
              }
              if(orders.value.indexOf(ord) > 0 && orders.value.indexOf(ord) < 40) {
                orders.value = orders.value.replace(String((counter - 1)),String(counter));
              }
            }
        });

        
    });


  



    
    
   
    
  function formValidation() {

      var message = null;

      for (var i = 0; i < 10; i++) {
            if ( document.form.phoneNumber.value.length != 10 ||  document.form.phoneNumber.value.charAt(0) != 0 ||
            document.form.phoneNumber.value.charAt(1) != 9){
               message = "please enter a valid Phone Number ";
               
            }
      }

      if(document.form.firstName.value == "") {
        alert("please enter First Name")
        return false;
      }
      else if(document.form.lastName.value == "") {
        alert("please enter Last Name")
        return false;
      }
      else if(document.form.city.value == "") {
        alert("please enter City")
        return false;
      }
      else if(document.form.street.value == "") {
        alert("please enter  Street")
        return false;
      }
      else if(document.form.phoneNumber.value == "") {
        alert("please enter Phone Number")
        return false;
      } else if(message != null) {
        alert(message);
        return false;
      }
}
   </script>
  
</body>
</html>
