<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';

// INSERT BOOK
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    $insert = "INSERT INTO books (title, author, category, description, price)
               VALUES ('$title', '$author', '$category', '$desc', '$price')";
    $run = mysqli_query($conn, $insert);

    if ($run) {
        $_SESSION['msg'] = showErr("Book Uploaded Successfully!", "success");
    }
}

// FETCH BOOKS
$result = mysqli_query($conn, "SELECT * FROM books");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books Store</title>

    <!-- BOOTSTRAP LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<h1 class="text-center bg-primary text-white p-3">📚 Book Store</h1>

<div class="container mt-4">
    <div class="row">

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm h-100" style="border-radius: 12px;">

                    <div class="row g-0 align-items-center">

                        <!-- Image -->
                        <div class="col-md-4">
                            <img src="../<?php echo $row['cover_image']; ?>" 
                                 class="img-fluid rounded-start h-100" 
                                 style="object-fit: cover;" 
                                 alt="Book Cover">
                        </div>

                        <!-- Content -->
                        <div class="col-md-8">
                            <div class="card-body">

                                <h5 class="fw-bold"><?php echo $row['title']; ?></h5>
                                <p class="text-muted"><?php echo $row['author']; ?></p>

                                <p class="small text-secondary" style="max-height:40px; overflow:hidden;">
                                    <?php echo substr($row['description'], 0, 80) . "..."; ?>
                                </p>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge bg-warning text-dark"><?php echo $row['category']; ?></span>
                                    <span class="fw-bold fs-5 text-success">$<?php echo $row['price']; ?></span>
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-between">
                                    <a href="details.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                        Details
                                    </a>

                                    <a href="addtocart.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">
                                        Add to Cart
                                    </a>

                                    
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        <?php } ?>

    </div>
</div>

</body>
</html>
