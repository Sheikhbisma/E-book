<?php
include '../auth/dbconnect.php';
include '../auth/check.php';
include '../auth/functions.php';

$errors = [];
$success_msg = "";


// Form Submission
if (isset($_POST['register'])) {

    // Sanitize inputs
    $name = sanitize_data($_POST['name']);
    $email = sanitize_data($_POST['email']);
    $contact = sanitize_data($_POST['contact']);
    $address = sanitize_data($_POST['address']);
    $location = sanitize_data($_POST['location']);
    $pass = sanitize_data($_POST['pass']);
    $conpass = sanitize_data($_POST['conpass']);
    $image = $_FILES['img'];

    // Validate form function
    $errors = validateForm($contact, $address, $location, $pass, $conpass);
// if there is no error in validation
    if (empty($errors)) {

        // Image handling
        $image_name = $image['name'];
        $image_temp = $image['tmp_name'];
        $image_type = $image['type'];
        $image_size = $image['size'];
        // unique name
        $unique_path = time() . uniqid() . "-" . $image_name;
        $path = "img/" . $unique_path;
// check image type
        if (in_array($image_type, ['image/jpeg', 'image/jpg', 'image/png'])) {
            // check image size
            if ($image_size <= 15000000) {
                // Hash password
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

                // Insert detils into dtabase
                $query = "INSERT INTO customer_register 
                (customer_name, customer_email, customer_contact, customer_image, customer_address, customer_location, customer_pass)
                VALUES ('$name','$email','$contact','$unique_path','$address','$location','$hashed_pass')";
                  
                if (mysqli_query($conn, $query)) {
                    // move images into img
                    move_uploaded_file($image_temp, "../" . $path);

                    $_SESSION['success_msg'] = "Registration successful! You can now login.";
                    header("Location: login.php");
                    exit();
                } else {
                    $errors['db'] = "Database error: Could not register user.";
                }
            } else {
                $errors['img'] = "Image size should be less than 15 MB";
            }
        } else {
            $errors['img'] = "Invalid image type. Only JPEG, JPG, PNG allowed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <?php include '../components/meta-links.php'; ?>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="register-card card shadow-lg p-4 rounded-4 " style="max-width: 650px; width: 100%;">

            <h3 class="text-center mb-4 fw-bold">Create Your Account</h3>

<!-- if query fail -->
            <?php if (isset($errors['db'])): ?>
                <div class="alert alert-danger"><?php echo $errors['db']; ?></div>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Eg: William Sons" value="<?php echo $name ?? ''; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Eg: youremail@gmail.com" value="<?php echo $email ?? ''; ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Phone Number</label>
                        <input type="text" class="form-control" name="contact" placeholder="Eg: 03480935678" value="<?php echo $contact ?? '' ?>" required>
                        <!-- show validation error -->
                        <?php if (isset($errors['contact'])): ?>
                            <div class="text-danger mt-1"><?php echo $errors['contact']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Eg: Karachi, Pakistan" value="<?php echo $location ?? ''; ?>" required>
                         <!-- show validation error -->
                        <?php if (isset($errors['location'])): ?>
                            <div class="text-danger mt-1"><?php echo $errors['location']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Profile Image</label>
                    <input type="file" class="form-control" name="img" required>
                     <!-- show image validation  error -->
                    <?php if (isset($errors['img'])): ?>
                        <div class="text-danger mt-1"><?php echo $errors['img']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea class="form-control" rows="1" placeholder="Apt 402, Bahria Town Karachi" name="address" required><?php echo $address ?? ''; ?></textarea>
                     <!-- show validation error -->
                    <?php if (isset($errors['address'])): ?>
                        <div class="text-danger mt-1"><?php echo $errors['address']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Your Password" required>
                         <!-- show validation error -->
                        <?php if (isset($errors['pass'])): ?>
                            <div class="text-danger mt-1"><?php echo $errors['pass'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="conpass" class="form-control" placeholder="Confirm Password" required>
                        <!-- password do not match error  -->
                        <?php if (isset($errors['conpass'])): ?>
                            <div class="text-danger mt-1"><?php echo $errors['conpass']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" name="register" class="btn btn-custom  w-100 py-2 mt-2 rounded-3 fw-semibold">
                    REGISTER
                </button>

            </form>
        </div>
    </div>
<!-- include bootstrap scripts -->
    <?php include '../components/script.php'; ?>
</body>

</html>