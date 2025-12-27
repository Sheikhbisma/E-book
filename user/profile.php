<?php 
include '../auth/check.php';
include '../auth/dbconnect.php';

$name     = $_SESSION['customername'];
$email    = $_SESSION['username'];
$location = $_SESSION['customerlocation'];
$number   = $_SESSION['customernumber'];
$image    = $_SESSION['customerimage'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>

<?php include '../components/meta-links.php'; ?>

<style>
:root {
    --sidebar-width: 240px;
 
}



/* --- MAIN AREA --- */
.content-area{
    margin-left: var(--sidebar-width);
    padding: 40px;
    transition: 0.3s;
}

/* --- MOBILE TOGGLE BUTTON --- */
.user-menu-btn {
    display: none; /* Laptop par hide */
    position: fixed;
    top: 15px;
    left: 15px;
    z-index: 1100;
    background: var(--brown-theme);
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    font-size: 24px;
    cursor: pointer;
}

/* PROFILE HEADER */
.profile-header{
    background: url('../images/card.png'), #fffcf5;
    border:1px solid #c8b89a;
    border-radius:20px;
    padding:40px 20px;
    height: 50vh;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.profile-img-wrapper{
    width:160px;
    height:160px;
    margin:0 auto;
    border-radius:50%;
    overflow:hidden;
    border:6px solid #d4af37;
    background:#fff;
}

.profile-img-wrapper img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* INFO CARD */
.info-card{
    max-width:700px;
    margin:40px auto;
    padding:30px;
    border-radius:20px;
    background: url('../images/card.png'), #fffcf5;
    border:1px solid #c8b89a;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.info-row{
    display:flex;
    justify-content:space-between;
    padding:15px 0;
    border-bottom:1px dashed #bfae8e;
    font-size:18px;
}

.info-row:last-child{ border-bottom:none; }
.info-label{ font-weight:700; color:#4d362e; }

/* --- RESPONSIVE LOGIC (Mobile & Tablet) --- */
@media(max-width: 991px){
    .sidebar {
        left: -240px; /* Sidebar hide */
    }

    .sidebar.active {
        left: 0; /* Slide in on click */
        box-shadow: 5px 0 15px rgba(0,0,0,0.4);
    }

    .content-area{
        margin-left:0;
        padding: 80px 20px 20px 20px; /* Space for toggle button */
    }

    .user-menu-btn {
        display: block; /* Show toggle button */
    }

    .info-row {
        flex-direction: column;
        gap: 5px;
    }

    .profile-header {
        padding: 20px;
    }
}
</style>
</head>

<body>

<?php include './user-sidebar.php' ?>


<div class="content-area">

    <div class="profile-header">
        <div class="profile-img-wrapper">
            <img src="../img/<?php echo $image; ?>" alt="Profile Image">

        </div>

        <h2 class="mt-3 fw-bold golden">
            <?php echo strtoupper($name); ?>
        </h2>
        <p class="woodendark mb-0"><?php echo $email; ?></p>
    </div>

    <div class="info-card">
        <h3 class="woodendark fw-bold text-center mb-4">Personal Information</h3>

        <div class="info-row">
            <span class="info-label">Full Name</span>
            <span class="info-value"><?php echo $name; ?></span>
        </div>

        <div class="info-row">
            <span class="info-label">Email</span>
            <span class="info-value"><?php echo $email; ?></span>

        </div>

        <div class="info-row">
            <span class="info-label">Phone</span>
            <span class="info-value"><?php echo $number; ?></span>
        </div>

        <div class="info-row">
            <span class="info-label">Location</span>
            <span class="info-value"><?php echo $location; ?></span>
        </div>
    </div>

</div>

<script>
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userSidebar = document.getElementById('userSidebar');

    userMenuBtn.addEventListener('click', function() {
        userSidebar.classList.toggle('active');
    });

    // Bahar click karne par sidebar band ho jaye
    document.addEventListener('click', function(event) {
        if (!userSidebar.contains(event.target) && !userMenuBtn.contains(event.target)) {
            userSidebar.classList.remove('active');
        }
    });
</script>

<?php include '../components/script.php'; ?>
</body>
</html>