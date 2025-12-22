<?php
include '../auth/dbconnect.php';
include 'session.php';

// SQL query
$select_orders = "
SELECT o.full_name, o.email, o.city, o.address, o.book_format, 
       o.payment_method, o.payment_status, o.order_status, o.grand_total,
       ot.quantity, ot.book_title
FROM orders AS o
INNER JOIN order_items AS ot ON o.order_id = ot.order_id
ORDER BY o.order_id DESC
";

// Execute query
$fetch_orders = mysqli_query($conn, $select_orders);
while($orders=mysqli_fetch_assoc($fetch_orders)){
    
}


?>



<!DOCTYPE html>
<html>
<head>
    <title>Admin - Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        .order-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .order-card:hover {
            transform: translateY(-5px);
        }
        .order-card-header {
            background: #0d6efd;
            color: #fff;
            padding: 18px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        .order-card-body {
            padding: 20px;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .order-item .label {
            font-weight: 600;
            color: #555;
        }
        .order-item .value {
            color: #000;
        }
        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align:center; margin-bottom:30px;">All Orders</h2>

        <!-- Order Card 1 -->
        <div class="order-card">
            <div class="order-card-header">Order #101</div>
            <div class="order-card-body">
                <!-- Customer Info -->
                <div class="order-item"><span class="label">Name:</span><span class="value"><?php echo $orders['full_name'] ?></span></div>
                <div class="order-item"><span class="label">Email:</span><span class="value">john@example.com</span></div>
                <div class="order-item"><span class="label">Address:</span><span class="value">123 Main St</span></div>
                <div class="order-item"><span class="label">City:</span><span class="value">New York</span></div>

                <hr>

                <!-- Order Info -->
                <div class="order-item"><span class="label">Book Title:</span><span class="value">The Great Book</span></div>
                <div class="order-item"><span class="label">Quantity:</span><span class="value">2</span></div>
                <div class="order-item"><span class="label">Format:</span><span class="value">Hardcover</span></div>
                <div class="order-item"><span class="label">Grand Total:</span><span class="value">$50</span></div>

                <hr>

                <!-- Payment & Status -->
                <div class="order-item"><span class="label">Payment Method:</span><span class="value">Credit Card</span></div>
                <div class="order-item"><span class="label">Payment Status:</span><span class="value">Paid</span></div>
                <div class="order-item"><span class="label">Order Status:</span><span class="value">Shipped</span></div>
            </div>
        </div>

        
        

    
    </div>
</body>
</html>
