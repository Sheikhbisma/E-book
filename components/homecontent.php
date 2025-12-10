<?php
// include database,functions
include './auth/functions.php';
include './auth/check.php';
include './auth/dbconnect.php';

// select 4 books from database new releases
$new=mysqli_query($conn , "select * from books where id in(11,15,16,20)");
$best=mysqli_query($conn , "select * from books where id in(13,18,21,26)");

?>