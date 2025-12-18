<?php 
//  include database, functions
 include '../auth/check.php';
    include '../auth/dbconnect.php';
    include '../auth/functions.php';
    $name = $_SESSION['customername'];
    $email = $_SESSION['username'];
    $location = $_SESSION['customerlocation'];
    $number = $_SESSION['customernumber'];
    $image = $_SESSION['customerimage'];
?>

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
            <img src="../img/<?php echo $image; ?>" class="profile-img img-fluid" alt="Profile">
            <h3 class="mt-3 mb-0 fs-2 fw-bold golden"><?php echo strtoupper($name); ?></h3>
       
        </div>

        <!-- PERSONAL INFORMATION CARD -->
        <div class="info-card mt-4 card">
            <h4 class="mb-4 woodendark fw-bold fs-3 text-center">Personal Information</h4>

            <div class="info-row">
                <span class="info-label woodendark">Full Name:</span>
                <span class="info-value"><?php echo $_SESSION['customername'] ?? 'name'?></span>
            </div>

            <div class="info-row">
                <span class="info-label woodendark">Email:</span>
                <span class="info-value"><?php echo $email; ?></span>
            </div>

            <div class="info-row">
                <span class="info-label woodendark">Phone:</span>
                <span class="info-value"><?php echo$_SESSION['customernumber'] ?></span>
            </div>

            <div class="info-row">
                <span class="info-label woodendark">Location:</span>
                <span class="info-value"><?php echo $location; ?></span>
            </div>
        </div>

      

    </div> <!-- CONTENT END -->

    <!-- SCRIPTS -->
    <?php include '../components/script.php'; ?>

</body>

</html>