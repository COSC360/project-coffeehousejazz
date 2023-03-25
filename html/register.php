<?php

// Connect to the database
$host = 'localhost';
$user = 'root';
$password = 'password';
$database = 'forum';
$mysqli = new mysqli($host, $user, $password, $database);

// Check for errors
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// form data
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// passwords match
if ($password !== $confirm_password) {
    echo "Passwords do not match.";
    exit();
}

// security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// insertion
$query = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("sss", $username, $email, $hashed_password);
$stmt->execute();

// error check
if ($stmt->errno) {
    echo "Failed to insert user: " . $stmt->error;
    exit();
}

// close
$stmt->close();
$mysqli->close();

// go to login
header("Location: login.html");
exit();

?>