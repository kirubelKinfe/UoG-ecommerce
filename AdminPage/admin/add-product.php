<?php include "partials/menu.php"?>



<?php include "partials/footer.php"?>

<?php
//Process the value from form and save it in database

  if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
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

        $radio_status = 1;

    } else if ($selected_radio == 'no') {

        $radio_status = 0;

    }



    


    $sql = "INSERT INTO productTable(product_name, product_price, product_image, catagory, quantity, featured) VALUES  ('$title', '$price', '$imageFile', '$selected', $quantity,'$radio_status')";
 
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
        echo mysqli_error($conn);
        //Redirect Page
        // header("location:" . SITURL . "admin/manage-product.php");

    }
}
?>


<!-- Main section starts -->
<div class="main-content">
   <div class="wrapper">
      <h1>Add Product</h1>
      <br><br>
      <form action="" method="POST" name="form" onsubmit="return formValidation()">
        <div class="left-section">
          <label>Product Name</label>
          <input type="text" name="title" placeholder="Enter title">

          <label>Price:</label>
          <input type="text" name="price" placeholder="Enter price">

          <label>Quantity:</label>
          <input type="number" name="quantity" placeholder="Enter quantity">

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

