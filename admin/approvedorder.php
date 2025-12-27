<?php
include '../auth/dbconnect.php';
include 'session.php';
$order_id = $_GET['order_id'];
if(isset($order_id)){
    $update = "update orders set payment_status = 'Received',order_status = 'Done' where order_id = '$order_id'";
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
    $update = "update orders set payment_status = 'Received',order_status = 'Shipped' where order_id = '$shipped_id'";
    $execute_update = mysqli_query($conn , $update);
if($execute_update){
    $_SESSION['shipped'] = showErr("Order Shipped Successfully " , "success");
  
    header('location: shipped-orders.php');
    exit;
}else{
    $_SESSION['shipped'] = showErr("There is an error" , "danger");

}


}
$deliver_id = $_GET['deliver_id'];
if(isset($deliver_id)){
    $update = "update orders set payment_status = 'Received',order_status = 'delivered' where order_id = '$deliver_id'";
    $execute_update = mysqli_query($conn , $update);
if($execute_update){
    $_SESSION['deliver'] = showErr("Order delivered successfully" , "success");
  
    header('location: view-approved.php');
    exit;
}else{
    $_SESSION['deliver'] = showErr("There is an error" , "danger");

}
}

$reject_id = $_GET['reject_id'];
if(isset($deliver_id)){
    $update = "update orders set payment_status = 'Failed',order_status = 'Failed' where order_id = '$reject_id'";
    $execute_update = mysqli_query($conn , $update);
if($execute_update){
    $_SESSION['deliver'] = showErr("Order delivered successfully" , "success");
  
    header('location: view-approved.php');
    exit;
}else{
    $_SESSION['deliver'] = showErr("There is an error" , "danger");

}
}


?>