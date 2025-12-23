<?php
include '../auth/check.php';
include '../auth/dbconnect.php';
if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
}
$select_orders = "select * from orders where user_id = $user_id";
$execute = mysqli_query($conn, $select_orders);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../components/meta-links.php' ?>
</head>

<body class="bg-light">
    <?php include 'user-sidebar.php' ?>
    <div class="content-area">
        <main>
            <section class="px-5 pb-5">
                <header class="header p-4 mb-5 text-center rounded" style="border-bottom: 6px solid var(--accent-gold);">

                    <h1 class="fw-bold mb-3 mb-md-0 text-center"><i class="bi bi-card-list me-2"></i>View Orders</h1>
                    <p class="mb-1 text-light">
                        Your order details are displayed here for your reference.
                    </p>

                    <p class="mb-1 text-light">
                        If your order is <strong>approved</strong> and you have selected the
                        <strong>PDF format</strong>, your books will become available in your
                        <strong>Dashboard</strong>.
                    </p>

                    <p class="mb-0 text-light">
                        If you have selected <strong>Hard Copy</strong> or <strong>CD</strong>,
                        your order will be <strong>shipped</strong> after admin approval.
                    </p>
                </header>

                <div class="row justify-content-center">

                    <?php

                    while ($fetch_order = mysqli_fetch_assoc($execute)) {
                    ?>

                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="admin-order-card card p-4 h-100 d-flex flex-column">

                                <!-- Header -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0 fw-bold woodendark fs-2">
                                        <i class="bi bi-receipt me-2"></i> Order Details
                                    </h5>
                                    <span class="badge btn-edit"><?php echo $fetch_order['order_status'] ?></span>
                                </div>

                                <!-- Main Flex Container -->
                                <div class="d-flex flex-column flex-md-row">

                                    <!-- Left Column: Books -->
                                    <div class="me-md-3 flex-grow-1 mb-3 mb-md-0">
                                        <h6 class="fw-bold woodendark">Books</h6>
                                        <?php
                                        $order_id = $fetch_order['order_id'];
                                        $items = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = $order_id");
                                        while ($item = mysqli_fetch_assoc($items)) {
                                        ?>
                                            <div class="d-flex justify-content-between small border-bottom py-1">
                                                <span><?php echo $item['book_title'] ?></span>
                                                <span>Qty: <?php echo $item['quantity'] ?></span>
                                            </div>
                                        <?php } ?>

                                        <!-- Grand Total -->
                                        <div class="d-flex justify-content-between fw-bold mt-2">
                                            <span>Grand Total:</span>
                                            <span>$ <?php echo $fetch_order['grand_total'] ?></span>
                                        </div>
                                        <?php if ($fetch_order['order_status'] == 'Shipped') { ?>
                                            <div class="alert alert-primary w-100 border shadow-sm">
                                                <i class="bi bi-truck me-2"></i>
                                                Your order has been shipped successfully. It will be delivered to your
                                                provided address soon. Thank you for your patience.
                                            </div>
                                        <?php } ?>
                                        <?php if ($fetch_order['order_status'] == 'Pending') { ?>
                                            <div class="alert alert-warning w-100 border shadow-sm">
                                                <i class="bi bi-clock-history me-2"></i>
        Some of your orders are still pending approval.
                                            </div>
                                        <?php } ?>
                                        <?php if ($fetch_order['order_status'] == 'Done') { ?>
                                            <div class="alert alert-success w-100 border shadow-sm">
                                                <i class="bi bi-truck me-2"></i>
                                               check your dashboard for downloaded books.
                                            </div>
                                        <?php } ?>
                                        <?php if ($fetch_order['order_status'] == 'delivered') { ?>
                                            <div class="alert alert-success w-100 border shadow-sm">
                                                <i class="bi bi-truck me-2"></i>
                                               Your Order Delivered Successfully.
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <!-- Right Column: Customer & Payment Info + Button -->
                                    <div class="flex-shrink-0 ms-md-3" style="min-width: 220px;">

                                        <!-- Customer Info -->
                                        <div class="mb-3">
                                            <p class="mb-1 woodmedium fw-medium"><strong class="woodendark">Name:</strong> <?php echo $fetch_order['full_name'] ?></p>
                                            <p class="mb-1 woodmedium fw-medium"><strong class="woodendark">Email:</strong> <?php echo $fetch_order['email'] ?></p>
                                            <p class="mb-1 woodmedium fw-medium"><strong class="woodendark">Address:</strong> <?php echo $fetch_order['address'] ?></p>
                                            <p class="mb-0 woodmedium fw-medium"><strong class="woodendark">City:</strong> <?php echo $fetch_order['city'] ?></p>
                                            <p class="mb-0 woodmedium fw-medium"><strong class="woodendark">Book Format:</strong> <?php echo $fetch_order['book_format'] ?></p>
                                        </div>

                                        <hr>

                                        <!-- Payment Info -->
                                        <div class="mb-3">
                                            <p class="mb-1 woodmedium"><strong class="woodendark">Payment Method:</strong> <?php echo $fetch_order['payment_method'] ?></p>
                                            <p class="mb-0 woodmedium"><strong class="woodendark">Payment Status:</strong>
                                                <span class="badge bg-danger"><?php echo $fetch_order['payment_status'] ?></span>
                                            </p>
                                        </div>

                                        <hr>

                                        <!-- Order Status -->
                                        <div class="mb-3">
                                            <p class="mb-0"><strong>Order Status:</strong>
                                                <span class="badge bg-info"><?php echo $fetch_order['order_status'] ?></span>
                                            </p>

                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </section>
        </main>
    </div>
    <?php include '../components/script.php' ?>
</body>

</html>