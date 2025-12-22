<?php
session_start();
include './components/homecontent.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Book World | Elegant Dark Theme 2025</title>

    <?php include './components/meta-links.php'; ?>
    <link rel="stylesheet" href="./css/user.css">

    <style>
        :root {
            --headings: #FFE082;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--headings) !important;
        }

        /* ================= HERO SECTION ================= */
        .hero-section {
            min-height: 100vh;
            padding-top: 120px;
            padding-bottom: 80px;
            display: flex;
            align-items: center;
            background: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.65),
                rgba(0, 0, 0, 0.9)
            );
        }

        .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 700;
            line-height: 1.2;
            max-width: 720px;
        }

        .hero-subtitle {
            margin-top: 15px;
            font-size: 1.05rem;
            color: #cfcfcf;
            max-width: 640px;
            line-height: 1.6;
        }

        .hero-btn {
            margin-top: 25px;
            background: var(--accent-gold);
            color: var(--wood-dark);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            display: inline-block;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .hero-btn:hover {
            background: #ffd54f;
            color: #000;
            transform: translateY(-2px);
        }

        .hero-section * {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        @media (max-width: 768px) {
            .hero-section {
                text-align: center;
                padding-top: 110px;
            }

            .hero-title,
            .hero-subtitle {
                margin-left: auto;
                margin-right: auto;
            }
        }
        /* ================================================= */
    </style>
</head>

<body class="pt">

<!-- NAVBAR -->
<?php include './components/navbar.php'; ?>

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h1 class="hero-title">
                    Discover. Read. Compete.
                </h1>

                <p class="hero-subtitle">
                    Elegant dark-themed digital library where you can explore books,
                    join competitions, and enhance your reading experience.
                </p>

                <a href="./books/index.php" class="hero-btn">
                    <i class="fas fa-search me-2"></i>Browse Books
                </a>
            </div>
        </div>
    </div>
</section>

<!-- NEW RELEASES -->
<section id="new" class="container py-5">
    <h2 class="section-title cream">📘 New Releases</h2>
    <div class="row g-4">
        <?php while($new_release = mysqli_fetch_assoc($new)){ ?>
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="./<?php echo $new_release['cover_image']; ?>" loading="lazy">
                    <h6 class="woodendark"><?php echo $new_release['title']; ?></h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-success">New</span>
                        <span class="badge bg-primary"><?php echo $new_release['category']; ?></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<!-- BEST SELLERS -->
<section id="best" class="container py-5">
    <h2 class="section-title cream">🔥 Best Sellers</h2>
    <div class="row g-4">
        <?php while($best_seller = mysqli_fetch_assoc($best)){ ?>
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="./<?php echo $best_seller['cover_image']; ?>" loading="lazy">
                    <h6 class="woodendark"><?php echo $best_seller['title']; ?></h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-success">Best Seller</span>
                        <span class="badge bg-primary"><?php echo $best_seller['category']; ?></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<!-- FOOTER -->
<?php include './components/footer.php'; ?>
<?php include './components/script.php'; ?>

