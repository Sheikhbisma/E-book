    <?php include './components/homecontent.php' ?>

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
            --wood-dark: #5D4037;
            --wood-medium: #8D6E63;
            --wood-light: #D7CCC8;
            --accent-gold: #D4AF37;
            --paper-cream: #FFF8E1;
            --headings: #FFE082;
            --bg-dark: #1A252F;
        }

        * {
            font-family: 'Cormorant Garamond', serif;
        }

    

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cinzel', serif;
            color: var(--headings) !important;
        }

        /* Navbar */
        .navbar {
            background: 
                url('https://www.transparenttextures.com/patterns/dark-wood.png'),
                linear-gradient(to bottom, var(--wood-dark), #3E2723);
            border-bottom: 3px solid var(--accent-gold);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
        }

        .navbar-brand {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            color: var(--headings) !important;
            font-weight: 700;
        }

        .nav-link {
            color: var(--wood-light) !important;
            font-weight: 600;
            padding: 0.5rem 1.5rem !important;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent-gold) !important;
            border-bottom: 2px solid var(--accent-gold);
        }
/* Footer */
        footer {
            background: 
                url('https://www.transparenttextures.com/patterns/dark-wood.png'),
                linear-gradient(to top, var(--wood-dark), #3E2723);
            border-top: 5px solid var(--wood-medium);
            margin-top: 4rem;
            padding: 3rem 0;
            color: var(--wood-light);
        }

        footer h5 {
            color: var(--headings) !important;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        footer a {
            color: var(--wood-light) !important;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        footer a:hover {
            color: var(--accent-gold) !important;
            transform: translateX(5px);
        }

        footer .small {
            color: var(--wood-light);
            opacity: 0.8;
        }

        /* Utility Classes */
        .cream { color: var(--paper-cream) !important; }
        .woodendark { color: var(--wood-dark) !important; }
        .golden { color: var(--accent-gold) !important; }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
            
            .book-card img {
                height: 250px;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
  <?php include './components/header.php' ?>

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
            <!-- include php file -->
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
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=600&fit=crop" alt="Book 2" loading="lazy">
                    <h6 class="woodendark">Science Today</h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-success me-1">New</span>
                        <span class="badge bg-info">Science</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="https://images.unsplash.com/photo-1526318472351-c6f1b411b196?w=400&h=600&fit=crop" alt="Book 3" loading="lazy">
                    <h6 class="woodendark">Dream of Oceans</h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-success me-1">New</span>
                        <span class="badge bg-warning">Adventure</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=400&h=600&fit=crop" alt="Book 4" loading="lazy">
                    <h6 class="woodendark">Ancient Secrets</h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-success me-1">New</span>
                        <span class="badge bg-secondary">History</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Sellers -->
    <section id="best" class="container py-5">
        <h2 class="section-title cream"><i class="fas fa-fire me-2"></i>🔥 Best Sellers</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400&h=600&fit=crop" alt="Book 6" loading="lazy">
                    <h6 class="woodendark">Mystery of the Night</h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-danger me-1">Bestseller</span>
                        <span class="badge bg-dark">Mystery</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="https://images.unsplash.com/photo-1496104679561-38d6cd969e10?w=400&h=600&fit=crop" alt="Book 7" loading="lazy">
                    <h6 class="woodendark">Art of Living</h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-danger me-1">Bestseller</span>
                        <span class="badge bg-success">Self-Help</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=600&fit=crop" alt="Book 8" loading="lazy">
                    <h6 class="woodendark">Great Thinkers</h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-danger me-1">Bestseller</span>
                        <span class="badge bg-primary">Philosophy</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="book-card card">
                    <img src="https://images.unsplash.com/photo-1528207776546-365bb710ee93?w=400&h=600&fit=crop" alt="Book 9" loading="lazy">
                    <h6 class="woodendark">World of Wonders</h6>
                    <div class="text-center pb-3">
                        <span class="badge bg-danger me-1">Bestseller</span>
                        <span class="badge bg-info">Science</span>
                    </div>
                </div>
            </div>
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

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-compass me-2"></i>Explore</h5>
                    <a href="#new"><i class="fas fa-arrow-right me-1"></i>New Releases</a><br>
                    <a href="#best"><i class="fas fa-arrow-right me-1"></i>Best Sellers</a><br>
                    <a href="#competitions"><i class="fas fa-arrow-right me-1"></i>Competitions</a><br>
                    <a href="#winners"><i class="fas fa-arrow-right me-1"></i>Winners</a><br>
                    <a href="./books/index.php"><i class="fas fa-arrow-right me-1"></i>All Books</a>
                </div>
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-user me-2"></i>User</h5>
                    <a href="#"><i class="fas fa-sign-in-alt me-1"></i>Login</a><br>
                    <a href="#"><i class="fas fa-user-plus me-1"></i>Register</a><br>
                    <a href="#"><i class="fas fa-heart me-1"></i>Wishlist</a><br>
                    <a href="#"><i class="fas fa-history me-1"></i>Reading History</a>
                </div>
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-info-circle me-2"></i>About</h5>
                    <p class="small">A premium e-book portal designed with elegance. Discover timeless stories, participate in literary competitions, and join a community of passionate readers.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-light fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light fs-5"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light fs-5"><i class="fab fa-goodreads"></i></a>
                    </div>
                </div>
            </div>
            <hr style="border-color: var(--wood-medium);">
            <p class="text-center small mt-4">&copy; 2026 E-Book World | Premium Literary Platform</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    

</body>
</html>