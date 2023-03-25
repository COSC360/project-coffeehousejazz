<?php
// Start the session
session_start();

// Database connection settings
$host = 'localhost';
$user = 'root';
$password = 'password';
$database = 'forum';
$mysqli = new mysqli($host, $user, $password, $database);

// Check for errors
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);

    // Execute SQL query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if username exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Set the user session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['isAdmin'];

            // Redirect to the home page
            header('Location: index.html');
            exit;
        }
    }

    // Handle login error
    $login_error = 'Invalid username or password';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($login_error)) { ?>
        <p><?php echo $login_error; ?></p>
    <?php } ?>
    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
