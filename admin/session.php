<?php
session_start();
include '../auth/functions.php';
if(!isset($_SESSION['email'])){
     $_SESSION['msg'] = showErr("Please Login First", "danger");
    header('location: login.php');
    exit;
}



?>