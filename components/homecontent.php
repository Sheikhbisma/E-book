<?php
// include database,functions
include './auth/functions.php';
include './auth/dbconnect.php';

// select 4 books from database new releases
$new=mysqli_query($conn , "select * from books where id in(11,15,16,20)");
$best=mysqli_query($conn , "select * from books where id in(13,18,21,26)");
$winner=mysqli_query($conn , "select * from adult_entries where status = 'winner'");
$children = mysqli_query(
    $conn,"SELECT c.*, u.customer_name
     FROM competition_entries c
     INNER JOIN customer_register u
     ON c.user_id = u.customer_id
     WHERE c.status = 'winner'"
);
?>