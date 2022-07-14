<?php
  //include constants.php file here
  include ("../config/constants.php");

  //1. Get the Id of admin to be deleted
  $id = $_GET['id'];


  //2. Create SQL Quary to delete Admin
  $sql = "DELETE FROM adminTable WHERE id='$id'";

  // Execute the Query
  $res = mysqli_query($conn, $sql);

  //check whether the query excuted succesfully or not
  if($res=true) {
    // echo "Admin deleted";
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    header("Location:".SITURL."admin/manage-admin.php");
  } else {
    // echo "Faild to delete the admin";
    $_SESSION['delete'] = "<div class='error'>Faild to Delete Admin. Try Again Later</div>";
    header("Location:" . SITURL . "admin/manage-admin.php");

  }

  //3. Redirect to manage admin page with message (success/error) 


?>