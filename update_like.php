<?php
$conn = new mysqli("localhost", "root", "", "instagram_clone");

$reel_id = $_POST['reel_id'];

$sql = "UPDATE likes SET like_count = like_count + 1 WHERE reel_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $reel_id);
$stmt->execute();

echo "success";
?>
