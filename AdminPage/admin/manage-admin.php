<?php include "partials/menu.php"?>


  <!-- Main section starts -->
  <div class="main-content">
    <div class="wrapper">
      <h1>Manage Admins</h1>
      <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);

        }
      ?>
      
      <br>

      <?php
        if(isset($_SESSION['add'])) {
          echo $_SESSION['add']; //Displaying Session message
          unset($_SESSION['add']); //Removing Session message
        }

        if(isset($_SESSION['delete'])) {
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);

        }

        if(isset($_SESSION['update'])) {
          echo $_SESSION['update'];
          unset($_SESSION['update']);
        }

        if (isset($_SESSION['user-not-found'])) {
          echo $_SESSION['user-not-found'];
          unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['password-not-match'])) {
          echo $_SESSION['password-not-match'];
          unset($_SESSION['password-not-match']);
        }

        if (isset($_SESSION['change-password'])) {
            echo $_SESSION['change-password'];
            unset($_SESSION['change-password']);
        }



      ?>

      <a href="add-admin.php" class="btn-control">Add Admin</a><br>

      <table class="tbl-full" border='1' cellspacing="0px">
        <tr>
          <th>S.N.</th>
          <th>Full Name</th>
          <th>Username</th>
          <th>Actions</th>
        </tr>

        <?php
          $sql = "SELECT * FROM adminTable";
          $res = mysqli_query($conn, $sql);

          $admincount = 1;

          if($res == TRUE) {
            $rows = mysqli_num_rows($res);

            if($rows>0) {
              while($rows = mysqli_fetch_assoc($res)) {


                $id = $rows['id'];
                $full_name = $rows['full_name'];
                $username = $rows['username'];

                ?> 
                  <tr>
                    <td style="text-align:center"><?php echo $admincount++; ?></td>
                    <td style="text-align:center"><?php echo $full_name; ?></td>
                    <td style="text-align:center"><?php echo $username; ?></td>
                    <td style="text-align:center">
                      <a href="<?php echo SITURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                      <a href="<?php echo SITURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a> 
                      <a href="<?php echo SITURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>
                      " class="btn-danger" onclick="return confirm('Are you sure you want ro delete this admin?')">Delete Admin</a>
                    </td>
                  </tr>
                <?php
              }
            } else {

              
            }
          }
        ?>
      </table>

    </div>
  </div>
  <!-- Main section ends -->


<?php include "partials/footer.php"?>

