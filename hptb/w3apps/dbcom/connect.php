<?php
// Required fields
$server = "localhost";
$username = "root";
$userPassword = "";
$databaseName = "mist_hptb";

// Create connection
global $conn;
$conn = new mysqli($server, $username, $userPassword, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>