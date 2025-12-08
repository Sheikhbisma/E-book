<?php
// SIDEBAR + HEADER FILE
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>

<?php include '../components/meta-links.php'; ?>
  
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center mb-4">User Panel</h4>

    <a href="dashboard.php">📊 Dashboard</a>
    <a href="profile.php">👤 Profile</a>
    <a href="competition.php">🏆 Competition</a>
    <a href="orders.php">🛒 Orders</a>
    <a href="register.php">📝 Register</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- CONTENT START -->
<div class="content-area">
    <?php include '../components/script.php'; ?>
</body>
</html>