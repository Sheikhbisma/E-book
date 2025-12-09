 <?php
include '../auth/dbconnect.php';
include '../auth/check.php';
include '../auth/functions.php';
if(isset($_POST['loginbtn'])){

    $email = sanitize_data($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM customer_register WHERE customer_email='$email'";
    $sql = "SELECT * FROM customer_register WHERE customer_email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['customer_pass'])){
            $_SESSION['username'] = $row['customer_email'];
            $_SESSION['userid'] = $row['customer_id'];
            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['msg'] = showErr('Invalid username or password' , "danger");
        }
    } else {
        $_SESSION['msg'] = showErr('Invalid username or password' , "danger");
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <?php include('../components/meta-links.php') ?>

</head>
<style>
    body {
    background:
        url('../images/bg.png'),
        linear-gradient(rgba(77, 54, 46, 0.95), rgba(77, 54, 46, 0.95));
    font-family: 'Cinzel', serif !important;

}
</style>
<body>
<div class="container">
<div class="login-box  b-card">
    <?php 
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']); // Remove after displaying
}
if(isset($_SESSION['success_msg'])){
    echo "<div class='alert alert-success alert-dismissible w-50 fade show' role='alert'>
            ".$_SESSION['success_msg']."
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    unset($_SESSION['success_msg']);
}
?> 
    <h2>Login</h2>
    <form action="" method="post">
        <input type="email" name="email" placeholder=" Email" class="form-control" required>
        <input type="password" name="password" placeholder="Enter your password" class="form-control" required>
        <button type="submit" name="loginbtn" class="btn-login btn-custom">Login</button>
    </form>
    <div class="signup-link">
        Don't have an account? <a href="register.php">Register</a>
    </div>
</div> 
</div>
     <?php include '../components/script.php'; ?> 

</body>
</html>
