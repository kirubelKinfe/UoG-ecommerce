<?php include "partials/menu.php"?>

 <!-- Main section starts -->
<div class="main-content">
   <div class="wrapper">
      <h1>Add Product</h1>
      <br><br>
      <form action="" method="POST">
        <div class="left-section">
          <label>Title</label>
          <input type="text" name="title" placeholder="Enter title">

          <label>Price:</label>
          <input type="text" name="price" placeholder="Enter price">

          <!-- <label>Catagory:</label>
          <input type="text" name="catagory" placeholder="Enter catagory"> -->

          <!-- <label>Select Image:</label>
          <input type="text" name="imageFile" placeholder="Enter image path"> -->
          <label>Catagory:</label>
          <select class="catagory-option" name="catagory">
            <option value="men">Men</option>
            <option value="women">Women</option>
            <option value="electronics">Electronics</option> 
          </select>
          

          <label>Select Image:</label>
          <input type="file" name="file" value="">
          <label>Featured:</label>
          <span>
            <input type="radio" name='featured' value="yes">Yes
          
            <input type="radio" name='featured' value="no" checked>No
          </span>

          

          <button type="submit" name="submit" class="btn-control">Add Product</button>
        </div>
      </form>
   </div>
</div>
 <!-- Main section ends -->
<?php include "partials/footer.php"?>

<?php
//Process the value from form and save it in database

  if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $imageFile = $_POST['file'];
    $catagory = $_POST['catagory'];

    $selected= '';


    if ($catagory == 'men') {

        $selected = 'men';

    } else if ($catagory == 'women') {

        $selected = 'women';

    } else if ($catagory == 'electronics') {

        $selected = 'electronics';

    }

    $radio_status = '';

    $selected_radio = $_POST['featured'];

    if ($selected_radio == 'yes') {

        $radio_status = true;

    } else if ($selected_radio == 'no') {

        $radio_status = false;

    }



    


    $sql = "INSERT INTO productTable(product_name, product_price, product_image, catagory, featured) VALUES  ('$title', '$price', '$imageFile', '$selected','$radio_status')";
 
    $res =  mysqli_query($conn, $sql);

   if ($res == true) {
        // echo"Data Inserted";

        //Create a Session Variable to display Message
        $_SESSION['add'] = "<div class='success'>Product Added Sucessfully</div>";
        //Redirect Page
        header("location:" . SITURL . "admin/manage-product.php");
    } else {
        // echo "Failed to insert data";

        //Create a Session Variable to display Message
        $_SESSION['add'] = "<div class='error'>Failed to add Product</div>";
        //Redirect Page
        header("location:" . SITURL . "admin/manage-product.php");

    }
}
?>

