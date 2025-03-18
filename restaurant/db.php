<?php
$host = "localhost";
$user = "root";
$pass = "23389";
$dbname = "restaurant";

// Create a connection
$connect = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>


