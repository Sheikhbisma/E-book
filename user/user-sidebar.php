<?php
// SIDEBAR + HEADER FILE
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }
        .sidebar {
            height: 100vh;
            background: #273c75;
            color: white;
            padding-top: 20px;
            position: fixed;
            width: 220px;
            top: 0;
            left: 0;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 12px 20px;
            display: block;
        }
        .sidebar a:hover {
            background: #40739e;
        }
        .content-area {
            margin-left: 240px;
            padding: 25px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center mb-4">User Panel</h4>

    <a href="dashboard.php"> Dashboard</a>
    <a href="profile.php"> Profile</a>
    <a href="competition.php"> Competition</a>
    <a href="orders.php"> Orders</a>
    <a href="register.php"> Register</a>
    <a href="logout.php"> Logout</a>

</div>

<!-- CONTENT START -->
<div class="content-area">
    
</body>
</html>

