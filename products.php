<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UoG-ecommerce-products</title>
    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/navbar .css" />
    <link rel="stylesheet" href="css/products.css">
  </head>
  <body>

    <nav class="navbar">
      <div class="left">
        <div class="logo"><a href="index.php">UoG-ecommerce</a></div>
        <ul>
          <li>
            <a href="#" class="catagory">Catagory</a>
          </li>
          <li>
            <a href="#" class="best-selling">Best Sellers</a>
          </li>
        </ul>
      </div>

      <a class="cart" href="cart.php">
          <img src="img/cart.png" />
          <div class="cart-count">3</div>
      </a>
    </nav>

    <main class="container">
      <div class="product-view">
        <div class="product-img-view">
          <div class="product-img selected">
            <img src="img/headphone.png">
          </div>
          <div class="img-wrapper">
            <div class="product-img">
              <img src="img/headphone.png">
            </div>
            <div class="product-img">
              <img src="img/headphone.png">
            </div>
            <div class="product-img">
              <img src="img/headphone.png">
            </div>
            <div class="product-img">
              <img src="img/headphone.png">
            </div>
          </div>
          
        </div>
        <div class="product-description-view">
          <div class="product-title">boAt Immortal 1000D</div>
          <div class="product-rating"></div>
          <div class="product-details-title">Details:</div>
          <div class="product-details-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, quas praesentium! Dolores, nemo placeat? Cum quo aperiam magnam adipisci, molestiae atque quia architecto! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam ducimus nemo vero provident quae voluptatem, voluptatum quisquam distinctio nesciunt molestias.</div>
          <div class="product-price">$50</div>
          <div class="product-quantity">
            <div class="quantity">Quantity: </div>
            <div class="minus box">-</div>
            <div class="value box">1</div>
            <div class="plus box">+</div>
          </div>
          <div class="buttons">
            <button class="cart-button">Add to cart</button>
            <button class="buy-button">Buy now</button>
          </div>
        </div>
      </div>

    </main>
  </body>
</html>
