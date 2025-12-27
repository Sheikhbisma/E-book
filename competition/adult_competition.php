<?php
session_start();
include "../auth/dbconnect.php";

if(!isset($_SESSION['userid'])){
    echo "<script>alert('Only registered customer will participate in competitions '); window.location='../user/login.php';</script>";
    exit;
}

$user_id = intval($_SESSION['userid']);
$user_stmt = $conn->prepare("SELECT customer_name,customer_email FROM customer_register WHERE customer_id=? LIMIT 1");
$user_stmt->bind_param("i",$user_id);
$user_stmt->execute();
$user_res = $user_stmt->get_result();
$user = ($user_res->num_rows>0) ? $user_res->fetch_assoc() : ['customer_name'=>'Guest','customer_email'=>''];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Adult PDF Submission</title>
<?php include '../components/meta-links.php' ?>
<style>


/* Container */
.wrap {
    max-width: 700px;
    margin: 50px auto;
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

/* Headings */
h2 {
    text-align: center;
    color: #4B2E2E;
    font-size: 32px;
    margin-bottom: 25px;
    letter-spacing: 1px;
}

/* Rules box */
.rules {
    padding: 20px 25px;
    border-radius: 12px;
    margin-bottom: 30px;
    color: #4B2E2E;
    line-height: 1.6;
}
.rules ul { padding-left: 20px; }

/* Form elements */
form input, form button {
    width: 100%;
    padding: 15px;
    margin: 12px 0;
    border-radius: 12px;
    border: 1px solid #d1c4b2;
    font-size: 16px;
    box-sizing: border-box;
    transition: 0.3s;
}
form input:focus {
    border-color: #8B4513;
    outline: none;
    box-shadow: 0 0 8px rgba(139,69,19,0.3);
}

/* Submit button */
form button {
    background: #8B4513;
    color: #fff;
    border: none;
    font-weight: bold;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s;
}
form button:hover {
    background: #A0522D;
    transform: translateY(-2px);
}

/* Responsive */
@media(max-width: 480px){
    .wrap { padding: 30px 20px; }
    h2 { font-size: 26px; }
    form input, form button { padding: 12px; font-size: 14px; }
}
</style>
</head>
<body class="pt">
<?php include '../components/header.php' ?>
<div class="wrap card">
  <h2>📄 PDF Submission</h2>
  <div class="rules">
    <p>Please follow the rules carefully:</p>
    <ul>
      <li>Only registered users can participate.</li>
      <li>Upload your PDF document below (Max size: 5MB recommended).</li>
      <li>After submission, admin will review and announce results later.</li>
    </ul>
  </div>

  <form method="POST" action="submit_adult.php" enctype="multipart/form-data">
     <input type="text" name="name" placeholder="Full Name" class="text-dark" required value="<?php echo htmlspecialchars($user['customer_name']); ?>">
<input type="email" name="email" placeholder="Email" class="text-dark"  required value="<?php echo htmlspecialchars($user['customer_email']); ?>">

      <input type="file" class="text-dark" name="pdf_file" accept="application/pdf" required>
      <button type="submit" class="btn-gold">Submit PDF</button>
  </form>
</div>
<?php include '../components/footer.php' ?>
<?php include '../components/script.php' ?>
</body>
</html>
