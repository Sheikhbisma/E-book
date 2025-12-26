<?php
session_start();
include '../auth/dbconnect.php';
include '../auth/functions.php';
if(!isset($_SESSION['userid'] )){
     $_SESSION['msg']=showErr("To see the details of the books you have to login or register first ","danger");
    header('location: index.php');
    exit;
}
    $user_id = $_SESSION['userid'];

// CHECK IF ID EXIST IN URL
if (!isset($_GET['id'])) {
    echo "Invalid Book ID!";
    exit;
}


$book_id = $_GET['id'];

$query = "SELECT * FROM books WHERE id = $book_id LIMIT 1";
$result = mysqli_query($conn, $query);
$book = mysqli_fetch_assoc($result);


if (!$book) {
    echo "Book not found!";
    exit;
}

$selectOrder=mysqli_query($conn , "select o.* from orders as o inner join order_items as ot on o.order_id = 'ot.order_id' where o.user_id = '$user_id' and ot.book_id = '$book_id' and o.payment_status = 'Received'")
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $book['title']; ?> - Book Details</title>
    <?php include '../components/meta-links.php' ?>
</head>

<body class="bg-light">

<div class="container py-5">

    <a href="index.php" class="btn btn-secondary mb-3">⬅ Back</a>

    <div class="card shadow-lg" style="border-radius:15px;">
        <div class="row g-0">

            <!-- IMAGE -->
            <div class="col-md-4">
                <img src="../<?php echo $book['cover_image']; ?>" 
                     class="img-fluid h-100" 
                     style="border-radius:15px 0 0 15px; object-fit:cover;">
            </div>

            <!-- DETAILS -->
            <div class="col-md-8">
                <div class="card-body">

                    <h2 class="fw-bold"><?php echo $book['title']; ?></h2>
                    <p class="text-muted fs-5">By <?php echo $book['author']; ?></p>

                    <span class="badge bg-warning text-dark mb-3">
                        Category: <?php echo $book['category']; ?>
                    </span>

                    <h4 class="text-primary fw-bold">$<?php echo $book['price']; ?></h4>

                    <hr>

                    <h5 class="fw-bold">Description:</h5>
                    <p class="text-dark fs-6">
                        <?php echo $book['description']; ?>
                    </p>

                    <hr>

                    <!-- BUTTONS -->
                    <div class="d-flex gap-3 mt-3">
                        <a href="addtocart.php?id=<?php echo $book['id']; ?>" class="btn btn-success">
                            🛒 Add to Cart
                        </a>

                        <?php if (mysqli_num_rows($selectOrder) == 0 ) { ?>
                           
                            <button class="btn btn-danger w-25" disabled><i class="fa fa-lock"></i> Locked</button>
                        <?php }else{ ?>
                             <a href="../<?php echo $book['pdf_path']; ?>" 
                               target="_blank" 
                               class="btn btn-info">
                                📄 View PDF
                            </a>
                            <?php } ?>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
