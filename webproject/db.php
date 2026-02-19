<?php
$servername = "localhost";
$username = "bbcap25_11";
$password = "pHuQbjI3";
$database = "wp_bbcap25_11";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
