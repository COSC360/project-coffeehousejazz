<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}

$mysqli =  require __DIR__ . '/database.php';

$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="css/styles.css">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>


<div class="row">
  <div class="column">
        <form action="" method="get">
        <input type="text" placeholder="Search..." name="search" value="<?php echo $search ?>">
            <button type="submit">Search</button>
        </form>
  </div>
  <div class="column">
    <h1><a href="user_home.php">Salt and Pepper</a></h1>
  </div>
  <div class="column">
            <a href="settings.php">
                            <button type="button" class="btn btn-outline-secondary btn-sm px-4">
                                User Settings
                            </button></a>
            <a href="logout.php">
                            <button type="button" class="btn btn-outline-secondary btn-sm px-4">
                                Logout
                            </button></a>
  </div>
</div>

    <div class="container">
        <main>
            <div>
            <h3>Profile</h3>
            <?php if ($user['profileImage'] != null) { ?>
            <img src="<?php echo $user['profileImage']; ?>" alt="User Image" class="rounded-circle"
                            width="100" height="100">
            <?php } else { ?>
            <img src="./img/defaultpfp.png" alt="User Image" class="rounded-circle" width="100"
                            height="100">
            <?php } ?>
            <h4><?php echo $user['username']; ?> </h4>
            <p><?php echo $user['nickname']; ?> </p>
            <p><?php echo $user['bio']; ?> </p>
            </div>
        <div>
        <div class="comments">
            <h3>Settings</h3>
            <form action="update_pfp.php" method="post" enctype="multipart/form-data">
                <h4> Upload a profile photo: </h4>
                <label for="profile-photo">Profile Photo:</label>
                <input type="file" id="profile-photo" name="profile-photo"><br><br>

                <input type="submit" name="submit" value="Update photo">
            </form>
            <form action="update_profile.php" method="post" enctype="multipart/form-data">
                <h4> Update your info: </h4>

                <label for="nickname">Nickname:</label>
                <input type="text" id="nickname" name="nickname"><br><br>

                <label for="bio">Bio:</label>
                <input type="text" id="bio" name="bio"><br><br>

                <input type="submit" name="submit" value="Update profile info">
            </form>
            </div>
        </div>
        </main>
    </div>
</body>
</html>
