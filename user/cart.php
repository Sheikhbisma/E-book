<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';
$msg = '';
//   $id = $_GET['id'];
if (!isset($_SESSION['userid'])) {
    $_SESSION['msg'] = showErr("Please Login First To View Your Cart", "danger");;
    header('location: login.php');
    exit;
}
$user_id = $_SESSION['userid'];
$cart = mysqli_query($conn, "SELECT c.* , b.id,b.title ,b.author, b.price , b.cover_image from cart as c INNER JOIN books as b ON c.book_id = b.id WHERE c.user_id = $user_id ");
totalItems($conn , $user_id);
if(!isset($_SESSION['totalProducts'])){
   $msg = "<div class='card text-center p-4 shadow-sm border-0'>
    <div class=card-body>
        <i class='fas fa-shopping-bag fa-3x golden mb-3'></i>
        <h4 class = 'woodendark fw-bold'>Your cart is empty</h4>
        <p class='golden'>
            Browse our collection and add your favorite items to the cart.
        </p>
        <a href='../books/index.php' class='btn btn-custom px-4'>
            Browse Books
        </a>
    </div>
</div>
";
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include '../components/meta-links.php' ?>
</head>

<body>
    <?php include '../components/header.php' ?>

    <section>
        <div class="container py-4">
            <h2 class="mb-4 text-center fw-bold fs-1" style="color: var(--paper-cream);">My Cart</h2>

<?php
 echo $msg;


?>
            <div class="row g-4">
                <?php while ($fetch = mysqli_fetch_assoc($cart)) {
                    $price = $fetch['price'];

                ?>
                    <div class="col-md-6 col-12"> <!-- 2 cards per row on desktop, 1 on mobile -->
                        <div class="card p-3 shadow-sm h-100 rounded-3">

                            <h4 class="mb-1"><?php echo $fetch['title']; ?></h4>
                            <p class="text-muted mb-2">Author: <strong><?php echo $fetch['author']; ?></strong></p>

                            <p class="mb-2"><strong>Price:</strong> $<?php echo number_format($price, 2); ?></p>

                            <div class="mb-2 d-flex align-items-center">
                                <label class="me-2 mb-0 fw-bold">Quantity:</label>
                                <input type="number" class="qty form-control w-25"
                                    value="<?php echo $fetch['quantity']; ?>"
                                    data-price="<?php echo $price; ?>">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold">Total: $<span class="total"><?php echo number_format($fetch['quantity'] * $price, 2); ?></span></span>
                                <a href="./remove_cart.php?delete_id=<?php echo $fetch['cart_id'] ?>"><button class="btn btn-danger btn-sm">Remove</button></a>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Checkout Button -->
            <div class="mt-4 text-center">
                <?php if(isset($_SESSION['totalProducts'])){ ?>
<a href="checkout.php" class="btn btn-primary btn-lg w-50">Proceed to Checkout</a>
                    <?php } ?>
            </div>
        </div>
    </section>
<?php include '../components/footer.php' ?>
    <script>
        let qty = document.querySelectorAll(".qty");
        let total = document.querySelector(".total");
        qty.forEach(input => {
            input.addEventListener('input', function() {
                let price = this.dataset.price;
                let quantity = this.value;
                let card = this.closest(".card");
                let totalElement = card.querySelector(".total");

                if (quantity > 0) {
                    let totalPrice = price * quantity;
                    totalElement.innerText = totalPrice.toFixed(2);
                }
            });
        })
    </script>
</body>

</html>