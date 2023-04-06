<?php

//form stuff
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = require __DIR__ . '/database.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // password is the right one
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password'];

        // password is the right one
        if (password_verify($password, $hashed_password)) {
            // Set the user session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['isAdmin'];

            // back home
            header('Location: index.html');
            exit;
        }
    }

    // wrong login
    die('Invalid username or password');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
    <div class="box2">
        <p class="para">Don't have an account? <a href="signup.php">Sign Up</a>
    </div>
</body>
<div class="container">
    <footer>
    <p> The Lab </p>
        <ul>
            <li class="item">
                <a href="home.php" >Home</a>
            </li>
            <li class="item">
                <a href="home.php">Home/a>
            </li>
            <li class="item">
                <a href="home.php">Home</a>
            </li>
        </ul>
    </footer>
</div>
</html>
