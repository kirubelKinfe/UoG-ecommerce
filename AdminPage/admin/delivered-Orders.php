<?php include "partials/menu.php"?>


  <!-- Main section starts -->
  <div class="main-content">
    <div class="wrapper">
      <h1>Delivered Orders</h1><br><br><br>

      <table class="tbl-full" border='1' cellspacing="0px">
        <tr>
          <th>S.N.</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>City</th>
          <th>Street</th>
          <th>Phone Number</th>
          <th>Payment Type</th>
          <th>Orders</th>
          <th>Total</th>
          <th>Delivery</th>
        </tr>

        <?php
          $sql = "SELECT * FROM transactionTable WHERE delivered = 'Delivered' ORDER BY transaction_id DESC";
          $res = mysqli_query($conn, $sql);

          $admincount = 1;

          if($res == TRUE) {
            $rows = mysqli_num_rows($res);

            if($rows>0) {
              while($rows = mysqli_fetch_assoc($res)) {


                $id = $rows['transaction_id'];
                $firstName = $rows['firstName'];
                $lastName = $rows['lastName'];
                $city = $rows['city'];
                $street = $rows['street'];
                $phoneNumber = $rows['phoneNumber'];
                $paymentType = $rows['paymentType'];
                $orders = $rows['orders'];
                $total = $rows['total'];
                $deliver = $rows['delivered'];

                ?> 
                  <tr>
                    <td style="text-align:center"><?php echo $admincount++; ?></td>
                    <td style="text-align:center"><?php echo $firstName; ?></td>
                    <td style="text-align:center"><?php echo $lastName; ?></td>
                    <td style="text-align:center"><?php echo $city; ?></td>
                    <td style="text-align:center"><?php echo $street; ?></td>
                    <td style="text-align:center"><?php echo $phoneNumber; ?></td>
                    <td style="text-align:center"><?php echo $paymentType; ?></td>
                    <td style="text-align:center"><?php echo $orders; ?></td>
                    <td style="text-align:center"><?php echo $total; ?></td>
                     <td style="text-align:center"><?php echo $deliver; ?></td>
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