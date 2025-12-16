<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';

$msg = "";

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
  $user = mysqli_fetch_assoc($query);

  if ($user) {


    if ($password == $user['password']) {
      $_SESSION['id'] = $user['id'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['loginmsg'] = showErr("Login Successfull", "success");
      header('location: index.php');
      exit();
    } else {
      $_SESSION['msg'] = showErr("Invalid email or password", "success");
    }
  } else {
    $_SESSION['msg'] = showErr("Invalid email or password", "success");
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
  <?php include 'inc/link.php'; ?>
</head>

<body class="bg-light">
  <div class="containers mt-5">
    <?php
    if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }
    ?>
    <div class="login-box p-4 shadow  mx-auto">
      <h3 class="text-center woodendark mb-4">Admin Login</h3>
      <form action="" method="POST">
        <div class="mb-3">
          <div class="input-group ">
            <span class="input-group-text btn-pdf">
              <i class="bi bi-envelope-at-fill"></i>
            </span>
            <input type="email" name="email" placeholder="Email" class="form-control" required>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group">
            <span class="input-group-text btn-pdf ">
              <i class="bi bi-eye-fill show"></i>
            </span>
            <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
          </div>
        </div>

        <button name="login" class="btn btn-pdf w-100">Login</button>
      </form>


    </div>
  </div>
  <script>
    // get icon for click
    let show = document.querySelector('.show');
    let password = document.querySelector('#password');
    show.addEventListener('click', () => {
      // if password is not empty
      if (password.value != '') {
        // if input type is password then change the type into text
        if (password.type === 'password') {
          password.type = 'text';
          show.classList.add("bi-eye-slash-fill");
          show.classList.remove("bi-eye-fill");
        } else {
          // if input type is text then change the type into password
          password.type = 'password';
          show.classList.remove("bi-eye-slash-fill");
          show.classList.add("bi-eye-fill");
        }
      }
    });
  </script>
</body>

</html>