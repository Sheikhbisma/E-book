<?php

include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';
$user_id = $_SESSION['userid'];
$delete_id = $_GET['delete_id'];
$delete_cartItem = mysqli_query($conn , "Delete from cart where cart_id = $delete_id");
if($delete_cartItem){
    echo "<script>confirm('Do You Want To delete This Item from Cart?'); window.location.href = 'cart.php'</script>";
}


?>