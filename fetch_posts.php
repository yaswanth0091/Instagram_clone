<?php
$conn = new mysqli("localhost", "root", "", "insta_clone");

$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $conn->query($sql);

$posts = [];

while ($row = $result->fetch_assoc()) {
    $post_id = $row['id'];
    $comment_sql = "SELECT comment_text FROM comments WHERE post_id = $post_id";
    $comment_result = $conn->query($comment_sql);

    $comments = [];
    while ($comment_row = $comment_result->fetch_assoc()) {
        $comments[] = $comment_row['comment_text'];
    }

    $posts[] = [
        'id' => $row['id'],
        'username' => $row['username'],
        'image_url' => $row['image_url'],
        'caption' => $row['caption'],
        'likes' => $row['likes'],
        'comments' => $comments
    ];
}

echo json_encode($posts);
?>
