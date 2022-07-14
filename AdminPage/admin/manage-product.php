<?php include "partials/menu.php"?>


  <!-- Main section starts -->
  <div class="main-content">
    <div class="wrapper">
      <h1>Manage Products</h1><br>
      <?php 
        if (isset($_SESSION['delete'])) {
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Displaying Session message
            unset($_SESSION['add']); //Removing Session message
        }


      ?>  

      <a href="<?php echo SITURL; ?>admin/add-product.php" class="btn-control">Add Product</a><br>

      <table class="tbl-full" cellpadding="30px" border='1' cellspacing="0px">
        <tr>
          <th>S.N.</th>
          <th>Product_name</th>
          <th>Product_price</th>
          <th>Product_image</th>
          <th>Catagory</th>
          <th>Actions</th>
        </tr>

        <?php
          $sql = "SELECT * FROM productTable";
          $res = mysqli_query($conn, $sql);

          $productcount = 1;

          if($res == TRUE) {
            $rows = mysqli_num_rows($res);

            if($rows>0) {
              while($rows = mysqli_fetch_assoc($res)) {


                $id = $rows['product_id'];
                $product_name = $rows['product_name'];
                $porduct_price = $rows['product_price'];
                $product_image = $rows['product_image'];
                $catagory = $rows['catagory'];

                ?> 
                  <tr>
                    <td style="text-align:center"><?php echo $productcount++; ?></td>
                    <td style="text-align:center"><?php echo $product_name; ?></td>
                    <td style="text-align:center"><?php echo $porduct_price; ?></td>
                    <td style="text-align:center"><?php echo " <img width='100px' src='../../img/$product_image' " ?></td>
                    <td style="text-align:center"><?php echo $catagory; ?></td>
                    <td style="text-align:center">
                      <a href="<?php echo SITURL; ?>admin/update-product.php?id=<?php echo $id; ?>" class="btn-secondary">Update Product</a> 
                      <a href="<?php echo SITURL; ?>admin/delete-product.php?id=<?php echo $id; ?>
                      " class="btn-danger" onclick="return confirm('Are you sure you want ro delete this product?')">Delete Product</a>
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