<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}
$mysqli = require __DIR__ . '/database.php';

// update nickname, bio, email
if (isset($_POST["nickname"]) && isset($_POST["bio"])) {
    $nickname = $_POST["nickname"];
    $bio = $_POST["bio"];
    $username = $_SESSION["username"];

    $sql = "UPDATE user SET nickname = ?, bio = ? WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $nickname, $bio, $username);

    if (!$stmt->execute()) {
        die($mysqli->error . " " . $mysqli->errno);
    }else{
        // go back home
        header("Location: user_home.php");
    }
    exit;
}

?>