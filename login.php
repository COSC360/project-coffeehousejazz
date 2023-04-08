<?php

//form stuff
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = require __DIR__ . '/database.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = ?";
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
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['isAdmin'] = $user['isAdmin'];
            
            if($user['isAdmin'] == 1){
                // go admin home
                header('Location: admin_home.php');
                exit;
            }

            // go user home
            header('Location: user_home.php');
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="./css/styles.css" />
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
        <p class="para">Forgot Password? <a href="forgotpassword.php">Reset Link</a>
        <p class="para">Don't have an account? <a href="signup.html">Sign Up</a>
    </div>
</body>
<footer>
    <div>
        <h4>Created by Jasmine</h3>
    </div>
    <div>
        <a href="about.php" class="stretched-link">About</a>
        <a href="contact.php" class="stretched-link">Contact Us</a>
        <a href="faq.php" class="stretched-link">FAQs</a>
        <a href="home.php" class="stretched-link">Home</a>
    </div>
</div>
</footer>
</html>
