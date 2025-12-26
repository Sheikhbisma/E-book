<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dealer Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
    body {
        background-color: #f8f9fa;
    }
    .dashboard-container {
        padding: 50px 15px;
        text-align: center;
    }
    .card-summary {
        border-radius: 15px;
        transition: transform 0.3s;
    }
    .card-summary:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .card-summary h2 {
        font-size: 2.5rem;
        margin-top: 10px;
        color: #007bff;
    }
    .welcome-message {
        margin-bottom: 50px;
        font-weight: 500;
        color: #343a40;
    }
</style>
</head>
<body>

<div class="dashboard-container">
    <!-- Welcome Message -->
    <h1 class="welcome-message"><i class="bi bi-hand-thumbs-up"></i> Welcome, Dealer!</h1>

    <!-- Summary Cards -->
    <div class="row justify-content-center g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card card-summary shadow-sm py-4">
                <h5>Total Books</h5>
                <h2>25</h2>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-summary shadow-sm py-4">
                <h5>Total Orders</h5>
                <h2>50</h2>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card-summary shadow-sm py-4">
                <h5>Pending Orders</h5>
                <h2>10</h2>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
