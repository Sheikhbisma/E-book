<?php
include './session.php';
include '../auth/dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Dealer</title>
    <?php include './inc/link.php'; ?>
</head>
<body>

<div class="content-area">
    <h2>Add New Dealer</h2>

    <form method="post">
        Dealer Name:
        <input type="text" name="dealer_name" required><br><br>

        City:
        <input type="text" name="city" required><br><br>

        Contact Number:
        <input type="text" name="contact"><br><br>

        Email:
        <input type="email" name="email"><br><br>

        Status:
        <select name="status" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select><br><br>

        <input type="submit" name="submit" value="Add Dealer">
    </form>
</div>

</body>
</html>

<?php
if (isset($_POST['submit'])) {

    $dealer_name = sanitize_data($_POST['dealer_name']);
    $city        = sanitize_data($_POST['city']);
    $contact     = sanitize_data($_POST['contact']);
    $email       = sanitize_data($_POST['email']);
    $status      = sanitize_data($_POST['status']);

    $query = "INSERT INTO dealers 
              (dealer_name, city, contact_number, email, status) 
              VALUES 
              ('$dealer_name', '$city', '$contact', '$email', '$status')";

    if (mysqli_query($conn, $query)) {
        echo showErr("Dealer registered successfully", "success");
    } else {
        echo showErr("Dealer registration failed", "error");
    }
}
?>
