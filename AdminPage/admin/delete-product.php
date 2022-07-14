<?php
//include constants.php file here
include "../config/constants.php";

//1. Get the Id of product to be deleted
$id = $_GET['id'];

//2. Create SQL Quary to delete Product
$sql = "DELETE FROM productTable WHERE product_id='$id'";

// Execute the Query
$res = mysqli_query($conn, $sql);

//check whether the query excuted succesfully or not
if ($res = true) {
    // echo "Product deleted";
    $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully.</div>";
    header("Location:" . SITURL . "admin/manage-product.php");
} else {
    // echo "Faild to delete the Product";
    $_SESSION['delete'] = "<div class='error'>Faild to Delete Product. Try Again Later</div>";
    header("Location:" . SITURL . "admin/manage-product.php");

}

//3. Redirect to manage product page with message (success/error)
?>