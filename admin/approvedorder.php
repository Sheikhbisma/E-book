<?php
include '../auth/dbconnect.php';
include 'session.php';
$order_id = $_GET['order_id'];
if(isset($order_id)){
    $update = "update orders set payment_status = 'Received',order_status = 'Done' where order_id = $order_id";
    $execute_update = mysqli_query($conn , $update);
if($execute_update){
    $_SESSION['approved'] = showErr("Order updated to approved" , "success");
    header('location: view-orders.php');
    exit;
}else{
    $_SESSION['approved'] = showErr("There is an error" , "danger");

}
}
$shipped_id = $_GET['shipped_id'];
if(isset($shipped_id)){
    $update = "update orders set payment_status = 'Received',order_status = 'Shipped' where order_id = $shipped_id";
    $execute_update = mysqli_query($conn , $update);
if($execute_update){
    $_SESSION['approved'] = showErr("Order updated to approved" , "success");
  
    header('location: view-orders.php');
    exit;
}else{
    $_SESSION['approved'] = showErr("There is an error" , "danger");

}
}




?>