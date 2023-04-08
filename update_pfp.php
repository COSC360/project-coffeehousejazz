<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}

$mysqli = require __DIR__ . '/database.php';

// update the profile picture
if (isset($_FILES["profile-photo"])) {
    $profileImage = $_FILES["profile-photo"]["name"];
    $profileImage_temp = $_FILES["profile-photo"]["temp_name"];
    $username = $_SESSION["username"];

    $image_dir = 'uploads/';
    $image_path = $image_dir . $profileImage;
    move_uploaded_file($profileImage_temp, $image_path);

    $sql = "UPDATE user SET profileImage = ? WHERE username = ?";
    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error " . $mysqli->error);
    }

    $stmt->bind_param("ss", $image_path, $username);

    if (!$stmt->execute()) {
        die($mysqli->error . " " . $mysqli->errno);
    }
    // refresh and show results
    header("Location: settings.php");
    exit;
}

?>