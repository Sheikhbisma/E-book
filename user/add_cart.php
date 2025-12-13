<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';
$user_id = $_SESSION['userid'];
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $select_price = mysqli_query($conn , "select price from books where id = '$book_id'");
    $fetch_price = mysqli_fetch_assoc($select_price);
    $book_price = $fetch_price['price'];
    $check_book = mysqli_query($conn, "select * from cart where user_id = '$user_id' and book_id = '$book_id'");
    if (mysqli_num_rows($check_book) > 0) {
        $update_book = "Update cart set quantity = quantity + 1 , price = price + '$book_price' where user_id = '$user_id' and book_id = '$book_id'";
        $execute_update = mysqli_query($conn, $update_book);
        if ($execute_update) {
            $_SESSION['cart_msg']=showErr("Quantity Update Successfully!" , "warning");
             header('location: ../books/index.php');
                exit;
        }
    } else {
        $qry = "INSERT INTO `cart`( `user_id`, `book_id`, `Quantity` , `price`) VALUES ('$user_id','$book_id','1' , '$book_price')";
        $execute = mysqli_query($conn, $qry);
        if ($execute) {
                $_SESSION['cart_msg']=showErr("Book Added To Cart!" , "warning");
                header('location: ../books/index.php');
                exit;

        } else {
            $_SESSION['cart_msg']=showErr("Book Added To Cart!" , "warning");
        }
    }
}

?>