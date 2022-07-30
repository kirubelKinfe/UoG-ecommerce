<?php include 'partials/menu.php'?>

<?php
if (isset($_POST['submit'])) {
    // echo "button clicked";

    $id = $_GET['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $imageFile = $_POST['file'];
    $catagory = $_POST['catagory'];
    $selected = '';

    if ($catagory == 'men') {

        $selected = 'men';

    } else if ($catagory == 'women') {

        $selected = 'women';

    } else if ($catagory == 'electronics') {

        $selected = 'electronics';

    }

    $radio_status = 0;

    $selected_radio = $_POST['featured'];

    if ($selected_radio == 'yes') {

        $radio_status = 1;

    } else if ($selected_radio == 'no') {

        $radio_status = 0;

    }

    $sql = "UPDATE productTable SET product_name ='$title', product_price=$price, product_image='$imageFile', catagory='$selected', quantity='$quantity', featured=$radio_status WHERE product_id=$id";

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
        $quantity = $row['quantity'];
        $product_image = $row['product_image'];
        $product_catagory = $row['catagory'];
    } else {
        header('location:' . SITURL . 'admin/manage-product.php');
    }
} else {

}
?>

      <form action="" method="POST" name="form" onsubmit="return formValidation()">
        <div class="left-section">
          <label>Title</label>
          <input type="text" name="title" placeholder="Enter title" value=<?php echo $product_name ?>>

          <label>Price:</label>
          <input type="text" name="price" placeholder="Enter price" value=<?php echo $product_price ?>>

          <label>Quantity:</label>
          <input type="number" name="quantity" placeholder="Enter quantity" value=<?php echo $quantity ?>>


         <label>Catagory:</label>
          <select class="catagory-option" name="catagory">
            <option value="men"<?=$row['catagory'] == 'men' ? ' selected="selected"' : '';?>>Men</option>
            <option value="women"<?=$row['catagory'] == 'women' ? ' selected="selected"' : '';?>>Women</option>
            <option value="electronics"<?=$row['catagory'] == 'electronics' ? ' selected="selected"' : '';?>>Electronics</option>
          </select>
          


          <input type="hidden" name="file" value='<?php echo($product_image) ?>'>
          <label>Featured:</label>
          <span>
            <input type="radio" name='featured' value="yes">Yes
          
            <input type="radio" name='featured' value="no" checked>No
          </span>

          <input type="hidden" name="id" value=<?php echo $id ?> >
          <button type="submit" name="submit" class="btn-secondary">Update Product</button>
        </div>
      </form>

   </div>
   <script>
   function formValidation() {
      if(document.form.title.value == "") {
        alert("please enter product name")
        return false;
      }
      else if(document.form.price.value == "") {
        alert("please enter Price")
        return false;
      }
      else if(document.form.file.value == "") {
        alert("please enter image")
        return false;
      }
    
       
    }
   </script>
</div>
