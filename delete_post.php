<?php
session_start();
if (!($_SESSION['admin_id'] == 1)) {
  header("Location: user_home.php");
  exit;
} elseif (($_SESSION["admin_id"] == 1)) {
  require_once __DIR__ . '/database.php';

  //get post id
  if (isset($_POST['postId']) && !empty($_POST['postId'])) {
    $postId = $_POST['postId'];

    // delete user comments
    $sql_delete_comments = "DELETE FROM comments WHERE postId = ?";
    $stmt = $mysqli->prepare($sql_delete_comments);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $stmt->close();

    // delete user likes
    $sql_delete_likes = "DELETE FROM likes WHERE postId = ?";
    $stmt = $mysqli->prepare($sql_delete_likes);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $stmt->close();

    // delete user posts
    $sql_delete_posts = "DELETE FROM post WHERE postId = ?";
    $stmt = $mysqli->prepare($sql_delete_posts);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $stmt->close();

}
}
?>