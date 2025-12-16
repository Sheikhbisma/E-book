<?php
session_start();
include "../auth/dbconnect.php";

/* USER LOGIN CHECK */
if(!isset($_SESSION['user_id'])){
    header("Location: ../user/login.php");
    exit;
}

/* fetch user name */
$user_id = intval($_SESSION['user_id']);
$user_stmt = $conn->prepare("SELECT customer_name FROM customer_register WHERE customer_id=? LIMIT 1");
$user_stmt->bind_param("i",$user_id);
$user_stmt->execute();
$user_res = $user_stmt->get_result();
$user_name = ($user_res->num_rows > 0) ? $user_res->fetch_assoc()['customer_name'] : 'Guest';
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include '../components/meta-links.php' ?>
<style>


h1{
    text-align:center;
    margin-bottom:30px;
    color:#6B4226;
}

</style>
</head>
<body class="pt">
<?php include '../components/header.php' ?>

<div class="container">
    <h1>Welcome, <?=htmlspecialchars($user_name)?>!</h1>

    <!-- Rules Section -->
    <div class="rules card">
        <h3>📜 Rules & Instructions</h3>
        <ul>
            <li>Only registered users can participate.</li>
            <li><strong>Children Essay Competition:</strong> Select a topic, write your essay, and submit within 1 minute.</li>
            <li><strong>Adult PDF / Book Competition:</strong> Upload a PDF / Book with a positive moral or good story.</li>
            <li>Once submitted, admin will review and announce results later.</li>
            <li>Ensure your submission follows the guidelines.</li>
        </ul>
    </div>

    <div class="cards ">

        <!-- ESSAY COMPETITION -->
        <div class="card-page card">
            <h2>✍️ Children Essay Competition</h2>
            <div class="sub">For Children | Essay</div>
            <p>Select one topic and submit your essay within the time limit.</p>
            <p><strong>Example Topics:</strong> My Lovely Home, A Day in My Life, Education, Picnic</p>
            <a href="competition.php">Go to Essay Competition</a>
        </div>

        <!-- PDF / BOOK COMPETITION -->
        <div class="card-page card">
            <h2>📘 Adult PDF / Book Competition</h2>
            <div class="sub">For Adults | PDF / Book</div>
            <p>Upload a PDF or Book file with a positive moral or inspiring story.</p>
            <p><strong>Suggested Book Example:</strong> “The Alchemist” by Paulo Coelho</p>
            <a href="adult_competition.php">Go to PDF / Book Competition</a>
        </div>

    </div>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
