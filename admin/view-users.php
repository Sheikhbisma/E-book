<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>

    <?php include './inc/link.php'; ?>

    <style>
        body{
            overflow-x: hidden;
        }

        /* Hide sidebar only this page */
        .sidebar{
            display: none !important;
        }

        .page-wrapper{
            padding: 60px 20px;
        }

        .customer-card{
            border-radius: 14px;
            transition: 0.3s ease;
        }

        .customer-card:hover{
            transform: translateY(-4px);
        }

        .customer-img{
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #ddd;
        }

        .label{
            font-size: 12px;
            color: #777;
        }

        .value{
            font-size: 14px;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px){
            .page-wrapper{
                padding: 40px 10px;
            }

            .customer-img{
                width: 70px;
                height: 70px;
            }
        }
    </style>
</head>

<body>

<?php include './sidebar.php'; ?>

<div class="content-area">
    <div class="container page-wrapper">

    <div class="text-center mb-4">
        <h5 class="fw-bold">Customer Register List</h5>
    </div>

    <div class="row g-4">

        <?php
        include '../auth/dbconnect.php';

        $query  = "SELECT * FROM customer_register";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <!-- CUSTOMER CARD -->
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
            <div class="card shadow customer-card h-100">
                <div class="card-body text-center">

                    <img src="../img/<?= $row['customer_image']; ?>" class="customer-img mb-3">

                    <h6 class="fw-bold mb-1"><?= $row['customer_name']; ?></h6>
                    <p class="text-muted mb-2"><?= $row['customer_email']; ?></p>

                    <hr>

                    <div class="text-start">
                        <div class="mb-2">
                            <span class="label">Customer ID</span><br>
                            <span class="value"><?= $row['customer_id']; ?></span>
                        </div>

                        <div class="mb-2">
                            <span class="label">Contact</span><br>
                            <span class="value"><?= $row['customer_contact']; ?></span>
                        </div>

                        <div class="mb-2">
                            <span class="label">Address</span><br>
                            <span class="value"><?= $row['customer_address']; ?></span>
                        </div>

                        <div>
                            <span class="label">Location</span><br>
                            <span class="value"><?= $row['customer_location']; ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php
            }
        } else {
            echo "<div class='col-12 text-center'>No Customers Found</div>";
        }
        ?>

    </div>
</div>

</div>
<script src="../js/admin.js"></script>
</body>
</html>
