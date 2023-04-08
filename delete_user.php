<?php
session_start();
// only admins can access
if (!($_SESSION['isAdmin']) == 1) {
    header("Location: user_home.php");
    exit;
} elseif (($_SESSION["isAdmin"]) ==1) {
    if (isset($_POST['username'])) {

        $mysqli = require __DIR__ . '/database.php';
        $user = $_POST['username'];

        // delete user comments
        $sql_delete_comments = "DELETE FROM comments WHERE username = ?";
        $stmt = $mysqli->prepare($sql_delete_comments);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->close();

        // delete user likes
        $sql_delete_likes = "DELETE FROM likes WHERE username = ?";
        $stmt = $mysqli->prepare($sql_delete_likes);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->close();

        // delete user posts
        $sql_delete_posts = "DELETE FROM post WHERE username = ?";
        $stmt = $mysqli->prepare($sql_delete_posts);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->close();

        // delete user
        $sql_delete_user = "DELETE FROM user WHERE username = ?";
        $stmt = $mysqli->prepare($sql_delete_user);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->close();
        header("Location: admin_home.php");
        exit;
    }
}
?>