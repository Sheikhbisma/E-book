<?php
$host = "localhost";   // your host
$user = "root";        // database username
$pass = "";            // database password
$db   = "ebook";   // your database name

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
