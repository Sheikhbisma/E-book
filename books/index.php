<?php
session_start();
include '../auth/dbconnect.php';
include '../auth/functions.php';
// Fetch Books
$result = mysqli_query($conn, "SELECT * FROM books");
if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];

    totalItems($conn , $user_id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Premium Glow Cards</title>

<?php include '../components/meta-links.php' ?>
</head>
<style>
     .navbar-brand {
            font-size: 1.8rem !important;
        }
</style>
<body class="pt">
    <?php include '../components/header.php' ?>

<section>
    
  <div class="container w-100 d-flex justify-content-end">
      <div class="w-25">
        <?php  
    if(isset($_SESSION['cart_msg'])){
        echo $_SESSION['cart_msg'];
        unset($_SESSION['cart_msg']);
    }
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    
    ?>
      </div>
  </div>
    <div class="container-cards">
        
<?php while ($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card-box card">
        <!-- Image with Absolute Positioning - NOW LARGER -->
        <img src="../<?php echo $row['cover_image']; ?>" class="card-img">

        <!-- Card Content Below Image - NOW MORE COMPACT -->
        <div class="card-content">
            <h3 class="card-title woodendark fw-bold"><?php echo $row['title']; ?></h3>

            <p class="card-author woodendark "><?php echo $row['author']; ?></p>

            <p class="card-desc woodendark">
                <?php echo substr($row['description'], 0, 75) . "..."; ?>  <!-- Slightly less text -->
            </p>

            <div class="price-tag bg">
                 <?php echo "$".$row['price']; ?>
            </div>

            <!-- 🔥 ICON BUTTONS ONLY -->
            <div class="card-actions">

                <!-- Add to cart -->
                <a class="card-icon-btn btn-edit" href="../user/add_cart.php?id=<?php echo $row['id']?>">
                    <i class="fa fa-cart-plus"></i>
                </a>

                <!-- See details -->
                <a class="card-icon-btn btn-custom" href="./details.php?id=<?php echo $row['id']; ?>">
                    <i class="fa fa-eye"></i>
                </a>

            </div>
        </div>

    </div>

<?php } ?>
</div>
</section>
<?php include '../components/script.php' ?>


</body>
</html>