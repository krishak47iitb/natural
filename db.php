<?php
$servername = "localhost";
$username = "root";
$password = "d5bd38cc3b5bf533c4cf8b2f";
$dbname = "yes_or_no";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
