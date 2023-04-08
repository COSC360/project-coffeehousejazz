<?php

// connect to database
$mysqli = require __DIR__ . '/database.php';

// data from form
$username = $_POST['username'];
$nickname = $_POST['nickname'];
$lastname = $_POST['lastname'];

$email = $_POST['email'];
$password_ = $_POST['password'];

$password = password_hash($password_, PASSWORD_DEFAULT);
// insertion
$query = "INSERT INTO user (username, nickname, email, password) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

// error checking
if ($stmt->errno) {
    echo "Failed to insert user: " . $stmt->error;
    exit();
}

$stmt->bind_param("ssss", $username, $nickname, $email, $password);
// execute statement
if ($stmt->execute()) {
    // back to login page
    header("Location: login.php");
    exit;
} else {
    // username exists already
    if ($mysqli->errno == 1062) {
        die("Username already exists, login!");
        header("Location: login.php");
        exit;
    }
    die($mysqli->error . " " . $mysqli->errno);
}
?>