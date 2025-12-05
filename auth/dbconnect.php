<?php

$conn = mysqli_connect('localhost' , 'root' , '' , 'Ebook');

if(!$conn){
die("connection error" . mysqli_connect_error());
}

?>