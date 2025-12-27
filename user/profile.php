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

body {
    margin: 0;
    overflow-x: hidden;
    background-color: #fdfaf5;
}

/* SIDEBAR */
.sidebar {
    height: 100vh;
    background: url('../images/header.png'),
    linear-gradient(rgba(77, 54, 46, 0.95), rgba(77, 54, 46, 0.95));
    color: #fff;
    padding-top: 20px;
    position: fixed;
    width: var(--sidebar-width);
    top: 0;
    left: 0;
    z-index: 1000;
    transition: 0.3s;
}

.sidebar a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    padding: 12px 20px;
    display: flex;
    align-items: center;
}

.sidebar a i {
    margin-right: 15px;
    font-size: 20px;
    min-width: 30px;
}

/* MAIN AREA */
.content-area{
    margin-left: var(--sidebar-width);
    padding: 40px;
}

/* MOBILE BUTTON */
.user-menu-btn {
    display: none;
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

/* PROFILE IMAGE */
.profile-img-wrapper{
    width:160px;
    height:160px;
    margin:0 auto;
    border-radius:50%;
    overflow:hidden;
    border:6px solid #d4af37;
    background:#fff;
    position: relative;
}

.profile-img-wrapper img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* 🔥 PREMIUM EDIT BUTTON */
.edit-btn{
    position:absolute;
    bottom:10px;
    right:10px;

    background: rgba(0,0,0,0.75);
    color:#fff;

    border:2px solid #d4af37;
    width:44px;
    height:44px;
    border-radius:50%;

    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;

    font-size:18px;

    box-shadow:0 6px 15px rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);

    transition: all 0.3s ease;
    opacity:0.95;
}

.edit-btn:hover{
    background:#d4af37;
    color:#4d362e;
    transform: scale(1.12);
    box-shadow:0 8px 20px rgba(212,175,55,0.9);
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

.info-label{
    font-weight:700;
    color:#4d362e;
}

/* RESPONSIVE */
@media(max-width: 991px){
    .sidebar { left:-240px; }
    .sidebar.active { left:0; }
    .content-area{ margin-left:0; padding:80px 20px; }
    .user-menu-btn{ display:block; }

    .edit-btn{
        width:48px;
        height:48px;
        font-size:20px;
    }
}
</style>
</head>

<body>

<button class="user-menu-btn" id="userMenuBtn">
    <i class="bi bi-list"></i>
</button>

<div class="sidebar" id="userSidebar">
    <h2 class="text-center mb-4 fw-bold" style="color:#d4af37;">User Panel</h2>
    <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="competition.php"><i class="bi bi-trophy-fill"></i> Competition</a>
    <a href="books.php"><i class="bi bi-book"></i> Books</a>
    <a href="orders.php"><i class="bi bi-cart"></i> Orders</a>
    <a href="profile.php"><i class="bi bi-person-lines-fill"></i> Profile</a>
    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="content-area">

    <div class="profile-header">
        <div class="profile-img-wrapper">
            <img id="profilePreview" src="../img/<?php echo $image; ?>">

            <!-- EDIT IMAGE BUTTON -->
            <button class="edit-btn" onclick="document.getElementById('imageInput').click()">
                <i class="bi bi-camera-fill"></i>
            </button>

            <!-- LOCAL FILE INPUT -->
            <input type="file" id="imageInput" accept="image/*" hidden>
        </div>

        <h2 class="mt-3 fw-bold golden"><?php echo strtoupper($name); ?></h2>
        <p class="woodendark"><?php echo $email; ?></p>
    </div>

    <div class="info-card">
        <div class="info-row">
            <span class="info-label">Full Name</span>
            <span><?php echo $name; ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Email</span>
            <span><?php echo $email; ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Phone</span>
            <span><?php echo $number; ?></span>
        </div>
        <div class="info-row">
            <span class="info-label">Location</span>
            <span><?php echo $location; ?></span>
        </div>
    </div>
</div>

<script>
const userMenuBtn = document.getElementById('userMenuBtn');
const userSidebar = document.getElementById('userSidebar');

userMenuBtn.onclick = () => userSidebar.classList.toggle('active');

document.getElementById('imageInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('profilePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

<?php include '../components/script.php'; ?>
</body>
</html>
