<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';

if (!isset($_GET['id'])) { 
    header("Location: addbooks.php"); 
    exit; 
}
$id = intval($_GET['id']);

// Fetch book details
$res = mysqli_query($conn, "SELECT * FROM books WHERE id=$id");
$book = mysqli_fetch_assoc($res);

// Update book
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    // PDF
    $pdf_path = $book['pdf_path'];
    if (!empty($_FILES['pdf_file']['name'])) {
        $pdf_path = "pdfs/" . time() . "_" . $_FILES['pdf_file']['name'];
        move_uploaded_file($_FILES['pdf_file']['tmp_name'], "../" . $pdf_path);
    }

    // Cover Image
    $cover_image = $book['cover_image'];
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image = "img/" . time() . "_" . $_FILES['cover_image']['name'];
        move_uploaded_file($_FILES['cover_image']['tmp_name'], "../" . $cover_image);
    }

    mysqli_query($conn, "UPDATE books SET title='$title', author='$author', category='$category', description='$desc', price='$price' ,pdf_path='$pdf_path', cover_image='$cover_image' WHERE id=$id");
    $_SESSION['msg'] = showErr("Book updated successfully!", "success");
    header("Location: freebooks.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <?php include 'inc/link.php'; ?>
</head>
<?php include './sidebar.php'; ?>
<body class="bg-light">

<div class="content-area">
    <div class="container b-card">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <h1 class="fw-bold mb-3 text-center"><i class="fa-solid fa-book fs-1"></i> Update Book</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-3 text-start">

                <div class="col-md-6">
                    <label class="form-label">Book Title</label>
                    <input type="text" value="<?php echo htmlspecialchars($book['title']); ?>" class="form-control" name="title" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Author</label>
                    <input type="text" value="<?php echo htmlspecialchars($book['author']); ?>" class="form-control" name="author" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">price</label>
                    <input type="text" value="<?php echo htmlspecialchars($book['price']); ?>" class="form-control" name="author" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category" required>
                        <option disabled>Select category</option>
                        <option value="Comics" <?php if($book['category']=='Comics') echo 'selected'; ?>>Comics</option>
                        <option value="Story Books" <?php if($book['category']=='Story Books') echo 'selected'; ?>>Story Books</option>
                        <option value="Novels" <?php if($book['category']=='Novels') echo 'selected'; ?>>Novels</option>
                        <option value="General Knowledge" <?php if($book['category']=='General Knowledge') echo 'selected'; ?>>General Knowledge</option>
                        <option value="Children Books" <?php if($book['category']=='Children Books') echo 'selected'; ?>>Children Books</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Upload PDF</label>
                    <input type="file" class="form-control" name="pdf_file" accept="application/pdf">
                    <?php if($book['pdf_path']): ?>
                        <small>Current file: <a href="../<?php echo $book['pdf_path']; ?>" target="_blank">View PDF</a></small>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Upload Cover Image</label>
                    <input type="file" class="form-control" name="cover_image" accept=".jpg,.jpeg,.png">
                    <?php if($book['cover_image']): ?>
                        <small>Current image: <img src="../<?php echo $book['cover_image']; ?>" alt="cover" width="50"></small>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3" required><?php echo htmlspecialchars($book['description']); ?></textarea>
                </div>

                <div class="col-12 text-center mt-3">
                    <button type="submit" name="update" class="btn btn-success w-50">
                        <i class="bi bi-pencil-square"></i> Update Book
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<?php include '../components/script.php' ?>
</body>
</html>
