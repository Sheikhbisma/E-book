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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); // Remove after displaying
        }

        ?>
        <!-- SIMPLE FORM -->
        <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
            <h3 class="text-center mb-4">Add New Book</h3>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Book Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" required>
                </div>

                <div class="mb-3">
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

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3" required></textarea>
                </div>


                <!-- ADDED FIELDS -->
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">Upload PDF</label>
                    <input type="file" class="form-control" name="pdf_file" accept="application/pdf">
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Cover Image</label>
                    <input type="file" class="form-control" name="cover_image" accept=".jpg , .jpeg , .png">
                </div>


                <button type="submit" name="submit" class="btn btn-primary w-100">
                    Add Book
                </button>

            </form>
        </div>

    <!-- ===================== BOOKS TABLE ===================== -->
<div class="card shadow p-4 mt-4">

    <h3 class="text-center mb-4">All Books</h3>

    <!-- TABLE RESPONSIVE WRAPPER (Fix width issue) -->
    <div class="table-responsive">

        <table class="table table-bordered table-striped" style="table-layout: fixed; word-wrap: break-word;">
            <!-- table-layout: fixed → table wide nahi hota -->
            <!-- word-wrap: break-word → long text wrap hota hai -->

            <thead class="table-dark">
                <tr>
                    <th style="width:50px;">ID</th>
                    <th style="width:120px;">Title</th>
                    <th style="width:120px;">Author</th>
                    <th style="width:110px;">Category</th>
                    <th style="width:200px;">Description</th>
                    <th style="width:70px;">Price</th>
                    <th style="width:120px;">PDF</th>
                    <th style="width:90px;">Cover</th>
                    <th style="width:130px;">Created At</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>

                        <td><?= $row['id']; ?></td>

                        <td><?= $row['title']; ?></td>

                        <td><?= $row['author']; ?></td>

                        <td><?= $row['category']; ?></td>

                        <!-- WRAPPED DESCRIPTION, NO LENGTH CUT -->
                        <td><?= $row['description']; ?></td>

                        <td><?= $row['price']; ?></td>

                        <!-- ONLY FILENAME SHOW (Fix wide issue) -->
                        <td><?= basename($row['pdf_path']); ?></td>

                        <td>
                            <?php if ($row['cover_image']) { ?>
                                <img src="../<?= $row['cover_image']; ?>" width="60" height="80" style="object-fit:cover;">
                            <?php } ?>
                        </td>

                        <!-- CREATED_AT COLUMN -->
                        <td><?= $row['created_at']; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div> <!-- end table-responsive -->

</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>