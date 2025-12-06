<?php

$conn = mysqli_connect('localhost' , 'root' , '' , 'ebook');

if(!$conn){
die("connection error" . mysqli_connect_error());
}

?>