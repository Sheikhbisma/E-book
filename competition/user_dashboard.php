<?php
session_start();
include "../auth/dbconnect.php";

/* fetch user name */
if(isset($_SESSION['userid'])){
    $user_id = intval($_SESSION['userid']);
}
$user_stmt = $conn->prepare("
    SELECT customer_name 
    FROM customer_register 
    WHERE customer_id=? 
    LIMIT 1
");
$user_stmt->bind_param("i",$user_id);
$user_stmt->execute();
$user_res = $user_stmt->get_result();
$user_name = ($user_res->num_rows > 0) 
    ? $user_res->fetch_assoc()['customer_name'] 
    : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Writer's Workshop - Competition Dashboard</title>
<?php include '../components/meta-links.php' ?>

<style>

/* Hero Section */
.hero-section {
    background: linear-gradient(rgba(41,41,41,0.7), rgba(63, 46, 41, 0.7)),
                url('../images/competition.avif') center top no-repeat;
    background-attachment: fixed;
    background-size: cover;
    border-bottom: 6px solid var(--accent-gold);
    padding: 80px 0;
    text-align: center;
    color: var(--paper-cream);
}
.hero-section h1 {
    font-size: 3rem;
    font-weight: 700;
    text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
}
.hero-section p {
    font-size: 1.2rem;
    margin-bottom: 40px;
}

/* Stats */
.hero-stats .stat-item {
    background: rgba(93,64,55,0.4);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(212,175,55,0.3);
    border-radius: 15px;
    padding: 20px;
    margin: 10px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}
.hero-stats .stat-item:hover {
    background: rgba(93,64,55,0.6);
    transform: translateY(-5px);
    border-color: var(--accent-gold);
}
.hero-stats i {
    color: var(--accent-gold);
}
.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--accent-gold);
}
.stat-label {
    font-size: 0.85rem;
    text-transform: uppercase;
    opacity: 0.9;
}

/* Rules Card */
.rules-paper {
    border: 1px solid var(--accent-gold);
    border-left: 10px solid var(--accent-gold);
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08), 0 6px 10px rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.rules-paper:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1), 0 10px 15px rgba(0,0,0,0.07);
}
.rules-paper h4 {
    color: var(--heading);
    border-bottom: 3px solid var(--wood-light);
    padding-bottom: 15px;
    margin-bottom: 20px;
    font-weight: 700;
    display: flex;
    align-items: center;
}
.rules-paper h4 i {
    background-color: var(--accent-gold);
    padding: 10px;
    border-radius: 50%;
    color: var(--wood-dark);
    margin-right: 15px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}
.rules-paper ul {
    padding-left: 0;
}
.rules-paper ul li {
    list-style: none;
    padding: 12px 0;
    border-bottom: 1px solid rgba(141,110,99,0.15);
    display: flex;
    align-items: flex-start;
    cursor: pointer;
    border-radius: 4px;
    transition: all 0.2s ease;
}
.rules-paper ul li:last-child {
    border-bottom: none;
}
.rules-paper ul li:hover {
    background-color: rgba(255,248,225,0.6);
    transform: translateX(5px);
}
.rules-paper ul li i {
    margin-right: 12px;
    font-size: 1.2rem;
}

/* Rule detail */
.rule-detail {
    display: none;
    font-size: 0.9rem;
    color: var(--wood-dark) !important;
    margin-top: 5px;
}
.rule-detail.show {
    display: block;
}

/* Competition Cards */
.competition-cards-container {
    opacity: 0;
    max-height: 0;
    overflow: hidden;
    transition: all 0.8s ease;
    margin-top: 0;
}
.competition-cards-container.show {
    opacity: 1;
    max-height: 2000px;
    margin-top: 30px;
}
.card-paper {
    border-radius: 8px;
    border-top: 5px solid var(--wood-dark);
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(30px);
}
.card-paper.show {
    opacity: 1;
    transform: translateY(0);
}
.card-paper:hover {
    transform: translateY(-8px);
    border-top-color: var(--accent-gold);
    box-shadow: 0 12px 20px rgba(93,64,55,0.15);
}
.icon-circle {
    width: 70px;
    height: 70px;
    background: var(--wood-light);
    color: var(--wood-dark);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
}
.icon-circle:hover {
    background: var(--accent-gold);
    color: white;
}
.sub {
    color: var(--wood-medium);
    font-style: italic;
    margin-bottom: 15px;
}
.sample-box {
    background: rgba(141,110,99,0.05);
    border-radius: 6px;
    padding: 10px;
    font-size: 0.85rem;
    margin-bottom: 20px;
}

/* Logout */
.btn-logout {
    color: var(--wood-medium);
    font-weight: 600;
    text-decoration: none;
}
.btn-logout:hover {
    color: #d9534f;
}
</style>
</head>
<body class="pt">
<?php include '../components/header.php' ?>
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container hero-content">
        <h1>Express. Write. Create.</h1>
        <p class="lead">Children participate through essay writing, while adults showcase their talent by uploading original books. This competition brings creativity, learning, and meaningful expression together on one platform.</p>

        <div class="row g-4 hero-stats justify-content-center mt-4">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <i class="bi bi-pencil-square fs-2 mb-2"></i>
                    <div class="stat-number">2</div>
                    <div class="stat-label">Competitions</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <i class="bi bi-trophy fs-2 mb-2"></i>
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Monthly Winners</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <i class="bi bi-people fs-2 mb-2"></i>
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Active Writers</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rules Section -->
<div class="container my-5">
    <div class="container my-5">

    <!-- RULES SECTION -->
    <div class="rules-paper p-5 header mb-5">
        <h4 class="mb-4">
            <i class="bi bi-journal-text me-2"></i>
            Competition Rules & Instructions
        </h4>

        <div class="row g-4">

            <!-- Rule 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="rule-card card woodendark h-100 p-3">
                    <div class="rule-icon text-primary">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <h6 class="fw-bold">Registered Users Only</h6>
                    <p>
                        Only logged-in users are allowed to participate in the competition.
                    </p>
                </div>
            </div>

            <!-- Rule 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="rule-card card woodendark h-100 p-3">
                    <div class="rule-icon text-info">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h6 class="fw-bold">Children Essay Topics</h6>
                    <p>
                        Children must choose essay topics suggested by the author.
                    </p>
                </div>
            </div>

            <!-- Rule 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="rule-card card woodendark h-100 p-3">
                    <div class="rule-icon text-danger">
                        <i class="bi bi-book-fill"></i>
                    </div>
                    <h6 class="fw-bold">Adult Book Submission</h6>
                    <p>
                        Adult participants can upload original books or PDF documents.
                    </p>
                </div>
            </div>

            <!-- Rule 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="rule-card card woodendark h-100 p-3">
                    <div class="rule-icon text-warning">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h6 class="fw-bold">Winner Announcement</h6>
                    <p>
                        Winners will be announced by the author or organizing committee.
                    </p>
                </div>
            </div>

            <!-- Rule 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="rule-card card woodendark h-100 p-3">
                    <div class="rule-icon text-success">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h6 class="fw-bold">Original Content Only</h6>
                    <p>
                        All submissions must be original and created by the participant.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- COMPETITION CARDS (unchanged) -->
    <!-- Your existing competition cards stay same -->

</div>


    <!-- Competition Cards -->
    <div class="competition-cards-container show" id="competitionCards">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card-paper card card p-4 p-lg-5 text-center h-100 show">
                    <div class="icon-circle"><i class="bi bi-pencil-square"></i></div>
                    <h3>Children Essay</h3>
                    <div class="sub">For Young Minds • Creative Writing</div>
                    <p>Pick a pen and let your thoughts flow.</p>
                    <div class="sample-box"><strong>Topics:</strong> My Lovely Home, A Day in My Life, Education, Picnic</div>
                    <a href="competition.php" class="btn btn-gold w-100 rounded-pill"><i class="bi bi-play-circle me-2"></i> Start Writing</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-paper card p-4 p-lg-5 text-center h-100 show">
                    <div class="icon-circle"><i class="bi bi-book"></i></div>
                    <h3>Adult PDF / Book</h3>
                    <div class="sub">For Scholars • Value-Based Literature</div>
                    <p>Share stories that inspire growth.</p>
                    <div class="sample-box"><strong>Example:</strong> "The Alchemist" – Paulo Coelho</div>
                    <a href="adult_competition.php" class="btn btn-gold w-100 rounded-pill"><i class="bi bi-upload me-2"></i> Upload Book</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 py-4">
        <a href="logout.php" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i> Logout</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle rule details
    document.querySelectorAll('.rules-paper ul li').forEach(li => {
        li.addEventListener('click', () => {
            const detail = li.querySelector('.rule-detail');
            if(detail) detail.classList.toggle('show');
        });
    });

    // Animate cards on load
    document.querySelectorAll('.card-paper').forEach((card, index) => {
        setTimeout(() => card.classList.add('show'), index * 150);
    });
});
</script>
<?php include '../components/footer.php' ?>
</body>
</html>
