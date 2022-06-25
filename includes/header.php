<nav class="navbar">
      <div class="left">
        <div class="logo">
          <a href="index.php">UoG-ecommerce</a>
        </div>
        <ul>
          <li>
            <a href="men.php">Men's</a>
          </li>
          <li>
            <a href="women.php">Women's</a>
          </li>
          <li>
            <a href="mobile.php">Mobile Assesaries</a>
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