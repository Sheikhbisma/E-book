<?php
include './dealer_auth.php';
include '../auth/dbconnect.php';

if (!isset($_GET['id'])) { 
    header("Location: dealerbooks.php"); 
    exit; 
}
$id = intval($_GET['id']);

// Fetch book details
$res = mysqli_query($conn, "SELECT * FROM dealer_books WHERE dealer_book_id=$id LIMIT 1");
if(mysqli_num_rows($res) == 0){
    $_SESSION['msg'] = showErr("Book not found!", "danger");
    header("Location: dealerbooks.php");
    exit;
}
$book = mysqli_fetch_assoc($res);

// Update book
if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = floatval($_POST['price']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);

    // PDF
    $pdf_path = $book['pdf_path'];
    if (!empty($_FILES['pdf_file']['name'])) {
        if(file_exists('../'.$book['pdf_path'])) unlink('../'.$book['pdf_path']);
        $pdf_path = "pdfs/" . time() . "_" . basename($_FILES['pdf_file']['name']);
        move_uploaded_file($_FILES['pdf_file']['tmp_name'], "../" . $pdf_path);
    }

    // Cover Image
    $cover_image = $book['cover_image'];
    if (!empty($_FILES['cover_image']['name'])) {
        if(file_exists('../'.$book['cover_image'])) unlink('../'.$book['cover_image']);
        $cover_image = "img/" . time() . "_" . basename($_FILES['cover_image']['name']);
        move_uploaded_file($_FILES['cover_image']['tmp_name'], "../" . $cover_image);
    }

    $updateQuery = "UPDATE dealer_books 
                    SET title='$title', author='$author', category='$category', 
                        description='$desc', price='$price', pdf_path='$pdf_path', cover_image='$cover_image' 
                    WHERE dealer_book_id=$id";

    if(mysqli_query($conn, $updateQuery)){
        $_SESSION['msg'] = showErr("Book updated successfully!", "success");
    } else {
        $_SESSION['msg'] = showErr("Failed to update book: " . mysqli_error($conn), "danger");
    }
    header("Location: dealerbooks.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <?php include '../admin/inc/link.php'; ?>
</head>
<body class="bg-light">
<?php include './dealer-sidebar.php'; ?>

<div class="content-area">
    <div class="container">
        <div class="header">
            <h1 class="fw-bold mb-3 text-center"><i class="fa-solid fa-book fs-1"></i> Update Book</h1>
        </div>

        <div class="my-5">
            <form action="" method="POST" class="b-card p-5" enctype="multipart/form-data">
                <div class="row g-3 text-start">

                    <div class="col-md-6">
                        <label class="form-label woodendark">Book Title</label>
                        <input type="text" value="<?php echo htmlspecialchars($book['title']); ?>" class="form-control" name="title" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label woodendark">Author</label>
                        <input type="text" value="<?php echo htmlspecialchars($book['author']); ?>" class="form-control" name="author" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label woodendark">Price</label>
                        <input type="text" value="<?php echo htmlspecialchars($book['price']); ?>" class="form-control" name="price" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label woodendark">Category</label>
                        <select class="form-select" name="category" required>
                            <option disabled>Select category</option>
                            <?php 
                            $categories = ['Comics','Story Books','Novels','General Knowledge','Children Books'];
                            foreach($categories as $cat){
                                $selected = ($book['category']==$cat) ? 'selected' : '';
                                echo "<option value='$cat' $selected>$cat</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label woodendark">Upload PDF</label>
                        <input type="file" class="form-control" name="pdf_file" accept="application/pdf">
                        <?php if($book['pdf_path']): ?>
                            <small>Current file: <a href="../<?php echo $book['pdf_path']; ?>" target="_blank">View PDF</a></small>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label woodendark">Upload Cover Image</label>
                        <input type="file" class="form-control" name="cover_image" accept=".jpg,.jpeg,.png,webp">
                        <?php if($book['cover_image']): ?>
                            <small>Current image: <img src="../<?php echo $book['cover_image']; ?>" alt="cover" width="50"></small>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label class="form-label woodendark">Description</label>
                        <textarea class="form-control" name="description" rows="3" required><?php echo htmlspecialchars($book['description']); ?></textarea>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="submit" name="update" class="btn btn-custom w-50">
                            <i class="bi bi-pencil-square"></i> Update Book
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../components/script.php' ?>
</body>
</html>
