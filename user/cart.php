<?php
session_start();
include '../auth/dbconnect.php';
include '../auth/functions.php';
$msg = '';
//   if user not login then redirect to login page with message
if (!isset($_SESSION['userid'])) {
    $_SESSION['msg'] = showErr("Please Login First To View Your Cart", "danger");;
    header('location: login.php');
    exit;
}
$user_id = $_SESSION['userid'];
// select items from cart table to show in cart page join by book
$cart = mysqli_query($conn, "SELECT c.* , b.id,b.title ,b.author, b.price , b.cover_image from cart as c INNER JOIN books as b ON c.book_id = b.id WHERE c.user_id = $user_id ");
// function to sum the quantity in cart table
totalItems($conn, $user_id);
// if no items add to cart then show this message
if (!isset($_SESSION['totalProducts'])) {
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
$select_row = mysqli_query($conn , "Select * from cart where user_id = '$user_id'");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
      <div class="container py-4">
  <?php echo $msg; ?>
  <!-- if row exist(row is not equal to 0) -->
  <?php if(mysqli_num_rows($select_row) != 0 ){ ?>
    <h2 class="mb-4 text-center fw-bold fs-1 cream">My Cart</h2>

    <form action="./checkout.php" method="post">
        <div class="row g-4">
            
            <!-- Cart Table Left -->
            <div class="col-lg-8 col-12">
                <div class="table-responsive shadow-sm rounded-4 card">
                    <table class="table table-hover align-middle mb-0 ">
                        <thead class=" header text-light">
                            <tr>
                                <th scope="col">Book</th>
                                <th scope="col">Title & Author</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- fetch details from cart table -->
                            <?php while ($fetch = mysqli_fetch_assoc($cart)) {
                                $price = $fetch['price'];
                            ?>
                            <tr>
                                <td>
                                    <img src="../<?php echo $fetch['cover_image']; ?>" class="img-fluid rounded" style="width: 80px; height: 120px; object-fit: cover;">
                                </td>
                                <td>
                                    <h6 class="fw-bold mb-1 woodendark"><?php echo $fetch['title']; ?></h6>
                                    <p class="text-muted mb-0 woodendark">Author: <?php echo $fetch['author']; ?></p>
                                </td>
                                <td class="fw-semibold woodendark">$<?php echo number_format($price,2); ?></td>
                                <td>
                                    <input type="number" class="qty form-control woodendark" min="1" style="width:70px;"
                                        value="<?php echo $fetch['quantity']; ?>" data-price="<?php echo $price; ?>" name="quantity[<?php echo $fetch['cart_id'] ?>]">
                                </td>
                                <td>
                                    <input class="woodendark form-control total border-0 p-0 bg-transparent fw-bold" name="Total[]" readonly
                                        value="<?php echo number_format($fetch['quantity'] * $price, 2); ?>">
                                </td>
                                <td>
                                    <a href="remove_cart.php?delete_id=<?php echo $fetch['cart_id']; ?>" class="btn btn-gold btn-sm rounded-pill px-3 py-1">Remove</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary Right -->
            <div class="col-lg-4 col-12">
               <div class="card p-4 shadow-lg rounded-4 border-0" style="background: #fff8e1; position: sticky; top: 20px;">
    <h4 class="fw-bold mb-3 woodendark">Order Summary</h4>
    <hr>

    <!-- Subtotal -->
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <label class="woodendark mb-0" for="subtotalInput">Subtotal</label>
        <input type="text" class="form-control fw-bold woodendark text-end bg-transparent border-0" 
               id="subtotalInput" name="subtotal" value="0.00" readonly style="max-width: 100px;">
    </div>

    <!-- Shipping -->
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <label class="woodendark mb-0" for="shippingInput">Shipping</label>
        <a href="">Free</a>
    </div>

    <hr>

    <!-- Grand Total -->
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <label class="fw-bold fs-5 woodendark mb-0" for="grandTotalInput">Grand Total</label>
        <input type="text" class="form-control fw-bold fs-5 woodendark text-end bg-transparent border-0" 
               id="grandTotalInput" name="grandTotal" value="0.00" readonly style="max-width: 100px;">
    </div>

    <button type="submit" class="btn btn-gold w-100 btn-md rounded-2 shadow">Proceed to Checkout</button>
</div>

            </div>
        </div>
    </form>
    <?php } ?>
  
</div>



    </section>
    <?php include '../components/footer.php' ?>
    <script>
        let qty = document.querySelectorAll(".qty");
        let total = document.querySelectorAll(".total");
        
        qty.forEach(input => {
            input.addEventListener('input', function() {
                // fetch per book brice from database
                let price = this.dataset.price;
                // current quantity change by user
                let quantity = this.value;
                let card = this.closest("tr");
                let totalElement = card.querySelector(".total");
// if item add to cart then calculate per book total for ui
                if (quantity > 0) {
                    let totalPrice = price * quantity;
                    totalElement.value = totalPrice.toFixed(2);
                    subtotal();
                  }

            });
        })
let subtotals= document.getElementById('subtotalInput');
let grandTotal= document.getElementById('grandTotalInput');
// subtotal also change hen the per book total change
        function subtotal() {
            let sum = 0;
            total.forEach(input => {
                sum += parseFloat(input.value);
              })
              grandtotal = sum;
                subtotals.value = "$"+ sum.toFixed(2);
             grandTotal.value = "$"+  grandtotal.toFixed(2);
        };
        subtotal();
    </script>
     <?php include '../components/script.php' ?>
</body>

</html>