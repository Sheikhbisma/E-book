<?php
include './session.php';
include '../auth/dbconnect.php';

// ===== DELETE LOGIC =====
if (isset($_GET['delete_id'])) {
    $del_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM customer_register WHERE customer_id = '$del_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Customer Deleted Successfully'); window.location='customers.php';</script>";
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers | Admin Portal</title>

    <?php include './inc/link.php'; ?>

    <style>
        :root {
            --dark-bg: #160d0a;
            --card-bg: #241713;
            --card-soft: #3a2621;
            --gold: #d4af37;
            --gold-soft: rgba(212, 175, 55, .35);
            --text: #fff8e1;
            --muted: #c7b299;
            --heading: #ffe082;
            --danger: #ff4d4d;
            --success: #2ecc71;
        }

        .sidebar { display: none !important; }
        .page-wrapper { padding: 70px 20px }

        /* ===== HEADING ===== */
        .section-heading { text-align: center; margin-bottom: 70px; animation: fadeDown .7s ease forwards }
        .section-heading span {
            padding: 8px 26px; border-radius: 40px;
            background: linear-gradient(135deg, var(--gold), #ffe082);
            color: #2b1e1a; font-size: 12px; font-weight: 800; letter-spacing: 2px;
        }
        .section-heading h2 {
            margin-top: 15px; font-size: 40px; font-weight: 900;
            background: linear-gradient(90deg, #ffe082, var(--gold));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        /* ===== CARD ===== */
        .customer-card {
            position: relative; height: 100%; border-radius: 28px;
            background: linear-gradient(165deg, var(--card-bg), var(--dark-bg));
            border: 1px solid rgba(212, 175, 55, .25); overflow: hidden;
            transition: .45s ease; animation: fadeUp .7s ease forwards;
        }

        .customer-card:hover {
            transform: translateY(-14px) scale(1.02);
            box-shadow: 0 35px 80px rgba(0, 0, 0, .9), 0 0 40px var(--gold-soft);
        }

        /* ===== IMAGE ===== */
        .customer-img {
            width: 90px; height: 90px; border-radius: 50%;
            object-fit: cover; border: 3px solid var(--gold);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .5);
        }

        /* ===== ACTION BUTTONS ===== */
        .action-area {
            display: flex; gap: 10px; justify-content: center; margin-top: 15px;
            padding-top: 15px; border-top: 1px solid rgba(212, 175, 55, 0.1);
        }

        .btn-action {
            width: 40px; height: 40px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            transition: 0.3s; text-decoration: none; border: none;
        }

        .btn-edit { background: rgba(46, 204, 113, 0.1); color: var(--success); border: 1px solid var(--success); }
        .btn-edit:hover { background: var(--success); color: #fff; }

        .btn-del { background: rgba(255, 77, 77, 0.1); color: var(--danger); border: 1px solid var(--danger); }
        .btn-del:hover { background: var(--danger); color: #fff; }

        /* ===== INFO BOX ===== */
        .info-box {
            margin-top: 15px; padding: 15px; border-radius: 18px;
            background: rgba(0,0,0,0.3); box-shadow: inset 0 2px 10px rgba(0,0,0,0.5);
        }

        .label { font-size: 10px; color: var(--gold); font-weight: 700; }
        .value { font-size: 13px; color: var(--text); }
        .name { color: var(--heading); font-weight: 800; font-size: 18px; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(25px) } to { opacity: 1; transform: translateY(0) } }
        @keyframes fadeDown { from { opacity: 0; transform: translateY(-25px) } to { opacity: 1; transform: translateY(0) } }
    </style>
</head>

<body>
    <?php include './sidebar.php'; ?>

    <div class="content-area">
        <div class="container page-wrapper">

            <div class="section-heading">
                <span>ADMIN CONTROL</span>
                <h2>Customer Management</h2>
                <p>Monitor and manage all registered user accounts</p>
            </div>

            <div class="row g-4">
                <?php
                $query = "SELECT * FROM customer_register";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="customer-card p-4">
                                <div class="text-center">
                                    <img src="../img/<?= $row['customer_image']; ?>" class="customer-img mb-3">
                                    <h6 class="name mb-0"><?= $row['customer_name']; ?></h6>
                                    <div class="email mb-2 text-truncate"><?= $row['customer_email']; ?></div>
                                    
                                    <div class="action-area">
                                        <a href="edit_customer.php?id=<?= $row['customer_id']; ?>" class="btn-action btn-edit" title="Edit Profile">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="?delete_id=<?= $row['customer_id']; ?>" 
                                           onclick="return confirm('Bhai, kya aap sach mein is customer ko delete karna chahte hain?')" 
                                           class="btn-action btn-del" title="Delete Customer">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="info-box">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <span class="label">ID:</span><br>
                                            <span class="value">#<?= $row['customer_id']; ?></span>
                                        </div>
                                        <div class="col-6">
                                            <span class="label">CONTACT:</span><br>
                                            <span class="value"><?= $row['customer_contact']; ?></span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <span class="label">LOCATION:</span><br>
                                            <span class="value"><i class="fas fa-map-marker-alt me-1"></i> <?= $row['customer_location']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } else { ?>
                    <div class="col-12 text-center text-muted">No Customers Found</div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="../js/admin.js"></script>
</body>
</html>