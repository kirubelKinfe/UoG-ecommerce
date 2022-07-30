<?php include "partials/menu.php"?>

 <!-- Main section starts -->
<div class="main-content">
   <div class="wrapper">
      <h1>Add Admin</h1>
      <br><br>
      <form action="" method="POST" name="form" onsubmit="return formValidation()">
        <div class="left-section">
          <label>FullName</label>
          <input type="text" name="full_name" placeholder="Enter your name">
          <label>Username:</label>
          <input type="text" name="username" placeholder="Enter your username"></input>
          <label>Type:</label>
          <input type="text" name="type" placeholder="Enter your admin privilege"></input>
          <label>Password:</label>
          <input type="password" name="password" placeholder="Enter your password">
          <button type="submit" name="submit" class="btn-control">Add Admin</button>
        </div>
      </form>
   </div>
   <script>
   function formValidation() {
      if(document.form.full_name.value == "") {
        alert("please enter full name")
        return false;
      }
      else if(document.form.username.value == "") {
        alert("please enter username")
        return false;
      }
      else if(document.form.type.value == "") {
        alert("please enter username")
        return false;
      }
      else if(document.form.password.value.length < 4) {
        alert("please enter a valid password")
        return false;
      }
    
       
    }
   </script>
</div>
 <!-- Main section ends -->
<?php include "partials/footer.php"?>

<?php
//Process the value from form and save it in database

if (isset($_POST['submit'])) {
    // Button Clicked
    // echo("Button Clicked");

    //1. Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $type = $_POST['type'];
    $password = md5($_POST['password']); //password encryption with MD5

    //2. SQL Query to Save the data into database
    $sql = "INSERT INTO adminTable SET full_name='$full_name',
    username='$username', type = '$type',
    password='$password'";

    //3. Execute Query and Save Data into database

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //4. Check query execution and display appropriate message

    if ($res == true) {
        // echo"Data Inserted";

        //Create a Session Variable to display Message
        $_SESSION['add'] = "<div class='success'>Admin Added Sucessfully</div>";
        //Redirect Page
        header("location:" . SITURL . "admin/manage-admin.php");
    } else {
        // echo "Failed to insert data";

        //Create a Session Variable to display Message
        $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";
        //Redirect Page
        header("location:" . SITURL . "admin/manage-admin.php");

    }
}
?>
