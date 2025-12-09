<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../components/meta-links.php' ?>
</head>
<style>

</style>
<body>
    <?php
    include '../auth/dbconnect.php';
    session_start();
    $select = mysqli_query($conn , "select * from books");
   
    
    ?>
 <div class="row overflow-hidden g-4">
    <?php while ($row = mysqli_fetch_assoc($select)) { ?>
        <div class="col-md-4 col-sm-6">
            
            <div class="card shadow-sm h-100 border-0" style="border-radius: 14px; overflow: hidden;">

                <!-- Image -->
                <img src="../images/cover.png" class="card-img-top" style="height: 100px; object-fit: cover;" alt="Book">

                <!-- Card Body -->
                <div class="card-body">

                    <h5 class="fw-bold mb-1"><?php echo $row['title'] ?></h5>
                    <p class="text-muted mb-2" style="font-size: 0.9rem;">
                        <?php echo $row['author'] ?>
                    </p>

                    <p class="card-text text-muted" style="font-size: 0.9rem; max-height: 45px; overflow: hidden;">
                        <?php echo substr($row['description'], 0, 82) . "..." ?>
                    </p>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="badge bg-light text-dark"><?php echo $row['category'] ?></span>
                        <span class="fw-bold fs-5 text-dark">$<?php echo $row['price'] ?></span>
                    </div>

                    <a href="../user/cart.php?id=<?php echo $row['id'] ?>" 
                       class="btn btn-dark  mt-3 rounded-3">
                       Add to Cart
                    </a>

                </div>
           
            </div>
        </div>
    <?php } ?>
</div>


</body>
</html>