<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>E-Book World | Elegant Dark Theme 2025</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #000000, #222222);
    color: #fff;
    margin: 0;
    padding-top: 70px; /* navbar height */
  }

  /* Navbar */
  .navbar {
    background-color: #111;
    padding: 15px 0;
  }
  .navbar-brand { color: #fff !important; font-size: 1.7rem; font-weight: 700; }
  .nav-link { color: #ddd !important; margin-left: 15px; }
  .nav-link:hover { color: #fff !important; }

  /* Hero */
  .hero {
    background: #000 url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1200&h=600&fit=crop') center/cover no-repeat;
    height: 60vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    color: #fff;
  }
  .hero::after { content: ''; position: absolute; inset: 0; background: rgba(0,0,0,0.6); }
  .hero-content { position: relative; text-align: center; }
  .hero h1 { font-size: 3rem; font-weight: 700; color: #fff; }
  .hero p { font-size: 1.2rem; color: #ccc; }

  /* Section Titles */
  .section-title { font-weight: 700; color: #fff; border-left: 5px solid #fff; padding-left: 12px; margin-bottom: 25px; }

  /* Book Cards */
  .book-card {
    background-color: #111;
    border-radius: 12px;
    padding: 10px;
    text-align: center;
    box-shadow: 0 10px 20px rgba(255,255,255,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .book-card:hover { transform: translateY(-15px); box-shadow: 0 20px 30px rgba(255,255,255,0.25); }
  .book-card img { width: 100%; height: 250px; object-fit: cover; border-radius: 10px; margin-bottom: 10px; }
  .book-card h6 { color: #fff; }

  /* Competitions & Winners Cards */
  .card { border-radius: 12px; }
  .card-body h5, .card-body h6 { color: #fff; }
  .card-body p { color: #ccc; }

  /* Footer */
  footer { background-color: #111; color: #ccc; padding: 40px 0; }
  footer h5 { color: #fff; margin-bottom: 15px; }
  footer a { text-decoration: none; color: #ccc; }
  footer a:hover { color: #fff; }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">E-Book World</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#new">New Releases</a></li>
        <li class="nav-item"><a class="nav-link" href="#best">Best Sellers</a></li>
        <li class="nav-item"><a class="nav-link" href="#competitions">Competitions</a></li>
        <li class="nav-item"><a class="nav-link" href="#winners">Winners</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Register</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<div class="hero">
  <div class="hero-content">
    <h1>Discover. Read. Compete.</h1>
    <p>Elegant dark library with floating book cards</p>
  </div>
</div>

<!-- New Releases -->
<section id="new" class="container py-5">
  <h2 class="section-title">📘 New Releases</h2>
  <div class="row g-4">
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1528207776546-365bb710ee93?w=400&h=600&fit=crop" alt="Book 1" loading="lazy">
      <h6>The Rising Dawn</h6>
    </div></div>
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=600&fit=crop" alt="Book 2" loading="lazy">
      <h6>Science Today</h6>
    </div></div>
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1526318472351-bc6f1b411196?w=400&h=600&fit=crop" alt="Book 3" loading="lazy">
      <h6>Dream of Oceans</h6>
    </div></div>
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=400&h=600&fit=crop" alt="Book 4" loading="lazy">
      <h6>Ancient Secrets</h6>
    </div></div>
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1528207776546-365bb710ee93?w=400&h=600&fit=crop" alt="Book 5" loading="lazy">
      <h6>Digital Legacy</h6>
    </div></div>
  </div>
</section>

<!-- Best Sellers -->
<section id="best" class="container py-5">
  <h2 class="section-title">🔥 Best Sellers</h2>
  <div class="row g-4">
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400&h=600&fit=crop" alt="Book 6" loading="lazy">
      <h6>Mystery of the Night</h6>
    </div></div>
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1496104679561-38d6cd969e10?w=400&h=600&fit=crop" alt="Book 7" loading="lazy">
      <h6>Art of Living</h6>
    </div></div>
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=600&fit=crop" alt="Book 8" loading="lazy">
      <h6>Great Thinkers</h6>
    </div></div>
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1528207776546-365bb710ee93?w=400&h=600&fit=crop" alt="Book 9" loading="lazy">
      <h6>World of Wonders</h6>
    </div></div>
    <div class="col-md-3"><div class="book-card">
      <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=400&h=600&fit=crop" alt="Book 10" loading="lazy">
      <h6>Shadow Kingdom</h6>
    </div></div>
  </div>
</section>

<!-- Upcoming Competitions -->
<section id="competitions" class="container py-5">
  <h2 class="section-title">🏆 Upcoming Competitions</h2>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h5 class="card-title">Short Story Writing Contest</h5>
          <p class="card-text mb-1"><strong>Type:</strong> Fiction / Creative Writing</p>
          <p class="card-text mb-1"><strong>Start Date:</strong> March 10, 2026</p>
          <p class="card-text small">Write a short story (max 3000 words). Winner gets e-voucher & homepage feature.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h5 class="card-title">Poetry Championship</h5>
          <p class="card-text mb-1"><strong>Type:</strong> Poetry (Urdu / English)</p>
          <p class="card-text mb-1"><strong>Start Date:</strong> April 5, 2026</p>
          <p class="card-text small">Submit up to 3 poems. Best poems will be published online.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h5 class="card-title">Novel Synopsis Contest</h5>
          <p class="card-text mb-1"><strong>Type:</strong> Novel Synopsis</p>
          <p class="card-text mb-1"><strong>Start Date:</strong> May 20, 2026</p>
          <p class="card-text small">Submit a 500-word synopsis. Winner may get publishing support.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h5 class="card-title">Essay Writing Contest</h5>
          <p class="card-text mb-1"><strong>Type:</strong> Non-Fiction / Essay</p>
          <p class="card-text mb-1"><strong>Start Date:</strong> June 1, 2026</p>
          <p class="card-text small">Topic: “Future of Reading in Digital Age”. Max length: 1500 words.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Winners -->
<section id="winners" class="container py-5">
  <h2 class="section-title">🏅 Recent Winners</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h6 class="card-title">2025 Short Story Winner</h6>
          <p class="card-text">John Carter — “The Rising Dawn”</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h6 class="card-title">2025 Poetry Champion</h6>
          <p class="card-text">Alicia Gomez — “Moonlight Whispers”</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h6 class="card-title">2024 Essay Winner</h6>
          <p class="card-text">Rohan Ali — “Books vs E-Books: The Debate”</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h6 class="card-title">2024 Poetry Runner-up</h6>
          <p class="card-text">Sara Khan — “Silent Pages”</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-dark text-white border-0">
        <div class="card-body">
          <h6 class="card-title">2023 Short Story Winner</h6>
          <p class="card-text">Michael Lee — “Echoes of Yesterday”</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>Explore</h5>
        <a href="#new">New Releases</a><br>
        <a href="#best">Best Sellers</a><br>
        <a href="#competitions">Competitions</a><br>
        <a href="#winners">Winners</a>
      </div>
      <div class="col-md-4">
        <h5>User</h5>
        <a href="#">Login</a><br>
        <a href="#">Register</a>
      </div>
      <div class="col-md-4">
        <h5>About</h5>
        <p class="small">A premium e-book portal designed with elegance.</p>
      </div>
    </div>
    <p class="text-center small mt-4">&copy; 2026 E-Book World</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
