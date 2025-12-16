<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';

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
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $book['title']; ?> - Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

                        <?php if (!empty($book['pdf_path'])) { ?>
                            <a href="../<?php echo $book['pdf_path']; ?>" 
                               target="_blank" 
                               class="btn btn-danger">
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
