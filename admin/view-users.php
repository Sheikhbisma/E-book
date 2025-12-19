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
        :root {
            --dark-bg: #160d0a;
            --card-bg: #241713;
            --card-soft: #3a2621;
            --gold: #d4af37;
            --gold-soft: rgba(212, 175, 55, .35);
            --text: #fff8e1;
            --muted: #c7b299;
            --heading: #ffe082;
        }

        .sidebar {
            display: none !important;
        }

        .page-wrapper {
            padding: 70px 20px
        }

        /* ===== HEADING ===== */
        .section-heading {
            text-align: center;
            margin-bottom: 70px;
            animation: fadeDown .7s ease forwards
        }

        .section-heading span {
            padding: 8px 26px;
            border-radius: 40px;
            background: linear-gradient(135deg, var(--gold), #ffe082);
            color: #2b1e1a;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .section-heading h2 {
            margin-top: 15px;
            font-size: 40px;
            font-weight: 900;
            color: var(--gold);
            /* fallback color */
            background: linear-gradient(90deg, #ffe082, var(--gold));
            background-clip: text;
            color: transparent;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 15px;
        }

        /* ===== CARD ===== */
        .customer-card {
            position: relative;
            height: 100%;
            border-radius: 28px;
            background: linear-gradient(165deg, var(--card-bg), var(--dark-bg));
            border: 1px solid rgba(212, 175, 55, .25);
            overflow: hidden;
            transition: .45s ease;
            animation: fadeUp .7s ease forwards;
        }

        .customer-card::before {
            content: "";
            position: absolute;
            inset: -60%;
            background: linear-gradient(120deg, transparent 46%, rgba(212, 175, 55, .18), transparent 54%);
            animation: shine 7s linear infinite;
        }

        .customer-card:hover {
            transform: translateY(-14px) scale(1.05);
            box-shadow: 0 35px 80px rgba(0, 0, 0, .9), 0 0 40px var(--gold-soft);
        }

        /* ===== IMAGE ===== */
        .customer-img {
            width: 96px;
            height: 96px;
            border-radius: 22px;
            object-fit: cover;
            border: 3px solid var(--gold);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .75);
            transition: .4s ease;
        }

        .customer-card:hover .customer-img {
            transform: scale(1.1) rotate(-3deg);
        }

        /* ===== TEXT ===== */
        .name {
            color: var(--heading);
            font-weight: 800;
            margin-top: 6px;
        }

        .name:after {
            content: "";
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), transparent);
            display: block;
            margin: 8px auto;
        }

        .email {
            font-size: 13px;
            color: var(--muted)
        }

        /* ===== INFO ===== */
        .info-box {
            margin-top: 22px;
            padding: 18px 20px;
            border-radius: 20px;
            background: linear-gradient(180deg, var(--card-soft), var(--card-bg));
            box-shadow: inset 0 4px 16px rgba(0, 0, 0, .8);
            transition: .4s ease;
        }

        .customer-card:hover .info-box {
            box-shadow: inset 0 4px 16px rgba(0, 0, 0, .8), 0 0 22px rgba(212, 175, 55, .35);
        }

        .label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: var(--gold);
        }

        .value {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-25px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes shine {
            from {
                transform: translateX(-40%) rotate(25deg)
            }

            to {
                transform: translateX(40%) rotate(25deg)
            }
        }

        @media(max-width:768px) {
            .section-heading h2 {
                font-size: 30px
            }

            .customer-img {
                width: 80px;
                height: 80px
            }
        }
    </style>
</head>

<body>
    <?php include './sidebar.php'; ?>

    <div class="content-area">
        <div class="container page-wrapper">

            <div class="section-heading">
                <span>CUSTOMERS</span>
                <h2>Registered Customer Profiles</h2>
                <p>Elegant overview of all active and registered customers</p>
            </div>

            <div class="row g-4">
                <?php
                $query = "SELECT * FROM customer_register";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="customer-card">
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