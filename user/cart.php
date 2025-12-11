<?php
session_start();
include '../auth/dbconnect.php';
//   $id = $_GET['id'];
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Please login first'); window.location.href='./login.php'</script>";
    exit;
}

$user_id = $_SESSION['userid'];
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $qry = "INSERT INTO `cart`( `user_id`, `book_id`, `Quantity`) VALUES ('$user_id','$book_id','1')";
    $execute = mysqli_query($conn, $qry);
    if ($execute) {
        echo "<script>alert('ok'); window.location.href ='./cart.php'</script>";
    } else {
        echo "<script>alert('error')</script>";
    }
}
$cart = mysqli_query($conn, "SELECT c.* , b.title ,b.author, b.price , b.cover_image from cart as c INNER JOIN books as b ON c.book_id = b.id WHERE c.user_id = $user_id ");
// $fetch = mysqli_fetch_assoc($cart);
// print_r($fetch);

?>
<!DOCTYPE html>
<html>
<head>
<title>Cart</title>

<?php include '../components/meta-links.php' ?>
</head>
<body style="font-family: Arial; background:#f8f8f8; padding:40px;">

<div class="container">

    <div class="row g-4"> 
        <?php while($fetch = mysqli_fetch_assoc($cart)){ $price = $fetch['price']?>
   
        <div class="col-md-6"> <!-- 2 cards per row -->
            <div class="card p-3 shadow-sm">

                <h4 class="mb-1"><?php echo $fetch['title'] ?></h4>
                <p class="text-muted">Author: <strong><?php echo $fetch['author'] ?></strong></p>

                <p><strong>Price:</strong> $<?php echo $price ?></p>

                <label class="fw-bold">Quantity:</label>
                <input type="number" class="qty" value="<?php echo $fetch['quantity'] ?>"  class="form-control w-25 d-inline-block ms-2">

                <p class="mt-3 fs-5 fw-bold">Total: <span class="total">$<?php echo  number_format($fetch['quantity'] * $fetch['price'] , 2) ?></span></p>

                <button class="btn btn-danger mt-2">Remove</button>

            </div>
        </div>

        <?php } ?>
    </div>

    <!-- Checkout button -->
    <a href="checkout.php?total="
       class="btn btn-primary w-100 mt-4 fs-5">
       Proceed to Checkout
    </a>

</div>
<script>
    let qty = document.querySelectorAll(".qty");
    let total = document.querySelector(".total");
qty.forEach(input =>{
 input.addEventListener('input' , function(){
        let price = <?php echo $price ?>;
        let quantity = this.value;
        if(quantity > 0){
        let totalPrice = price * quantity;
total.innerText ="$"+ totalPrice.toFixed(2);
        }
    });
    })
   
</script>
</body>
</html>
