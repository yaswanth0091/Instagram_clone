<?php
$conn = new mysqli("localhost", "root", "", "insta_clone");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = intval($_POST['post_id']);
    $comment = $conn->real_escape_string($_POST['comment']);
    $conn->query("INSERT INTO comments (post_id, comment_text) VALUES ($post_id, '$comment')");
}
?>
