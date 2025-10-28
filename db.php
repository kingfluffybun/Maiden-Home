<?php
$servername = "localhost";
$username = "clarence";
$password = "clarencepogi";
$database = "maidenhome_db";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
