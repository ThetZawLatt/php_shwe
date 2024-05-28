<?php
// Database connection details
$servername = "localhost";
$username = "id22098202_shwe";
$password = "Shw3t@iks@napp";
$dbname = "id22098202_shwetaiksan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
