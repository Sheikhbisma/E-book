<?php
include "./dbconnect.php";

if (isset($_POST['submit'])) {

    $name    = $conn->real_escape_string($_POST['name']);
    $email   = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql)) {
        echo "<script>alert('Form Submitted Successfully!');</script>";
        echo "<script>window.location.href='contact.php';</script>";
        exit;
    } else {
        echo "<script>alert('Something went wrong!');</script>";
        echo "<script>window.location.href='contact.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Google font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #590d22, #a4133c);
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* Background circles */
.circle {
    position: absolute;
    border-radius: 50%;
    filter: blur(45px);
    opacity: 0.65;
}
.circle1 {
    width: 270px; height: 270px;
    background: #ff4d6d;
    top: 5%; left: 12%;
}
.circle2 {
    width: 200px; height: 200px;
    background: #c9184a;
    bottom: 8%; right: 10%;
}
.circle3 {
    width: 150px; height: 150px;
    background: #ffb3c1;
    top: 60%; left: 5%;
}

/* MAIN WRAPPER */
.wrapper {
    width: 90%;
    max-width: 980px;
    background: rgba(255,255,255,0.10);
    padding: 0;
    border-radius: 22px;
    display: flex;
    backdrop-filter: blur(18px);
    box-shadow: 0 15px 45px rgba(0,0,0,0.3);
    overflow: hidden;
    animation: slideUp 0.7s ease;
}
@keyframes slideUp {
    from { transform: translateY(50px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
}

/* LEFT FORM AREA */
.left {
    width: 60%;
    padding: 45px;
}

.left h2 {
    font-size: 35px;
    color: #ffe5ec;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 0 0 15px #ffb3c1;
}

/* INPUT STYLING */
input, textarea {
    width: 100%;
    padding: 16px;
    margin-bottom: 16px;
    border-radius: 16px;
    border: 2px solid rgba(255,255,255,0.4);
    background: rgba(255,255,255,0.20);
    color: #fff;
    font-size: 16px;
    transition: .3s ease;
}

input::placeholder, textarea::placeholder {
    color: #ffe5ecc7;
}

input:focus, textarea:focus {
    border-color: #ffb3c1;
    box-shadow: 0 0 12px #ffb3c1;
    transform: scale(1.03);
}

textarea {
    height: 130px;
    resize: none;
}

/* SEND BUTTON */
button {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #ff4d6d, #c9184a, #a4133c);
    background-size: 200%;
    border: none;
    border-radius: 18px;
    color: #fff;
    cursor: pointer;
    font-size: 20px;
    font-weight: 700;
    box-shadow: 0 6px 20px rgba(255,77,109,0.4);
    animation: buttonAnim 4s ease infinite;
    transition: 0.3s;
}
@keyframes buttonAnim {
    0% { background-position: 0%; }
    50% { background-position: 100%; }
    100% { background-position: 0%; }
}
button:hover {
    transform: scale(1.05) translateY(-3px);
}

/* RIGHT PANEL */
.right {
    width: 40%;
    background: rgba(255,255,255,0.18);
    padding: 50px 35px;
    text-align: left;
    backdrop-filter: blur(20px);
    border-left: 1px solid rgba(255,255,255,0.2);
}

.right h3 {
    font-size: 26px;
    color: #ffe5ec;
    margin-bottom: 20px;
    text-shadow: 0 0 12px #ff4d6d;
}

.info-box {
    margin: 15px 0;
    display: flex;
    align-items: center;
    color: #ffe5ec;
    font-size: 17px;
}

.info-box i {
    font-size: 20px;
    margin-right: 12px;
    color: #ffb3c1;
    text-shadow: 0 0 10px #ff4d6d;
}

/* SOCIAL ICONS */
.social-icons {
    margin-top: 25px;
}

.social-icons a {
    display: inline-flex;
    justify-content: center;
    align-items: center;

    width: 50px;
    height: 50px;

    margin-right: 12px;

    background: radial-gradient(circle at top, rgba(255,255,255,0.35), rgba(255,255,255,0.10));
    border: 2px solid rgba(255,255,255,0.45);

    border-radius: 50%;

    color: #ffe5ec;
    font-size: 22px;

    box-shadow: 0 0 15px rgba(255,179,193,0.6);
    backdrop-filter: blur(15px);

    transition: 0.3s ease;
}

.social-icons a:hover {
    transform: scale(1.18);
    background: #ff4d6d;
    border-color: #ffb3c1;
    color: #fff;
    box-shadow: 0 0 25px #ff4d6d;
}

</style>
</head>

<body>

<!-- Background circles -->
<div class="circle circle1"></div>
<div class="circle circle2"></div>
<div class="circle circle3"></div>

<div class="wrapper">

    <!-- LEFT FORM -->
    <div class="left">
        <h2>Contact Us</h2>

        <form method="POST">
            <input type="text" name="name" placeholder="Enter your name" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <textarea name="message" placeholder="Enter your message" required></textarea>

            <button type="submit" name="submit">Send Message</button>
        </form>
    </div>

    <!-- RIGHT SIDE INFORMATION -->
    <div class="right">
        <h3>Get in Touch</h3>

        <div class="info-box"><i class="fa fa-phone"></i> +92 300 0000000</div>
        <div class="info-box"><i class="fa fa-envelope"></i> info@example.com</div>
        <div class="info-box"><i class="fa fa-location-dot"></i> Karachi, Pakistan</div>

        <h3 style="margin-top:25px;">Follow Us</h3>

        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

</div>

</body>
</html>
