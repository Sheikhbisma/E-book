<?php
include '../auth/check.php';
include '../auth/dbconnect.php';
include '../auth/functions.php';
$user_id = $_SESSION['userid'];
// if placeorder btn is set
if(isset($_POST['placeorder'])){
    $fullname = sanitize_data($_POST['fullname']);
    $email = sanitize_data($_POST['email']);
    $bookformat = sanitize_data($_POST['bookformat']);
    $city = sanitize_data($_POST['city']);
    $address = sanitize_data($_POST['address']);
    $payment = sanitize_data($_POST['payment']);
$grandtotal = isset($_SESSION['subtotal']) ? $_SESSION['subtotal'] : 0;
// use transaction because we need to run multiple queries at one time if any query failed it rollback
    mysqli_begin_transaction($conn);
    try{
        // insert into orders table basic information and subtotal
          $insert_order="INSERT INTO `orders`( `user_id`, `full_name`, `email`, `city`, `address`, `book_format`, `payment_method`, `grand_total`) VALUES ('$user_id','$fullname','$email','$city',' $address','$bookformat','$payment','$grandtotal')";
          $execute_insertOrder=mysqli_query($conn , $insert_order);
// it give order id
          $order_id = mysqli_insert_id($conn);
// select from cart to indert into order_items table
          $select_items =  mysqli_query($conn, "SELECT c.quantity , b.id,b.title  from cart as c INNER JOIN books as b ON c.book_id = b.id WHERE c.user_id = $user_id ");
          while($fetch_items = mysqli_fetch_assoc($select_items)){
            $book_id = $fetch_items['id'];
            $book_quantity = $fetch_items['quantity'];
            $book_title = $fetch_items['title'];
            //   insert into orders items book name and quantity because of book id we can easily fetch pdf from this table 
            $insert_orderItems = "INSERT INTO `order_items`( `order_id`, `book_id`, `quantity`, `book_title`) VALUES ('$order_id','$book_id','$book_quantity','$book_title')";
            $execute_insertItems=mysqli_query($conn ,$insert_orderItems);

// if data insert into orders item then cart empty
            $delete_cart = mysqli_query($conn , "delete from cart where user_id = $user_id");
          }
          mysqli_commit($conn);
          header('location: ../index.php');
    }catch(Exception $e){
        mysqli_rollback($conn);
        echo $e->getMessage();
        // header('location: checkout.php');
    }
}



?>