<?php
session_start();
include "../auth/dbconnect.php";

if(!isset($_SESSION['userid'])){
    echo "<script>alert('Only registered customer will participate in competitions '); window.location='login.php';</script>";
    exit;
}
$user_id = intval($_SESSION['userid']);

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
if(empty($name) || empty($email) || !isset($_FILES['pdf_file'])){
    die("All fields are required.");
}
// handle PDF upload
$target_dir = "uploads/adult/";
if(!is_dir($target_dir)) mkdir($target_dir,0777,true);

$file = $_FILES['pdf_file'];
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if($ext !== 'pdf') die("Only PDF files allowed.");

$filename = $user_id . "_" . time() . ".pdf";
$target_file = $target_dir . $filename;

if(!move_uploaded_file($file['tmp_name'], $target_file)){
    die("Upload failed.");
}

// insert entry
$stmt = $conn->prepare("INSERT INTO adult_entries (user_id, name, email, pdf_file, submitted_at) VALUES (?,?,?,?,NOW())");
$stmt->bind_param("isss",$user_id,$name,$email,$filename);
$stmt->execute();

echo "<script>
if(confirm('Submission successful! Admin will announce winners later.')) {
    window.location='../index.php';
}
</script>";

?>
