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
    $qry = "INSERT INTO `cart`( `user_id`, `book_id`, `Quantity`, `status`) VALUES ('$user_id','$book_id','1','active')";
    $execute = mysqli_query($conn, $qry);
    if ($execute) {
        echo "<script>alert('ok'); window.location.href ='./cart.php'</script>";
    } else {
        echo "<script>alert('error')</script>";
    }
}
$cart = mysqli_query($conn, "SELECT c.* , b.title , b.price , b.cover_image from cart as c INNER JOIN books as b ON c.book_id = b.id WHERE c.user_id = $user_id ");
// $fetch = mysqli_fetch_assoc($cart);
// print_r($fetch);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart UI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        .cart-box {
            width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ddd;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-info {
            display: flex;
            align-items: center;
        }

        .cart-info img {
            width: 70px;
            height: 70px;
            border-radius: 5px;
            margin-right: 15px;
            object-fit: cover;
        }

        .cart-info h4 {
            margin: 0;
            font-size: 18px;
        }

        .qty-box input {
            width: 50px;
            padding: 5px;
            font-size: 16px;
            text-align: center;
        }

        .remove-btn {
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .total-box {
            text-align: right;
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        .checkout-btn {
            background: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="cart-box">
        <h2>Your Cart</h2>

        <!-- ITEM 1 -->
        <?php
        while ($item = mysqli_fetch_assoc($cart)) {
            echo "<div class='cart-card'>";
            echo "<img src='../{$item['cover_image']}' width='100'>";
            echo "<h3>{$item['title']}</h3>";
            echo "<p>Price: Rs {$item['price']}</p>";
            echo "<p>Qty: {$item['Quantity']}</p>";
            echo "<a href='remove_cart.php?id={$item['cart_id']}'>Remove</a>";
            echo "</div>";
        }


        ?>





    </div>

</body>

</html>