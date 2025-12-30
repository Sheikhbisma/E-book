<?php
include '../auth/dbconnect.php';
include '../auth/check.php';
if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
  }
$free_book = mysqli_query($conn , "select count(*) as c from freebooks");
$fetch = mysqli_fetch_assoc($free_book)['c'];
$orders = mysqli_query($conn , "select * from orders where user_id = '$_SESSION[userid]' and order_status = 'Pending'");
$recent_orders = mysqli_query($conn , "select * from orders where user_id = '$_SESSION[userid]' order by created_at desc limit 5");
$paid_books = mysqli_query($conn, "
    SELECT DISTINCT b.id, b.title, b.cover_image, b.pdf_path
    FROM orders AS o
    INNER JOIN order_items AS ot ON o.order_id = ot.order_id
    INNER JOIN books AS b ON ot.book_id = b.id
    WHERE o.user_id = '$user_id'
      AND o.order_status = 'Done'
");
$total_books = mysqli_num_rows($paid_books) + $fetch;
$select_winner = mysqli_query($conn , "select count(*) as c from competition_entries where user_id = '$user_id' and status = 'winner'");
$select_adultWin =  mysqli_query($conn , "select count(*) as c from adult_entries where user_id = '$user_id' and status = 'winner'");
$adult = mysqli_fetch_assoc($select_adultWin)['c'];
$essay = mysqli_fetch_assoc($select_winner)['c'];
$total_winner = $adult + $essay;
$total_participate = mysqli_query($conn , "select count(*) as c from competition_entries where user_id = '$user_id'");
$total_participate2 = mysqli_query($conn , "select count(*) as c from adult_entries where user_id = '$user_id'");
$total = mysqli_fetch_assoc($total_participate)['c'] + mysqli_fetch_assoc($total_participate2)['c'];
?>