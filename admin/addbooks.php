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

    // PDF Upload
    $pdf_path = "";
    if (!empty($_FILES['pdf_file']['name'])) {
        $pdf_path = "pdfs/" . time() . "_" . $_FILES['pdf_file']['name'];
        move_uploaded_file($_FILES['pdf_file']['tmp_name'], "../" . $pdf_path);
    } else {
        $_SESSION['msg'] = showErr("There Is an error for uploading pdf path", "danger");
    }

    // Cover Image Upload
    $cover_image = "";
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image = "img/" . time() . "_" . $_FILES['cover_image']['name'];
        move_uploaded_file($_FILES['cover_image']['tmp_name'], "../" . $cover_image);
    } else {
        $_SESSION['msg'] = showErr("There Is an error for uploading image", "danger");
    }

    // Insert Query
    $insert = "INSERT INTO books (title, author, category, description, price, pdf_path, cover_image)
               VALUES ('$title', '$author', '$category', '$desc', '$price',  '$pdf_path', '$cover_image')";

    $run = mysqli_query($conn, $insert);
    if ($run) {
        $_SESSION['msg'] = showErr("Books Upload successfully", "success");
    }
}

// FETCH BOOKS
$result = mysqli_query($conn, "SELECT * FROM books ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Add Book</title>
    <?php include 'inc/link.php'; ?>

</head>
<style>

</style>
<?php include './sidebar.php'; ?>

<body class="bg-light">

    <div class="content-area">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="container">

            <header class="header p-4 mb-5 bg-white rounded">

                <h1 class="fw-bold mb-3 mb-md-0 text-center"><i class="fa-solid fa-book fs-1"></i>Add New Book</h1>
                <!-- Button -->
                <button type="button" class="btn btn-custom btn-lg" data-bs-toggle="modal" data-bs-target="#addbooks">
                    <i class="bi bi-plus-lg"></i> Add New Book
                </button>

                <div class="modal fade" id="addbooks" tabindex="-1" aria-labelledby="addBooksLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="addBooksLabel">Add New Book</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row g-3 text-start">
                                        <div class="col-md-6">
                                            <label class="form-label">Book Title</label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Author</label>
                                            <input type="text" class="form-control" name="author" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Category</label>
                                            <select class="form-select" name="category" required>
                                                <option selected disabled>Select category</option>
                                                <option value="Comics">Comics</option>
                                                <option value="Story Books">Story Books</option>
                                                <option value="Novels">Novels</option>
                                                <option value="General Knowledge">General Knowledge</option>
                                                <option value="Children Books">Children Books</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" name="price" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Upload PDF</label>
                                            <input type="file" class="form-control" name="pdf_file" accept="application/pdf">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Upload Cover Image</label>
                                            <input type="file" class="form-control" name="cover_image" accept=".jpg,.jpeg,.png">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="description" rows="3" required></textarea>
                                        </div>

                                        <div class="col-12 text-center mt-3">
                                            <button type="submit" name="submit" class="btn btn-success w-50">
                                                <i class="bi bi-plus-lg"></i> Add Book
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </header>


            <!-- BOOK CARDS -->
            <h2 class="mb-4 text-center fw-bold">All Books</h3>
                <div class="row g-4">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-md-6 col-sm-12 ">
                            <div class="card b-card h-100 mb-3 shadow-sm" style="max-width: 540px; border-radius: 12px;">
                                <div class="row g-0 align-items-center">
                                    <!-- Image -->
                                    <div class="col-md-4 position-relative">
                                        <img src="../<?php echo $row['cover_image'] ?>" class="img-fluid rounded-start h-100" alt="Book Cover">
                                    </div>

                                    <!-- Card Body -->
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <!-- Title & Author -->
                                            <h5 class="card-title fw-bold"><?php echo $row['title'] ?></h5>
                                            <p class="card-subtitle text-muted mb-2"><?php echo $row['author'] ?></p>

                                            <!-- Description -->
                                            <p class="card-text" style="font-size: 0.9rem; max-height: 40px; overflow: hidden; text-overflow: ellipsis;">
                                                <?php echo substr($row['description'], 0, 82) ."..." ?>
                                            </p>

                                            <!-- Category + Price -->
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge text-dark"><?php echo $row['category'] ?></span>
                                                <span class="fw-bold text-dark fs-5">$<?php echo $row['price'] ?></span>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="btn btn-sm btn-edit flex-fill me-1"><i class="fas fa-edit"></i>Edit</a>
                                                <a href="#" class="btn btn-sm btn-delete flex-fill me-1"><i class="fas fa-trash"></i>Delete</a>
                                                <a href="#" class="btn btn-sm btn-pdf flex-fill"><i class="fas fa-book-open"></i>PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </div>



        </div>
    </div>


    <?php include '../components/script.php' ?>
</body>

</html>