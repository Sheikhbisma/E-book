<?php
include './components/homecontent.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Book World | Elegant Dark Theme 2025</title>
    
<?php include './components/meta-links.php' ?>   
<link rel="stylesheet" href="./css/user.css">
    
    <style>
        :root {
            --headings: #FFE082;
        }

        * {
            font-family: 'Cormorant Garamond', serif;
        }

    h1, h2, h3, h4, h5, h6 {
            font-family: 'Cinzel', serif;
            color: var(--headings) !important;
        }

</style>
</head>
<body>
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
                     <a class="nav-link active" href="./index.php">
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
                     <a class="nav-link" href="#">
                         <i class="fas fa-trophy me-1"></i> Competition
                     </a>
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
                         <li><a class="dropdown-item" href="../user/login.php"><i class="fas fa-sign-in-alt me-2"></i> Login</a></li>
                         <li><a class="dropdown-item" href="../user/register.php"><i class="fas fa-user-plus me-2"></i> Register</a></li>
                      
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
    <div class="hero">
        <div class="hero-content">
            <h1>Discover. Read. Compete.</h1>
            <p>Elegant dark library with floating book cards</p>
            <div class="mt-4">
                <button class="btn btn-lg me-3" style="background: var(--accent-gold); color: var(--wood-dark); font-weight: bold;">
                    <i class="fas fa-search me-2"></i>Browse Books
                </button>
                <button class="btn btn-lg btn-outline-light">
                    <i class="fas fa-user-plus me-2"></i>Join Free
                </button>
            </div>
        </div>
    </div>

    <!-- New Releases -->
    <section id="new" class="container py-5">
        <h2 class="section-title cream"><i class="fas fa-star me-2"></i>📘 New Releases</h2>
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
        <h2 class="section-title cream"><i class="fas fa-fire me-2"></i>🔥 Best Sellers</h2>
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
        <h2 class="section-title cream"><i class="fas fa-trophy me-2"></i>🏆 Upcoming Competitions</h2>
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
            <div class="col-md-4">
                <div class="winner-card">
                    <div class="winner-badge">2025</div>
                    <div class="card-body">
                        <h6 class="card-title woodendark">Short Story Winner</h6>
                        <p class="card-text mb-1"><strong>Winner:</strong> John Carter</p>
                        <p class="card-text mb-1"><strong>Story:</strong> "The Rising Dawn"</p>
                        <p class="card-text mb-1"><strong>Prize:</strong> $500 + Featured</p>
                        <p class="card-text small mt-2">"A masterpiece of modern storytelling with deep emotional resonance."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="winner-card">
                    <div class="winner-badge">2025</div>
                    <div class="card-body">
                        <h6 class="card-title woodendark">Poetry Champion</h6>
                        <p class="card-text mb-1"><strong>Winner:</strong> Alicia Gomez</p>
                        <p class="card-text mb-1"><strong>Collection:</strong> "Moonlight Whispers"</p>
                        <p class="card-text mb-1"><strong>Prize:</strong> $300 + Publication</p>
                        <p class="card-text small mt-2">"Lyrical beauty that captures the soul of contemporary poetry."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="winner-card">
                    <div class="winner-badge">2024</div>
                    <div class="card-body">
                        <h6 class="card-title woodendark">Essay Winner</h6>
                        <p class="card-text mb-1"><strong>Winner:</strong> Rohan Ali</p>
                        <p class="card-text mb-1"><strong>Essay:</strong> "Books vs E-Books"</p>
                        <p class="card-text mb-1"><strong>Prize:</strong> $400 + Certificate</p>
                        <p class="card-text small mt-2">"A balanced and insightful analysis of digital versus traditional reading."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="winner-card">
                    <div class="winner-badge">2024</div>
                    <div class="card-body">
                        <h6 class="card-title woodendark">Poetry Runner-up</h6>
                        <p class="card-text mb-1"><strong>Winner:</strong> Sara Khan</p>
                        <p class="card-text mb-1"><strong>Poem:</strong> "Silent Pages"</p>
                        <p class="card-text mb-1"><strong>Prize:</strong> $150 + Certificate</p>
                        <p class="card-text small mt-2">"Elegant verses that speak volumes in their silence."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="winner-card">
                    <div class="winner-badge">2023</div>
                    <div class="card-body">
                        <h6 class="card-title woodendark">Short Story Winner</h6>
                        <p class="card-text mb-1"><strong>Winner:</strong> Michael Lee</p>
                        <p class="card-text mb-1"><strong>Story:</strong> "Echoes of Yesterday"</p>
                        <p class="card-text mb-1"><strong>Prize:</strong> $500 + Featured</p>
                        <p class="card-text small mt-2">"A haunting narrative that stays with the reader long after the last page."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="winner-card">
                    <div class="winner-badge">2023</div>
                    <div class="card-body">
                        <h6 class="card-title woodendark">Essay Runner-up</h6>
                        <p class="card-text mb-1"><strong>Winner:</strong> Emma Wilson</p>
                        <p class="card-text mb-1"><strong>Essay:</strong> "Digital Literacy"</p>
                        <p class="card-text mb-1"><strong>Prize:</strong> $200 + Certificate</p>
                        <p class="card-text small mt-2">"A well-researched perspective on literacy in the digital age."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- footer -->
 <?php include './components/footer.php' ?>    
    <!-- Bootstrap JS Bundle -->
<?php include './components/script.php' ?>    

</body>
</html>