<?php
// for users that ARE logged in and ARE admins
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
} 
if (!$_SESSION['isAdmin'] ==1) {
    header("Location: user_home.php");
    exit;
}
// search posts
$mysqli = require __DIR__ . '/database.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM post WHERE content LIKE '%$search%' ORDER BY date DESC";
$result = $mysqli->query($sql);
$posts = array();

while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

// all users, not admins

$sql2 = "SELECT * FROM user WHERE isAdmin = 0";
$result2 = $mysqli->query($sql2);
$users = array();

while ($row = $result2->fetch_assoc()) {
    $users[] = $row;
}

$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Home</title>
    <link rel="stylesheet" href="./css/styles.css" />
   </head>

<body>
        <div>
            <form action="" method="get">
                <input type="text" placeholder="Search..." name="search" value="<?php echo $search ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    <h1> Welcome, Admin. </h1>
        <div>
            <h2> Posts: </h2>
            <?php foreach ($posts as $post) : ?>
                <div>
                        <div>
                            <h3>
                                <?php echo $post["title"]; ?></h3>
                                <?php echo substr($post['content'], 0, 200); ?>
                                <a href="post.php?id=<?php echo $post['postId']; ?>" class="stretched-link">Full Post</a>
                        </div>
                        <div>
                            <img src="<?php echo $post["postImage"]; ?>" alt="post Image" class="img-changing" />
                        </div>
                        
                        <form action='delete_post.php' method='POST'
                            onsubmit="return confirm('Are you sure you want to delete this post?')">
                            <input type="hidden" name="postId" id="postId" value="<?php echo $post['postId']; ?>">
                            <input type="submit" value="Delete Post">
                        </form>
                </div>
            <?php endforeach; ?>
        </div>
        <h2> Users: </h2>
        // list all users here
        <?php foreach ($users as $user) : ?>
                <div>
                        <div>
                            <h3>
                                <?php echo $user["username"]; ?></h3>
                                <?php echo $user["nickname"]; ?>
                                <a href="profile.php?id=<?php echo $user['username']; ?>" class="stretched-link">Full User Profile</a>
                        <form action='delete_user.php' method='POST'
                            onsubmit="return confirm('Are you sure you want to delete this user?')">
                            <input type="hidden" name="username" id="username" value="<?php echo $user["username"]; ?>">
                            <input type="submit" value="Delete User">
                        </form>
                        </div>
                        <div>
                            <img src="<?php echo $user["profileImage"]; ?>" alt="user Image" class="rounded-circle"
                            width="100" height="100" />
                        </div>
                </div>
            <?php endforeach; ?>
</body>

</html>