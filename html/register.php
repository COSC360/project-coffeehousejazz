<?php

// connect to database
$mysqli = require __DIR__ . '/database.php';

// data from form
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// insertion
$query = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);

// error checking
if ($stmt->errno) {
    echo "Failed to insert user: " . $stmt->error;
    exit();
}

$stmt->bind_param("sss", $username, $email, $hashed_password);

// execute statement
if ($stmt->execute()) {
    // back to login page
    header("Location: login.php");
    exit;
} else {
    // username exists already
    if ($mysqli->errno == 1062) {
        die("Username already exists!");
    }
    die($mysqli->error . " " . $mysqli->errno);
}
?>