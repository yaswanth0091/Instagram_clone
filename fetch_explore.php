<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'instagram_clone';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT image_url FROM explore_posts ORDER BY created_at DESC";
$result = $conn->query($sql);

$images = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $images[] = $row['image_url'];
    }
}

header('Content-Type: application/json');
echo json_encode($images);
?>
