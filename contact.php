<?php
include "./auth/dbconnect.php";
session_start();
if (isset($_POST['submit'])) {

    $name    = $conn->real_escape_string($_POST['name']);
    $email   = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql)) {
        echo "<script>alert('Your message has been sent successfully! We will contact you soon');</script>";
        echo "<script>window.location.href='contact.php';</script>";
        exit;
    } else {
        echo "<script>alert('Something went wrong!');</script>";
        echo "<script>window.location.href='contact.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './components/meta-links.php' ?>
    <link rel="stylesheet" href="./css/user.css">


</head>
<style>
    /* --- Simple Responsive CSS --- */
.wrapper {
    display: flex;       /* Laptop par side-by-side karne ke liye */
    flex-wrap: wrap;    /* Mobile par niche bhejane ke liye */
    gap: 20px;         
    color: black;
}

.left, .right {
    flex: 1 1 350px;    /* 350px se screen choti hote hi niche aa jayega */
}

/* Mobile Fix */
@media (max-width: 768px) {
    .wrapper {
        flex-direction: column; /* Mobile par stack (upar-niche) */
    }
    .left, .right {
        width: 100%;           /* Mobile par poori width */
    }
}

/* Form Inputs Fix */
input, textarea {
    width: 100%;               /* Inputs box se bahar na niklein */
    box-sizing: border-box;    /* Padding ko width ke andar rakhne ke liye */
    color: black;
}
</style>


<body class="pt">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-book-open me-2"></i>E-Book
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Mobile Search Box -->

                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link " href="./index.php">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./books/index.php">
                            <i class="fas fa-book me-1"></i> Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./books/categories.php">
                            <i class="fas fa-th-large me-1"></i> Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">
                            <i class="fas fa-envelope me-1"></i> Contact
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./competition/user_dashboard.php">
                            <i class="fas fa-trophy me-1"></i> Competition
                        </a>
                    </li>
   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="dealerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user-circle me-1"></i> Dealer
    </a>

    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dealerDropdown">
        <li>
            <a class="dropdown-item" href="../dealer/dealer.php">
                <i class="fas fa-user-tie me-2"></i> Dealer sawera
            </a>
        </li>
        
    </ul>
</li>
                    <div class="d-flex gap-2 ms-5">
                        <!-- Cart Icon -->
                        <li class="nav-item">
                            <a class="nav-link cart-icon" href="./user/cart.php">
                                <i class="fas fa-shopping-cart fs-5 position-relative">
                                    <?php if (isset($_SESSION['totalProducts'])) { ?>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            <?php echo $_SESSION['totalProducts']; ?>
                                        </span>
                                    <?php } ?>
                                </i>

                            </a>
                        </li>

                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> Account
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                               <?php if(!isset($_SESSION['username'])){ ?>
                              <li><a class="dropdown-item" href="./user/login.php"><i class="fas fa-sign-in-alt me-2"></i> Login</a></li>
                               <li><a class="dropdown-item" href="./user/dashboard.php"><i class="fas fa-bookmark me-2"></i> Register</a></li>
                      <?php } ?>

                                <?php if (isset($_SESSION['username'])) { ?>
                                    <li><a class="dropdown-item" href="./user/dashboard.php"><i class="fas fa-bookmark me-2"></i> My Dashboard</a></li>

                                    <li><a class="dropdown-item" href="./user/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </nav>


    <section class="mt-5">
        <div class="wrapper mx-auto">

            <!-- LEFT FORM -->
            <div class="left card">
                <h2 class="woodendark">Contact Us</h2>

                <form method="POST">
                    <input type="text" name="name" placeholder="Enter your name" required>
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <textarea name="message" placeholder="Enter your message" required></textarea>

                    <button type="submit" class="btn-custom" name="submit">Send Message</button>
                </form>
            </div>

            <!-- RIGHT SIDE INFORMATION -->
            <div class="right">
                <h3 class="cream">Get in Touch</h3>

                <div class="info-box"><i class="fa fa-phone woodendark"></i> +92 300 0000000</div>
                <div class="info-box"><i class="fa fa-envelope woodendark"></i> info@example.com</div>
                <div class="info-box"><i class="fa fa-location-dot woodendark"></i> Karachi, Pakistan</div>

                <h3 style="margin-top:25px;" class="cream">Follow Us</h3>

                <div class="social-icons">
                    <a href="#" class="btn-custom"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn-custom"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn-custom"><i class="fab fa-facebook-f "></i></a>
                    <a href="#" class="btn-custom"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

        </div>
    </section>
    <?php include './components/footer.php' ?>
    <?php include './components/script.php' ?>
<script>
const currentPath = window.location.pathname;
const navLinks = document.querySelectorAll('.navbar .nav-link');

navLinks.forEach(link => {
    const linkHref = link.getAttribute('href');

    // Ignore dropdown toggles (#)
    if (!linkHref || linkHref === '#') return;

    const linkPath = new URL(link.href, window.location.origin).pathname;

    if (currentPath === linkPath) {
        link.classList.add('active');

        // If inside dropdown, highlight parent too
        const parentDropdown = link.closest('.dropdown');
        if (parentDropdown) {
            parentDropdown.querySelector('.dropdown-toggle')?.classList.add('active');
        }
    }
});
</script>


</body>

</html>