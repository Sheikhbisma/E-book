<?php
include "../dbconnect.php";

// Fetch total messages
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM contact");
$totalData  = $totalQuery->fetch_assoc();
$totalMessages = $totalData['total'];

// Fetch latest messages
$messagesQuery = $conn->query("SELECT * FROM contact ORDER BY id DESC LIMIT 20");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f4f6f9;
    font-family: 'Poppins', sans-serif;
}

.sidebar {
    height: 100vh;
    width: 260px;
    background: #343a40;
    padding-top: 25px;
    position: fixed;
}

.sidebar h2 {
    color: #fff;
    text-align: center;
    margin-bottom: 30px;
}

.sidebar a {
    display: block;
    padding: 14px 25px;
    color: #adb5bd;
    text-decoration: none;
    font-size: 16px;
}

.sidebar a:hover {
    background: #495057;
    color: #fff;
}

.content {
    margin-left: 270px;
    padding: 30px;
}

.card {
    border-radius: 14px;
}

.table th {
    background: #343a40;
    color: #fff;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="#">Dashboard</a>
    <a href="#">Messages</a>
    <a href="#">Users</a>
    <a href="#">Settings</a>
</div>

<!-- MAIN CONTENT -->
<div class="content">
    <h1 class="mb-4">Dashboard Overview</h1>

    <!-- Stats Card -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white" style="background:#226f54;">
                <div class="card-body">
                    <h4>Total Messages</h4>
                    <h2><?php echo $totalMessages; ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Messages Table -->
    <div class="card">
        <div class="card-header">
            <h4>Latest Messages</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = $messagesQuery->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
