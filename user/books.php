<?php
include '../auth/dbconnect.php';
include '../auth/check.php';
if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
  }
$free_book = mysqli_query($conn , "select * from freebooks");
$paid_books = mysqli_query($conn, "
    SELECT o.*, ot.*, b.*
    FROM orders AS o
    INNER JOIN order_items AS ot ON o.order_id = ot.order_id
    INNER JOIN books AS b ON ot.book_id = b.id
    WHERE o.user_id = '$user_id' 
     
      AND o.order_status = 'Done'
");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <?php include '../components/meta-links.php'; ?>
</head>
<style>
/* user sidebar books section */
.card{
  width: 300px;
  padding: 20px;
  background: #fff;
  border: 6px solid var(--wood-dark);
  box-shadow: 12px 12px 0 var(--wood-dark);
  transition: transform 0.3s, box-shadow 0.3s;
}
.badge-free{
    position: absolute;
    top: -10px;
    right: -10px;
    background: #dc3545;
    color: #fff;
    padding: 6px 12px;
    font-size: 12px;
    text-transform: uppercase;
    border: 3px solid #000;
    box-shadow: 3px 3px 0 var(--wood-dark);
}

.card:hover {
  transform: translate(-5px, -5px);
  box-shadow: 17px 17px 0 var(--wood-dark);
}

.card__title {
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 15px;
  position: relative;
  overflow: hidden;
}

.card__title::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 50%;
  height: 3px;
  background-color: var(--wood-dark);
  transform: translateX(-100%);
  transition: transform 0.3s;
}

.card:hover .card__title::after {
  transform: translateX(0);
}





</style>
<body>
  <?php include 'user-sidebar.php'; ?>
    <!-- From Uiverse.io by 0xnihilism --> 
<div class="content-area">
  <div class="container">
    <div class="header text-center py-3">
      <h3 class="fw-bold">Your Books – Read & Download</h3>
      <p class="paper-cream">
       <strong> All your books are displayed here.</strong><br>
Some of these books are provided free by the author. Enjoy reading — you can read online or download the PDF at no cost.</p>
    </div>
  </div>
 <div class="d-flex flex-wrap gap-5 justify-content-center">
   <?php while($execute = mysqli_fetch_assoc($free_book)){ ?>
<div class="card mt-3 position-relative">

    <span class="badge badge-free">FREE</span>

    <span class="card__title woodendark"><?php echo $execute['title'] ?></span>

    <div class="image d-flex justify-content-center">
        <img src="../<?php echo $execute['cover_image'] ?>" style="height: 150px;" alt="" class="w-50 img-fluid">
    </div>

    <div class="btns d-flex gap-2 justify-content-center mt-3">
        <a href="../<?php echo $execute['pdf_path'] ?>" target="_blank" class="btn btn-gold px-4">Read</a>
        <a href="../<?php echo $execute['pdf_path'] ?>" class="btn bg btn-md px-4" download >Download</a>
    </div>

</div>
<?php } ?>
 </div>
 <h3 class="cream text-center display-3 fw-bold mt-5">Paid Books</h3>
 <div class="d-flex flex-wrap gap-5 justify-content-center mb-5">
   <?php while($execute = mysqli_fetch_assoc($paid_books)){ ?>
<div class="card mt-3 position-relative">

    <span class="badge badge-free">Paid</span>

    <span class="card__title woodendark"><?php echo $execute['title'] ?></span>

    <div class="image d-flex justify-content-center">
        <img src="../<?php echo $execute['cover_image'] ?>" style="height: 150px;" alt="" class="w-50 img-fluid">
    </div>

    <div class="btns d-flex gap-2 justify-content-center mt-3">
        <a href="../<?php echo $execute['pdf_path'] ?>" target="_blank" class="btn btn-gold px-4">Read</a>
        <a href="../<?php echo $execute['pdf_path'] ?>" class="btn bg btn-md px-4" download >Download</a>
    </div>

</div>
<?php } ?>
 </div>

</div>
<?php include '../components/script.php'; ?>
</body>
</html>