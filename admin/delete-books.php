<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';

if (!isset($_GET['id'])) { header("Location: freebooks.php"); exit; }
$id = intval($_GET['id']);

// Delete files
$res = mysqli_query($conn, "SELECT pdf_path, cover_image FROM freebooks WHERE id=$id");
$row = mysqli_fetch_assoc($res);
if ($row['pdf_path'] != '') unlink('../'.$row['pdf_path']);
if ($row['cover_image'] != '') unlink('../'.$row['cover_image']);

// Delete DB record
mysqli_query($conn, "DELETE FROM freebooks WHERE id=$id");
$_SESSION['msg'] = showErr("Book deleted successfully!", "success");
header("Location: freebooks.php");
exit;
?>
