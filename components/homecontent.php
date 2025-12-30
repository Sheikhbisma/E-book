<?php
// include database,functions
include './auth/functions.php';
include './auth/dbconnect.php';

// select 4 books from database new releases
$new=mysqli_query($conn , "select * from books where id in(11,15,16,20)");
$best=mysqli_query($conn , "select * from books where id in(13,18,21,26)");
$winner=mysqli_query($conn , "select * from adult_entries where status = 'winner' limit 3");
$children = mysqli_query(
    $conn,"SELECT c.*, u.customer_name
     FROM competition_entries c
     INNER JOIN customer_register u
     ON c.user_id = u.customer_id
     WHERE c.status = 'winner' limit 3"
);
$select_prize=mysqli_query($conn , "select * from settings where name = 'price'");
$prize = mysqli_fetch_assoc($select_prize);
$select_adultprize=mysqli_query($conn , "select * from settings where name = 'essay_prize'");
$adultPrize = mysqli_fetch_assoc($select_adultprize);
?>