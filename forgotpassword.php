<?php
// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get email from form
    $email = $_POST['email'];

    // connect to db
    $mysqli = require __DIR__ . '/database.php';

    // check if email is in database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // email exists, make new password and update in database
        $new_password = bin2hex(random_bytes(8));
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
        if ($conn->query($sql) === TRUE) {
            // send new password to user's email
            $to = $email;
            $subject = 'New Password';
            $message = 'Your new password is: ' . $new_password;
            $headers = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);

            // redirect to login page
            header('Location: login.php');
            exit();
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        // email doesn't exist in database
        echo "Email not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./css/styles.css" />
</head>
<body>
  <h1>Forgot Password</h1>
  <?php if(isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>
  <form method="post">
    <div>
      <label>Email:</label>
      <input type="email" name="email" class="form-control">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Reset Password</button>
  </form>
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
