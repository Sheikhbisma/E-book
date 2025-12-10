<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';

if (!isset($_GET['id'])) { header("Location: freebooks.php"); exit; }
$id = intval($_GET['id']);

// Fetch book details
$res = mysqli_query($conn, "SELECT * FROM freebooks WHERE id=$id");
$book = mysqli_fetch_assoc($result);

// Update book
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
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

    mysqli_query($conn, "UPDATE freebooks SET title='$title', author='$author', category='$category', description='$desc', pdf_path='$pdf_path', cover_image='$cover_image' WHERE id=$id");
    $_SESSION['msg'] = showErr("Book updated successfully!", "success");
    header("Location: freebooks.php");
    exit;
}
?>

