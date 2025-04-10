<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "insta_clone";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM profile WHERE id = 1";
$result = $conn->query($sql);
$profile = $result->fetch_assoc();
?>

