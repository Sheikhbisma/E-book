
<?php
include 'session.php';
include '../auth/dbconnect.php';
$msg= '';
$select_orders = "select * from orders where payment_status = 'Pending' and order_status = 'Pending'";
$execute = mysqli_query($conn , $select_orders);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include './inc/link.php' ?>
</head>
<body class="bg-light">
    <?php include 'sidebar.php' ?>
 <div class="content-area">
       <main>
        <section class="px-md-5 pb-md-5 ord">
             <header class="header p-4 mb-5 bg-white rounded">

                <h1 class="fw-bold mb-3 mb-md-0 text-center"><i class="fa-solid fa-book fs-1"></i>View Pending Orders</h1>
             <div class="d-flex justify-content-center gap-2">
                <a href="./view-approved.php" class="btn btn-custom btn-lg">
                    <i class="bi bi-plus-lg"></i>Approved Orders
             </a>
                <a href="./shipped-orders.php" class="btn btn-custom btn-lg">
                    <i class="bi bi-plus-lg"></i> Shipped Orders
             </a>
             </div>
             </header>
      
          <div class="row justify-content-center">
           <?php if(mysqli_num_rows($execute) == 0){ ?> 
             <div class="b-card text-center py-4 w-50 woodendark">
        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
        <h5 class="mb-1 fs-1">No Pending Orders</h5>
        <p class="mb-0 fs-5">All orders have been processed <i class="bi bi-check-circle"></i></p>
    </div>
            <?php } ?>
    <?php  while($fetch_order = mysqli_fetch_assoc($execute)){ 
        ?>
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="admin-order-card b-card p-4 h-100 d-flex flex-column">
      
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 fw-bold woodendark fs-2">
                    <i class="bi bi-receipt me-2"></i> Order Details
                </h5>
                <span class="badge btn-edit">Pending</span>
            </div>

            <!-- Main Flex Container -->
            <div class="d-flex flex-column flex-md-row">
                
                <!-- Left Column: Books -->
                <div class="me-md-3 flex-grow-1 mb-3 mb-md-0">
                    <h6 class="fw-bold woodendark">Books</h6>
                    <?php
                        $order_id = $fetch_order['order_id'];
                        $items = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = $order_id");
                        while($item = mysqli_fetch_assoc($items)) {
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
                        <!-- Action Buttons -->
    <div class=" mt-3">
        <?php if($fetch_order['book_format'] === 'pdf'){ ?>
        <a href="./approvedorder.php?order_id=<?php echo $fetch_order['order_id'] ?>" class="btn btn-success text-center">
            <i class="bi bi-check-circle me-2"></i> Show pdf
        </a><br>
        <?php } ?>
      <div class="d-flex gap-1">
          <a href="./approvedorder.php?reject_id=<?php echo $fetch_order['order_id'] ?>" class="btn btn-danger  text-center mt-2">
            <i class="bi bi-x-circle me-2"></i> Reject Order
        </a>
        <?php if($fetch_order['book_format'] !== 'pdf'){ ?>
          <a href="./approvedorder.php?shipped_id=<?php echo $fetch_order['order_id'] ?>" class="btn btn-primary  text-center mt-2">
            <i class="bi bi-truck"></i> Shipped
        </a><br>
        <?php } ?>
      </div>
      
    </div>
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