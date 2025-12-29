<?php
session_start();
include './components/homecontent.php';

if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
totalItems($conn , $user_id);
}
$logIn = $_SESSION['userid'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Book World | Elegant Dark Theme 2025</title>
    
<?php include './components/meta-links.php' ?>   
<link rel="stylesheet" href="./css/user.css">
    <style>
    /* ===== NAVBAR UI IMPROVEMENT ===== */



</style>
</head>
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

             <ul class="navbar-nav ms-auto align-items-center gap-2">
                 <li class="nav-item">
                     <a class="nav-link" href="./index.php">
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
                         <i class="fas fa-gift me-1"></i> Contact
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
            <a class="dropdown-item" href="./dealer/dealer.php">
                <i class="fas fa-user-tie me-2"></i> Dealer sawera
            </a>
        </li>
        
    </ul>
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
                               <li><a class="dropdown-item" href="./user/register.php"><i class="fas fa-bookmark me-2"></i> Register</a></li>
                      <?php } ?>
                      
                        <?php if(isset($_SESSION['username'])){ ?>
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

  
   <!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <h1>welcome to our <br>premium e-book store</h1>
                <p>
                    A premium dark-themed digital library where books, competitions,
                    and creativity come together. Explore the future of reading.
                </p>
                <div class="mt-4">
                    <a href="./books/index.php" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-rocket me-2"></i>Explore Now
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="hero-image-wrap text-center">
    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?q=80&w=1000&auto=format&fit=crop" 
         class="img-fluid" 
         alt="Elite E-books" 
         style="filter: drop-shadow(0 0 30px rgba(255,193,7,0.3)); border-radius: 15px; max-width: 80%;">
</div>
            </div>
        </div>
    </div>
</section>


    <!-- New Releases -->
    <section id="new" class="container py-5">
        <h2 class="section-title cream"><i class="fas fa-star me-2"></i> New Releases</h2>
        <div class="row g-4">
            <!-- fetch books -->
           <?php while($new_release = mysqli_fetch_assoc($new)){ ?>
                   <div class="col-md-3">
                <div class="book-card card">
                    <img src="./<?php echo $new_release['cover_image'] ?>" alt="Book 1" loading="lazy">
                    <h6 class="woodendark"><?php echo $new_release['title'] ?></h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-success me-1">New</span>
                        <span class="badge bg-primary"><?php echo $new_release['category'] ?></span>
                    </div>
                </div>
            </div>

            <?php } ?>

    </section>
 
    <!-- Best Sellers -->
    <section id="best" class="container py-5">
        <h2 class="section-title cream"><i class="fas fa-fire me-2"></i> Best Sellers</h2>
        <div class="row g-4">
              <!-- fetch books -->
           <?php while($best_seller = mysqli_fetch_assoc($best)){ ?>
                   <div class="col-md-3">
                <div class="book-card card">
                    <img src="./<?php echo $best_seller['cover_image'] ?>" alt="Book 1" loading="lazy">
                    <h6 class="woodendark"><?php echo $best_seller['title'] ?></h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-success me-1">Best Seller</span>
                        <span class="badge bg-primary"><?php echo $best_seller['category'] ?></span>
                    </div>
                </div>
            </div>

            <?php } ?>

        </div>
    </section>

    <!-- Upcoming Competitions -->
    <section id="competitions" class="container py-5">
        <h2 class="section-title cream"><i class="fas fa-trophy me-2"></i> Upcoming Competitions</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="competition-card">
                    <div class="card-body">
                        <h5 class="card-title woodendark"><i class="fas fa-pen-fancy me-2"></i>Short Story Writing Contest</h5>
                        <p class="card-text mb-2"><strong>Type:</strong> Fiction / Creative Writing</p>
                        <p class="card-text mb-2"><strong>Start Date:</strong> March 10, 2026</p>
                        <p class="card-text mb-2"><strong>Prize:</strong> $500 + E-Voucher</p>
                        <p class="card-text small">Write a short story (max 3000 words). Winner gets e-voucher & homepage feature.</p>
                        <button class="btn btn-sm mt-2" style="background: var(--accent-gold); color: var(--wood-dark);">
                            <i class="fas fa-edit me-1"></i>Submit Entry
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="competition-card">
                    <div class="card-body">
                        <h5 class="card-title woodendark"><i class="fas fa-feather me-2"></i>Poetry Championship</h5>
                        <p class="card-text mb-2"><strong>Type:</strong> Poetry (Urdu / English)</p>
                        <p class="card-text mb-2"><strong>Start Date:</strong> April 5, 2026</p>
                        <p class="card-text mb-2"><strong>Prize:</strong> Publication + $300</p>
                        <p class="card-text small">Submit up to 3 poems. Best poems will be published online.</p>
                        <button class="btn btn-sm mt-2" style="background: var(--accent-gold); color: var(--wood-dark);">
                            <i class="fas fa-edit me-1"></i>Submit Entry
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="competition-card">
                    <div class="card-body">
                        <h5 class="card-title woodendark"><i class="fas fa-book me-2"></i>Novel Synopsis Contest</h5>
                        <p class="card-text mb-2"><strong>Type:</strong> Novel Synopsis</p>
                        <p class="card-text mb-2"><strong>Start Date:</strong> May 20, 2026</p>
                        <p class="card-text mb-2"><strong>Prize:</strong> Publishing Support</p>
                        <p class="card-text small">Submit a 500-word synopsis. Winner may get publishing support.</p>
                        <button class="btn btn-sm mt-2" style="background: var(--accent-gold); color: var(--wood-dark);">
                            <i class="fas fa-edit me-1"></i>Submit Entry
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="competition-card">
                    <div class="card-body">
                        <h5 class="card-title woodendark"><i class="fas fa-file-alt me-2"></i>Essay Writing Contest</h5>
                        <p class="card-text mb-2"><strong>Type:</strong> Non-Fiction / Essay</p>
                        <p class="card-text mb-2"><strong>Start Date:</strong> June 1, 2026</p>
                        <p class="card-text mb-2"><strong>Prize:</strong> $400 + Certificate</p>
                        <p class="card-text small">Topic: "Future of Reading in Digital Age". Max length: 1500 words.</p>
                        <button class="btn btn-sm mt-2" style="background: var(--accent-gold); color: var(--wood-dark);">
                            <i class="fas fa-edit me-1"></i>Submit Entry
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- Winners -->
    <section id="winners" class="container py-5">
        <h2 class="section-title cream"><i class="fas fa-award me-2"></i>🏅 Recent Winners</h2>
        <div class="row g-4">
            <?php  while($selectwinner=mysqli_fetch_assoc($winner)){ ?>
            <div class="col-md-4">
                <div class="winner-card">
                    <div class="winner-badge">2025</div>
                    <div class="card-body">
                        <h6 class="card-title woodendark">Adult Writting Winner</h6>
                        <p class="card-text mb-1"><strong>Winner:</strong> <?php echo $selectwinner['name']?></p>
                        <p class="card-text mb-1"><strong>Story:</strong> "Express Yourself"</p>
                        <p class="card-text mb-1"><strong>Prize:</strong> <?php echo "$".$prize['value'] .".00" ?></p>
                        <p class="card-text small mt-2">"A masterpiece of modern storytelling with deep emotional resonance."</p>
                    </div>
                </div>
            </div>
            <?php }?>
        
        </div>
         <br>
         <div class="row g-4">
            <?php  while($selectwinner=mysqli_fetch_assoc($children)){ ?>
            <div class="col-md-4">
                <div class="winner-card">
                    <div class="winner-badge">2025</div>
                    <div class="card-body">
                        <h6 class="card-title woodendark">Essay Writting Winner</h6>
                        <p class="card-text mb-1"><strong>Winner:</strong><?php echo $selectwinner['customer_name']?></p>
                        <p class="card-text mb-1"><strong>Story:</strong> <?php echo $selectwinner['topic']?></p>
                        <p class="card-text mb-1"><strong>Prize:</strong> <?php echo "$".$adultPrize['value'] .".00" ?></p>
                        <p class="card-text small mt-2"> <?php echo $selectwinner['essay_text']?></p>
                    </div>
                </div>
            </div>
            <?php }?>
         
        </div>

        
        
    </section>
<!-- modal -->
 <div class="modal fade" id="modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header header">
        <h5 class="modal-title fw-bold">Welcome To The Ebook Website</h5>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 card">

  <div class="row align-items-center">

    <!-- Text Section -->
    <div class="col-md-7">
      <p class="woodendark fw-semibold">
        Free books are generously provided by the authors for our readers.
        To access and enjoy these books, please log in or create an account from the
        <strong>Account</strong> section in the navigation bar.
        After logging in, you can visit your <strong>Dashboard</strong> and start exploring your free library.
      </p>

      <div class="mt-3">
        <a href="./user/login.php" class="btn btn-custom me-2">Login</a>
        <a href="./user/register.php" class="btn btn-gold">Register</a>
      </div>
    </div>

    <!-- Image Section -->
    <div class="col-md-5 text-center">
      <img src="./img/1765293894_watchmen.jpg" class="img-fluid rounded shadow" alt="">
    </div>

  </div>

</div>

     
    </div>
  </div>
</div>
<!-- footer -->
 <?php include './components/footer.php' ?>    
    <!-- Bootstrap JS Bundle -->
<?php include './components/script.php' ?>  
<script>
document.addEventListener('DOMContentLoaded', function() {
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
});
window.onload = function () {
    let logIn = <?php echo $logIn ? 'true' : 'false' ?>;
    if(!logIn){
    setTimeout(() => {
        const modal = new bootstrap.Modal(document.getElementById('modal'));
        modal.show();
    }, 1000);
}
};

</script>



</body>
</html>

