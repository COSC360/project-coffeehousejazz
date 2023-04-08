<?php

$host = "localhost";
$dbname = "db_37138427";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Failed to connect: " . $mysqli->connect_error);
}

return $mysqli;