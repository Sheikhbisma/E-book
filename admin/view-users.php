
<?php
include './session.php';
include '../auth/dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>

    <?php include './inc/link.php'; ?>

    <style>
        :root{
            /* Auto-match with Sidebar Theme (no page/background change) */
            --card-bg: var(--sidebar-bg, #1e1e2f);
            --card-accent: var(--sidebar-primary, #4f46e5);
            --card-accent-soft: color-mix(in srgb, var(--card-accent) 20%, transparent);
            --card-text: var(--sidebar-text, #ffffff);
            --card-muted: var(--sidebar-muted, #b8b8d9);
            --card-border: color-mix(in srgb, var(--card-accent) 30%, #000);
        }

        body{ overflow-x:hidden; background:#f5f6f8; }

        /* Hide sidebar only this page */
        .sidebar{ display:none !important; }

        .page-wrapper{ padding:60px 20px; }

        /* CARD UI */
        .customer-card{
            border:1px solid var(--card-border);
            border-radius:20px;
            background:linear-gradient(160deg,
                color-mix(in srgb, var(--card-bg) 92%, #000),
                color-mix(in srgb, var(--card-bg) 70%, var(--card-accent))
            );
            transition:all .35s ease;
            position:relative;
            overflow:hidden;
        }

        .customer-card::before{
            content:"";
            position:absolute;
            inset:0;
            background:linear-gradient(120deg, transparent 20%, var(--card-accent-soft), transparent 80%);
            opacity:.9;
        }

        .customer-card:hover{
            transform:translateY(-8px);
            box-shadow:0 30px 60px rgba(0,0,0,.55),
                       0 0 0 1px var(--card-accent-soft);
        }

        .customer-img{
            width:90px;
            height:90px;
            border-radius:14px;
            object-fit:cover;
            border:3px solid var(--card-accent);
            box-shadow:0 10px 25px rgba(0,0,0,.45);
            background:#111;
        }

        .name{ color:var(--card-text); font-weight:700; letter-spacing:.4px; }
        .email{ font-size:13px; color:var(--card-muted); }

        .info-box{
            background:linear-gradient(180deg,
                color-mix(in srgb, var(--card-bg) 85%, #000),
                color-mix(in srgb, var(--card-bg) 70%, #000)
            );
            border-radius:14px;
            padding:14px 16px;
            box-shadow:inset 0 2px 8px rgba(0,0,0,.6);
        }

        .label{ font-size:11px; color:var(--card-muted); letter-spacing:.6px; font-weight:600; }
        .value{ font-size:14px; font-weight:600; color:var(--card-text); }

        /* Responsive */
        @media(max-width:768px){
            .page-wrapper{ padding:40px 12px; }
            .customer-img{ width:75px; height:75px; }
        }
    </style>
</head>
<body>

<?php include './sidebar.php'; ?>

<div class="content-area">
    <div class="container page-wrapper">

        <div class="text-center mb-5">
            <h4 class="fw-bold">Customer Register List</h4>
            <p class="text-muted small">All registered customers overview</p>
        </div>

        <div class="row g-4">

        <?php
        include '../auth/dbconnect.php';
        $query  = "SELECT * FROM customer_register";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
        ?>

        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
            <div class="customer-card h-100">
                <div class="card-body text-center pt-4">

                    <img src="../img/<?= $row['customer_image']; ?>" class="customer-img mb-3">

                    <h6 class="name mb-0"><?= $row['customer_name']; ?></h6>
                    <div class="email mb-3"><?= $row['customer_email']; ?></div>

                    <div class="info-box text-start">
                        <div class="mb-2">
                            <span class="label">CUSTOMER ID</span><br>
                            <span class="value"><?= $row['customer_id']; ?></span>
                        </div>
                        <div class="mb-2">
                            <span class="label">CONTACT</span><br>
                            <span class="value"><?= $row['customer_contact']; ?></span>
                        </div>
                        <div class="mb-2">
                            <span class="label">ADDRESS</span><br>
                            <span class="value"><?= $row['customer_address']; ?></span>
                        </div>
                        <div>
                            <span class="label">LOCATION</span><br>
                            <span class="value"><?= $row['customer_location']; ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php } } else { ?>
            <div class="col-12 text-center text-muted">No Customers Found</div>
        <?php } ?>

        </div>
    </div>
</div>

<script src="../js/admin.js"></script>
</body>
</html>
