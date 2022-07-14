<?php include 'partials/menu.php'?>

<div class="main-content">
   <div class="wrapper">
      <h1>Update Product</h1>
      <br><br>

      <?php
$id = $_GET['id'];

$sql = "SELECT * FROM productTable WHERE product_id=$id";

$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // echo 'Product Available';
        $row = mysqli_fetch_assoc($res);

        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image'];
        $product_catagory = $row['catagory'];
    } else {
        header('location:' . SITURL . 'admin/manage-product.php');
    }
} else {

}
?>

      <form action="" method="POST">
        <div class="left-section">
          <label>Title</label>
          <input type="text" name="title" placeholder="Enter title" value=<?php echo $product_name ?>>

          <label>Price:</label>
          <input type="text" name="price" placeholder="Enter price" value=<?php echo $product_price ?>
>

          <label>Select Image:</label>
          <input type="file" name="imageFile" placeholder="Enter image path" value=<?php echo $product_image ?>>

          <label>Catagory:</label>
          <input type="text" name="catagory" placeholder="Enter catagory" value=<?php echo $product_catagory ?>>

          <input type="hidden" name="id" value=<?php echo $id ?> >
          <button type="submit" name="submit" class="btn-secondary">Update Product</button>
        </div>
      </form>

   </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // echo "button clicked";

    $id = $_GET['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $imageFile = $_POST['imageFile'];
    $catagory = $_POST['catagory'];
    
    echo $price;


    $sql = "UPDATE productTable SET product_name ='$title', product_price=$price, product_image='$imageFile', catagory='$catagory' WHERE product_id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = "<div class='success'> Product updated Succesfully</div>";
        header("location:" . SITURL . "admin/manage-product.php");
    } else {
        $_SESSION['update'] = "<div class='error'> Faild to update the Product</div>";
       echo mysqli_error($conn);
        // header("location:" . SITURL . "admin/manage-product.php");
        

    }
}
?>

<?php include 'partials/footer.php'?>