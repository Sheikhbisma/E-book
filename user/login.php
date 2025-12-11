 <?php
    //  include database, functions
    include '../auth/dbconnect.php';
    include '../auth/check.php';
    include '../auth/functions.php';
    // if login button isset
    if (isset($_POST['loginbtn'])) {
        // sanitize data function that prevents sql injections

        $email = sanitize_data($_POST['email']);
        $password = $_POST['password'];
        //  check if email exist
        $sql = "SELECT * FROM customer_register WHERE customer_email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // if email exist verify password from database
            if (password_verify($password, $row['customer_pass'])) {
                // store data in sessions
                $_SESSION['username'] = $row['customer_email'];
                $_SESSION['userid'] = $row['customer_id'];
                header('Location: ../index.php');
                exit;
            } else {
                $_SESSION['msg'] = showErr('Invalid username or password', "danger");
            }
        } else {
            $_SESSION['msg'] = showErr('email not found', "danger");
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

     }
 </style>

 <body>
     <div class="containers">
         <div class="login-box  b-card">
             <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']); // Remove after displaying
                }
                if (isset($_SESSION['success_msg'])) {
                    echo "<div class='alert alert-success alert-dismissible w-50 fade show' role='alert'>
            " . $_SESSION['success_msg'] . "
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
                    unset($_SESSION['success_msg']);
                }
                ?>
             <h2>Login</h2>
             <form action="" method="post">
                 <div class="mb-3">
                     <div class="input-group ">
                         <span class="input-group-text bg">
                             <i class="bi bi-envelope-at-fill"></i>
                         </span>
                         <input type="email" name="email" placeholder="Email" class="form-control" required>
                     </div>
                 </div>
                 <div class="mb-3">
                     <div class="input-group">
                         <span class="input-group-text bg">
                             <i class="bi bi-eye-fill show"></i>
                         </span>
                         <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                     </div>
                 </div>
                 <button type="submit" name="loginbtn" class="btn-login btn-custom">Login</button>
             </form>
             <div class="signup-link">
                 Don't have an account? <a href="register.php">Register</a>
             </div>
         </div>
     </div>
     <?php include '../components/script.php'; ?>
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