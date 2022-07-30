<?php include('../config/constants.php') ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - UoG-ecommerce</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
   <form action="" method="POST" class="login-form" name="form" onsubmit="return formValidation()">
    
      <div class="login-view">
        <div class="login-input">
          <h1 class="admin-title">ADMIN PANEL</h1>
          <?php
              if (isset($_SESSION['login'])) {
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);

              }
              if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
              }
          ?>
          <label>Username:</label>
          <input type="text" name="username" placeholder="Enter username">
          <label>Password:</label>
          <input type="password" name="password" placeholder="Enter password">
          <div class="login-btn">
              <button type="submit" name="submit"  value="Login" class="btnLogin">LOGIN</button>
          </div>
          
        </div>
      </div>
    </form>  

    <script>
      function formValidation() {
          if(document.form.username.value == "") {
            alert("please enter username")
            return false;
          }
          else if(document.form.password.value == "") {
            alert("please enter password")
            return false;
          }     
        }
   </script>
  
</body>
</html>

<?php
  if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM adminTable WHERE  username='$username' and password='$password'";

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    $count = mysqli_num_rows($res);
    

    if($count == 1) {
      $_SESSION['login'] = "<div class='success'>Login Successful.</div>";

      $_SESSION['user'] = $username;
      $_SESSION['type'] = "<div class='success'>$row[type]</div>";

      header('location:'.SITURL.'admin/manage-admin.php');

    } else {

      $_SESSION['login'] = "<div class='errorLogin'>Invalid username or password</div>";

      header('location:' . SITURL . 'admin/');

    }
  }

?>