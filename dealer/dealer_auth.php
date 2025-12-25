<?php
session_start();
include '../auth/functions.php';
if (!isset($_SESSION['dealerid'])) {
    header("Location: dealerlogin.php");
    exit;
}
?>