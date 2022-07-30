<?php
include "../config/constants.php";
$id = $_GET['id'];
$sql = "UPDATE transactionTable SET delivered = 'Delivered' WHERE transaction_id=$id";
$res = mysqli_query($conn, $sql);
header('location: ./manage-order.php');
