<?php
session_start();
if(!isset($_SESSION['userid'] )){
    header('location: ../user/login.php');
    exit;
}
?>