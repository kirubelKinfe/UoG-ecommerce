<?php include 'partials/menu.php'?>

<div class="main-content">
   <div class="wrapper">
      <h1>Update Admin</h1>
      <br><br>

      <?php
$id = $_GET['id'];

$sql = "SELECT * FROM adminTable WHERE id=$id";

$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // echo 'Admin Available';
        $row = mysqli_fetch_assoc($res);

        $full_name = $row['full_name'];
        $username = $row['username'];
    } else {
        header('location:' . SITURL . 'admin/manage-admin.php');
    }
} else {

}
?>
   <?php
    if(isset($_GET['id'])) {
      $id = $_GET['id'];
    }
   ?>

      <form action="" method="POST" name="form" onsubmit="return formValidation()">
        <div class="left-section">
          <label>FullName</label>
          <input type="text" name="full_name" placeholder="Enter your name" value="<?php echo $full_name?>">
          <label>Username:</label>
          <input type="text" name="username" placeholder="Enter your username" value="<?php echo $username ?>"></input>
          <input type="hidden" name="id" value=<?php echo $id ?>>
          <label>Current Password:</label>
          <input type="password" name="current_password" placeholder="Current Password">
          <label>New Password:</label>
          <input type="password" name="new_password" placeholder="New Password">
          <label>Confirm Password:</label>
          <input type="password" name="confirm_password" placeholder="Confirm Password">
          <input type="hidden" name="id" value=<?php echo $id ?>>
          <button type="submit" name="submit" class="btn-primary">Change Password</button>
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
      else if(document.form.current_password.value.length < 4) {
        alert("please enter current password")
        return false;
      }
      else if(document.form.new_password.value.length < 4) {
        alert("please enter new password")
        return false;
      } 
      else if(document.form.confirm_password.value.length < 4) {
        alert("please enter confirm password")
        return false;
      } 
      else if(document.form.new_password.value != document.form.confirm_password.value) {
        alert("Password don't match")
        return false;
      } 
       
    }
   </script>
</div>

<?php 
  if(isset($_POST['submit'])) {
    // echo "Clicked";

    $id=$_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM adminTable WHERE id=$id AND password='$current_password'";

    $res = mysqli_query($conn, $sql);

    if($res) {
      $count=mysqli_num_rows($res);

      if($count==1) {

        if($new_password == $confirm_password) {

          $sql2 = "UPDATE adminTable SET full_name ='$full_name', username='$username', password='$new_password' WHERE id='$id'";

          $res2 = mysqli_query($conn, $sql2);

          if($res2==true) {
                $_SESSION['update'] = "<div class='success'> Admin updated Succesfully</div>";
                header("location:" . SITURL . "admin/manage-admin.php");



                $row = mysqli_fetch_assoc($res2);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                $_SESSION['change-password'] = "<div class='error'>Faild To Changed The Password.</div>";

                header('location:' . SITURL . 'admin/manage-admin.php');
            }
          
        } else {
          $_SESSION['update'] = "<div class='error'> Faild to update the admin</div>";
          header("location:" . SITURL . "admin/manage-admin.php");
 

        }

      } else {
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
        header("Location:" . SITURL . "admin/manage-admin.php");

      }
    }

  }
?>



<?php include 'partials/footer.php'?>
