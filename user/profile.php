<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- META + CSS -->
    <?php include '../components/meta-links.php'; ?>
</head>

<body>

    <!-- SIDEBAR -->
    <?php include "user-sidebar.php"; ?>

    <!-- MAIN CONTENT AREA -->
    <div class="content-area">

        <!-- PROFILE HEADER -->
        <div class="profile-header text-center header">
            <img src="https://via.placeholder.com/140" class="profile-img" alt="Profile">
            <h3 class="mt-3 mb-0 fs-2 fw-bold golden">Ali Khan</h3>
            <p class="text-muted mb-1">Web Developer</p>
            <small class="text-muted">Member since 2023</small>
        </div>

        <!-- PERSONAL INFORMATION CARD -->
        <div class="info-card mt-4 card">
            <h4 class="mb-4 woodendark fw-bold fs-3 text-center">Personal Information</h4>

            <div class="info-row">
                <span class="info-label woodendark">Full Name:</span>
                <span class="info-value">Ali Khan</span>
            </div>

            <div class="info-row">
                <span class="info-label woodendark">Email:</span>
                <span class="info-value">ali@example.com</span>
            </div>

            <div class="info-row">
                <span class="info-label woodendark">Phone:</span>
                <span class="info-value">+92 300 1234567</span>
            </div>

            <div class="info-row">
                <span class="info-label woodendark">Location:</span>
                <span class="info-value">Lahore, Pakistan</span>
            </div>
        </div>

        <!-- LOGOUT BUTTON -->
        <div class="logout-container text-center mt-4">
            <form action="logout.php" method="post">
                <button class="logout-btn">Logout</button>
            </form>
        </div>

    </div> <!-- CONTENT END -->

    <!-- SCRIPTS -->
    <?php include '../components/script.php'; ?>

</body>

</html>