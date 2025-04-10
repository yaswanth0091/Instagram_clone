<?php
$conn = new mysqli("localhost", "root", "", "insta_clone");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = intval($_POST['post_id']);
    $conn->query("UPDATE posts SET likes = likes + 1 WHERE id = $post_id");
}
?>
