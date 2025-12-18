<?php
session_start();
include '../auth/functions.php';
if(!isset($_SESSION['userid'] )){
    $_SESSION['msg']=showErr("please login first","danger");
    header('location: ./login.php');
    exit;
}
?>