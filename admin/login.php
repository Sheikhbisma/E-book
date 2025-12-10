<?php
session_start();
include '../auth/dbconnect.php';

$msg = "";

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
  $user = mysqli_fetch_assoc($query);

  if ($user) {


    if ($password == $user['password']) {
      $_SESSION['id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['email'] = $user['email'];
      echo "<script>alert('Login Successful');</script>";
      echo "<script>window.location.href='addbooks.php';</script>";
      exit();
    } else {
      echo "<script>alert('Invalid Password');</script>";
    }
  } else {
    echo "<script>alert('Invalid Email');</script>";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <div class="card p-4 shadow w-50 mx-auto">
      <h3 class="text-center text-primary mb-4">Admin Login</h3>
      <form action="" method="POST">
        <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
        <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
        <button name="login" class="btn btn-primary w-100">Login</button>
      </form>

    </div>
  </div>
</body>

</html>