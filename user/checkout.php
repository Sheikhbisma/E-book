<?php
include '../auth/check.php';
include '../auth/dbconnect.php';
include '../auth/functions.php';
// check login user
$user_id = $_SESSION['userid'];
$subtotal = 0;
$details = '';
totalItems($conn, $user_id);
// quantity from cart table eg cart_id 3 => bok_qty 2 this will return an array
if (isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $cart_id => $book_qty) {
        // if user proceed to checkout then store the quantity in db by update
        $update_quantity = mysqli_query($conn, "update cart set quantity = $book_qty WHERE cart_id = $cart_id 
            AND user_id = $user_id");
        if ($update_quantity) {
            header('location: checkout.php');
        }
    };
}
$select_row = mysqli_query($conn , "select * from cart where user_id = $user_id");
if(mysqli_num_rows($select_row) == 0 ){
    $_SESSION['msg']=showErr("To continue with checkout, please add at least one item to your cart first. ","danger");
    header('location: cart.php');
    exit;
}
// to show order detalils
$cart = mysqli_query($conn, "SELECT c.* , b.id,b.title , b.price  from cart as c INNER JOIN books as b ON c.book_id = b.id WHERE c.user_id = $user_id ");
while ($cart_detail = mysqli_fetch_assoc($cart)) {
    $qty =  $cart_detail['quantity'];
    $price = $cart_detail['price'];
    $title = $cart_detail['title'];
    $book_total = $qty * $price;
    $total_formatted = "$" . number_format($book_total, 2);
    $subtotal += $book_total;
    $details .= " <div class='border-bottom pb-2 mb-2'>
            <div class='fw-semibold woodendark fw-bold'>$title</div>
            <div class='d-flex justify-content-between small text-muted'>
                <span class='woodmedium fw-bold'>Qty: $qty × $price</span>
                <span class='woodmedium fw-bold'> $total_formatted</span>
            </div>
        </div>";
}
// for the place order page
$_SESSION['subtotal'] = $subtotal;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include '../components/meta-links.php' ?>
</head>
<style>
    .navbar-brand {
        font-size: 1.8rem !important;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .form-row .form-group {
        flex: 1;
        min-width: 150px;
    }

    .payment-method {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 10px;
    }

    .payment-option {
        flex: 1;
        min-width: 120px;
    }

    .payment-option input {
        display: none;
    }

    .payment-option label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px;
        background-color: #f1f5f9;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .payment-option input:checked+label {
        border-color: #3498db;
        background-color: #e1f0fa;
    }

    .payment-option i {
        margin-right: 8px;
        font-size: 18px;
    }
</style>

<body class="pt">
    <?php include '../components/header.php' ?>
    <main>
        <section>
            <div class="container my-5">
                <div class="row g-4">

                    <!-- LEFT : CHECKOUT FORM -->
                    <div class="col-lg-7">
                        <div class="card shadow border-0">
                            <div class="card-header header bg-dark text-white">
                                <h5 class="mb-0 cream text-center">Checkout Details</h5>
                            </div>

                            <div class="card-body p-4">
                                <form action="./placeorder.php" method="post">

                                    <!-- Row 1: Full Name + Email -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label woodendark">Full Name *</label>
                                            <input type="text" name="fullname" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label woodendark">Email *</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Row 2: Book Format + City -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label woodendark">Book Format *</label>
                                            <select class="form-select" name = 'bookformat' required>
                                                <option value="">Select Format</option>
                                                <option value="pdf" >PDF</option>
                                                <option value="cd">CD</option>
                                                <option value="hardcopy">Hard Copy</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label woodendark">City *</label>
                                            <input type="text" name="city" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Row 3: Address -->
                                    <div class="mb-4">
                                        <label class="form-label woodendark">Address *</label>
                                        <textarea class="form-control" name="address" rows="3" required></textarea>
                                    </div>

                                    <!-- Row 4: Payment Method -->
                                    <div class="mb-4">
                                        <div class="form-group">
                                            <label class="required">Payment Method</label>
                                            <div class="payment-method">
                                                <div class="payment-option" >
                                                    <input type="radio" id="paypal" name="payment" value="paypal" required>
                                                    <label for="paypal"><i class="fab fa-paypal"></i> PayPal</label>
                                                </div>

                                                <div class="payment-option" >
                                                    <input type="radio" id="creditcard" name="payment" value="creditcard" required>
                                                    <label for="creditcard"><i class="far fa-credit-card"></i> Credit Card</label>
                                                </div>

                                                <div class="payment-option" >
                                                    <input type="radio" id="debitcard" name="payment" value="debitcard" required>
                                                    <label for="debitcard"><i class="fas fa-credit-card"></i> Debit Card</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal -->
                                    <div class="modal fade" id="paymentmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="mb-0">Credit / Debit Card (Demo Only)</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">

                                                        <div class="mb-3">
                                                            <label class="form-label">Card Number</label>
                                                            <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label">Expiry Date</label>
                                                                <input type="text" class="form-control" placeholder="MM/YY">
                                                            </div>

                                                            <div class="col-6 mb-3">
                                                                <label class="form-label">CVV</label>
                                                                <input type="password" class="form-control" placeholder="***">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Card Holder Name</label>
                                                            <input type="text" class="form-control" placeholder="John Doe">
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="placeorder" class="btn  btn-gold btn-md w-100">
                                        Place Order
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- RIGHT : ORDER SUMMARY -->
                    <div class="col-lg-5">

                        <!-- Product Details -->
                        <!-- ORDER DETAILS -->
                        <div class="card shadow-sm mb-3">
                            <div class="card-header header bg-secondary text-white">
                                <h6 class="mb-0 cream text-center">Order Details</h6>
                            </div>

                            <div class="card-body">

                                <!-- Book Item -->
                                <?php echo $details ?>

                                <!-- TOTAL SECTION -->
                                <div class="pt-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="woodendark fw-bold">Subtotal</span>
                                        <span class="woodmedium fw-bold">$<?php echo  number_format($subtotal, 2) ?></span>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <span class="woodendark fw-bold">Shipping</span>
                                        <span class="woodmedium fw-bold">Free</span>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between fw-bold fs-5">
                                        <span class="woodendark fw-bold">Grand Total</span>
                                        <span class="woodmedium">$<?php echo  number_format($subtotal, 2) ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../components/footer.php' ?>
    <?php include '../components/script.php' ?>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    <?php if ($cart_empty) { ?>
        var cartModal = new bootstrap.Modal(
            document.getElementById('cartEmptyModal')
        );
        cartModal.show();
    <?php } ?>
});
</script>

</body>

</html>