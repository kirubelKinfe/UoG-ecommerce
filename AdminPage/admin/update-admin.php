<?php include ('partials/menu.php')?>

<div class="main-content">
   <div class="wrapper">
      <h1>Update Admin</h1> 
      <br><br>

      <?php
        $id = $_GET['id'];

        $sql="SELECT * FROM adminTable WHERE id=$id";

        $res=mysqli_query($conn, $sql);

        if($res==true) {
          $count = mysqli_num_rows($res);

          if($count==1) {
            // echo 'Admin Available';
            $row=mysqli_fetch_assoc($res);

            $full_name = $row['full_name'];
            $username = $row['username'];
          }
          else {
            header('location:'.SITURL.'admin/manage-admin.php');
          }
        } 
        else {

        }
      ?>
     
      <form action="" method="POST">
        <div class="left-section">
          <label>FullName</label>
          <input type="text" name="full_name" placeholder="Enter your name">
          <label>Username:</label>
          <input type="text" name="username" placeholder="Enter your username"></input>
          <input type="hidden" name="id" value=<?php echo $id ?>>
          <button type="submit" name="submit" class="btn-secondary">Update Admin</button>
        </div>
      </form>

   </div>
</div>

<?php
  if(isset($_POST['submit'])) {
    // echo "button clicked";

    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    $sql = "UPDATE adminTable SET full_name ='$full_name', username='$username' WHERE id='$id'";

    $res = mysqli_query($conn, $sql);

    if($res==true) {
      $_SESSION['update'] = "<div class='success'> Admin updated Succesfully</div>";
      header("location:".SITURL."admin/manage-admin.php");
    }
    else 
    {
      $_SESSION['update'] = "<div class='error'> Faild to update the admin</div>";
      header("location:" . SITURL . "admin/manage-admin.php");

    }
  }
?>

<?php include 'partials/footer.php'?>
