<?php include("user-sidebar.php"); ?>

<style>
    /* PROFILE HEADER */
    .profile-header {
        position: relative;
        height: 220px;
        background: linear-gradient(135deg,#007bff,#6610f2);
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 70px;
    }

    .profile-img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 5px solid white;
        position: absolute;
        bottom: -70px;
        left: 50%;
        transform: translateX(-50%);
        object-fit: cover;
        background: white;
    }

    .profile-name {
        text-align: center;
        margin-top: 80px;
    }

    .profile-name h3 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-name p {
        color: #6c757d;
        margin-bottom: 0;
    }

    /* INFO SECTION */
    .info-card {
        max-width: 700px;
        margin: 40px auto 40px auto;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 30px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .info-label {
        font-weight: 500;
        color: #6c757d;
    }

    .info-value {
        font-weight: 600;
        color: #343a40;
    }

    /* LOGOUT BUTTON */
    .logout-container {
        text-align: center;
        margin-bottom: 50px;
    }

    .logout-btn {
        background: #ff4d4f;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .logout-btn:hover {
        background: #e33c3c;
    }

    @media(max-width:600px){
        .info-row { flex-direction: column; gap: 5px; }
    }
</style>

<!-- PROFILE HEADER -->
<div class="profile-header">
    <img src="https://via.placeholder.com/140" class="profile-img">
</div>

<div class="profile-name">
    <h3>Ali Khan</h3>
    <p>Web Developer</p>
    <p class="small text-muted">Member since 2023</p>
</div>

<!-- INFO SECTION -->
<div class="info-card">
    <h4 class="mb-4">Personal Information</h4>

    <div class="info-row">
        <div class="info-label">Full Name:</div>
        <div class="info-value">Ali Khan</div>
    </div>

    <div class="info-row">
        <div class="info-label">Email:</div>
        <div class="info-value">ali@example.com</div>
    </div>

    <div class="info-row">
        <div class="info-label">Phone:</div>
        <div class="info-value">+92 300 1234567</div>
    </div>

    <div class="info-row">
        <div class="info-label">Location:</div>
        <div class="info-value">Lahore, Pakistan</div>
    </div>
</div>

<!-- LOGOUT BUTTON CENTERED -->
<div class="logout-container">
    <form action="logout.php" method="post">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>
