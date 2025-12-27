<?php
session_start();
include '../auth/dbconnect.php';
include '../auth/functions.php';
// Fetch Books
$result = mysqli_query($conn, "SELECT * FROM dealer_books");
if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];

    totalItems($conn , $user_id);
}
if(isset($_POST['place_order'])){

    $dealer_id       = $_POST['dealer_id'];
    $dealer_book_id  = $_POST['dealer_book_id'];
    $full_name       = $_POST['full_name'];
    $email           = $_POST['email'];
    $city            = $_POST['city'];
    $address         = $_POST['address'];
    $book_title      = $_POST['book_title'];
    $book_format     = $_POST['book_format'];
    $payment_method  = $_POST['payment_method'];
    $grand_total     = $_POST['grand_total'];

    mysqli_query($conn, "INSERT INTO dealer_orders
    (dealer_id, dealer_book_id, full_name, email, city, address, book_title, book_format, payment_method, payment_status, order_status, grand_total, created_at)
    VALUES
    ('$dealer_id','$dealer_book_id','$full_name','$email','$city','$address','$book_title','$book_format','$payment_method','Pending','New','$grand_total',NOW())");

    $success = "Order submitted successfully! Dealer will contact you soon.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Premium Glow Cards</title>

<?php include '../components/meta-links.php' ?>
</head>
<style>
     .navbar-brand {
            font-size: 1.8rem !important;
        }
</style>
<body class="pt">
    <?php include '../components/header.php' ?>

<section>
    <?php if(isset($success)){ ?>
<div class="contact-success"><?= $success ?></div>
<?php } ?>

  <div class="container w-100 d-flex justify-content-end">
      <div class="w-25">
    
      </div>
  </div>
    <div class="container-cards">
        
<?php while ($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card-box card">
        <!-- Image with Absolute Positioning - NOW LARGER -->
        <img src="../<?php echo $row['cover_image']; ?>" class="card-img">

        <!-- Card Content Below Image - NOW MORE COMPACT -->
        <div class="card-content">
            <h3 class="card-title woodendark fw-bold"><?php echo $row['title']; ?></h3>

            <p class="card-author woodendark "><?php echo $row['author']; ?></p>

            <p class="card-desc woodendark">
                <?php echo substr($row['description'], 0, 75) . "..."; ?>  <!-- Slightly less text -->
            </p>

            <div class="price-tag bg">
                 <?php echo "$".$row['price']; ?>
            </div>

     <div class="card-actions">
<button class="card-icon-btn btn-gold"
    data-book='<?= htmlspecialchars(json_encode([
        "id" => $row["id"],
        "dealer" => $row["dealer_id"],
        "title" => $row["title"]
    ]), ENT_QUOTES, "UTF-8") ?>'
    onclick="handleOrderClick(this)">
    <i class="fas fa-shopping-bag"></i>
</button>


</div>

           
        </div>

    </div>

<?php } ?>
</div>
<div class="modal fade" id="orderModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content glass-card">

      <form method="POST">
        <div class="modal-header">
          <h5>Place Order</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <input type="hidden" name="dealer_id" id="dealer_id">
          <input type="hidden" name="dealer_book_id" id="dealer_book_id">

          <input type="text" name="book_title" id="book_title" readonly>

          <input type="text" name="full_name" placeholder="Your Name" required>
          <input type="email" name="email" placeholder="Your Email" required>
          <input type="text" name="city" placeholder="City" required>
          <input type="text" name="address" placeholder="Delivery Address" required>

          <select name="book_format" required>
            <option value="PDF">PDF</option>
            <option value="Hard Copy">Hard Copy</option>
          </select>

          <select name="payment_method" required>
            <option value="COD">Cash on Delivery</option>
            <option value="Bank Transfer">Bank Transfer</option>
          </select>

          <input type="number" name="grand_total" placeholder="Total Price" required>

        </div>

        <div class="modal-footer">
          <button type="submit" name="place_order" class="btn btn-gold">Submit Order</button>
        </div>
      </form>

    </div>
  </div>
</div>

</section>
<script>
function openOrder(bookId, dealerId, title) {
    console.log(bookId, dealerId, title);

    document.getElementById('dealer_book_id').value = bookId;
    document.getElementById('dealer_id').value = dealerId;
    document.getElementById('book_title').value = title;

    var modal = new bootstrap.Modal(document.getElementById('orderModal'));
    modal.show();
}
</script>

<?php include '../components/script.php' ?>



</body>
</html>