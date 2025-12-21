<?php
include './session.php';
include '../auth/dbconnect.php';

/* ===== Logged in admin email ===== */
$email = $_SESSION['email'];

/* ===== Admin data nikalna ===== */
$sql = "SELECT id, email FROM admin WHERE email=?";
$stmt = $conn->prepare($sql);      // query ready
$stmt->bind_param("s", $email);    // ? ki jagah email
$stmt->execute();                  // query chalao
$admin = $stmt->get_result()->fetch_assoc();

/* ===== Password update ===== */
if(isset($_POST['update_password'])){

    $new_pass = $_POST['new_password'];
    $confirm  = $_POST['confirm_password'];

    if(strlen($new_pass) < 6){
      $error = "Password must have at least 6 characters";

    }
    elseif($new_pass != $confirm){
        $error = "Password does not match";
    }
    else{
        $hash = password_hash($new_pass, PASSWORD_DEFAULT);

        $up = $conn->prepare(
            "UPDATE admin SET password=? WHERE id=?"
        );                            // update query ready

        $up->bind_param(
            "si",
            $hash,                   // new password
            $admin['id']             // admin id
        );

        $up->execute();              // update chalao

        $success = "Password successfully update ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Profile</title>
<?php include './inc/link.php'; ?>

<style>
.profile-wrapper{
    height:85vh;
    display:flex;
    align-items:center;
    justify-content:center;
}
.profile-card{
    width:330px;
    background:#fff;
    padding:35px 25px;
    border-radius:16px;
    text-align:center;
    position:relative;
    box-shadow:0 10px 30px rgba(0,0,0,.2);
}
.avatar{
    width:85px;
    height:85px;
    background:#6B4226;
    color:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:34px;
    position:absolute;
    top:-42px;
    left:50%;
    transform:translateX(-50%);
}
h2{
    margin-top:38px;
    color:#6B4226;
}
label{
    float:left;
    margin-top:10px;
    font-weight:600;
}
input{
    width:100%;
    padding:8px;
    margin-top:5px;
}
button{
    margin-top:15px;
    width:100%;
    padding:10px;
    background:#6B4226;
    color:#fff;
    border:none;
    border-radius:6px;
}
.success{color:green;}
.error{color:red;}
</style>
</head>

<body>

<?php include './sidebar.php'; ?>

<div class="content-area">
<div class="profile-wrapper">

<div class="profile-card">

    <div class="avatar">
        <i class="fa-solid fa-user"></i>
    </div>

    <h2>Admin Profile</h2>

    <?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if(isset($error))   echo "<p class='error'>$error</p>"; ?>

    <label>Email</label>
    <input type="email" value="<?=$admin['email']?>" readonly>

    <form method="post">
        <label>New Password</label>
        <input type="password" name="new_password">

        <label>Confirm Password</label>
        <input type="password" name="confirm_password">

        <button name="update_password">Update Password</button>
    </form>

</div>
</div>
</div>

<?php include '../components/script.php'; ?>
</body>
</html>
