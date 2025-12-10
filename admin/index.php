<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';


        if (isset($_SESSION['loginmsg'])) {
            echo $_SESSION['loginmsg'];
            unset($_SESSION['loginmsg']);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include './inc/link.php' ?>
</head>
<body>
    
</body>
</html>