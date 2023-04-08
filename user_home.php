<?php
// for users that ARE logged in and ARE NOT admins
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
} 
if ($_SESSION['isAdmin'] == 1) {
    header("Location: admin_home.php");
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

// Retrieve the top 3 trending topics from the database
$query = "SELECT topic FROM post GROUP BY topic ORDER BY COUNT(*) DESC LIMIT 3";
$result_trending = $mysqli->query($query);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<header>

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

</header>
<div class="container">
<aside>
    <div>
        <h3>Create a New Post</h3>
        <a href="new_post.php">New Post</a>
    </div>
            <?php // display the list of trending topics
                echo "<h3>Trending Topics!</h3>";
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($result_trending)) {?>
                <?php echo "<li>"; ?>
                <a href="topic.php?id=<?php echo $row['topic']; ?>" class="stretched-link"><?php echo $row['topic']; ?></a>
                <?php echo "</li>"; ?>
                <?php }?>
                <?php echo "</ul>"; ?>
    <h4>Community Guidelines</h4>
    <ul>
        <li>be kind</li>
        <li>be appropriate</li>
        <li>be on topic</li>
        <li>Failure to follow rules may result in removal of post or account.</li>
    </ul>
</aside>
<main>
    <?php foreach ($posts as $post) : ?>
        <div>
                <div>
                    <h3><?php echo $post["title"]; ?></h3>
                    <p><?php echo substr($post['content'], 0, 200); ?></p>
                    <h5><?php echo $post["username"]; ?></h5>
                    <a href="post.php?id=<?php echo $post['postId']; ?>" class="stretched-link">Full Post</a>
                </div>
                <div>
                    <img src="<?php echo $post["image"]; ?>" class="img-changing" />
                </div>
        </div>
    <?php endforeach; ?>
</main>
<footer>
    <div>
        <h4>Created by Jasmine</h3>
    </div>
    <div>
        <a href="about.php" class="stretched-link">About</a>
        <a href="contact.php" class="stretched-link">Contact Us</a>
        <a href="faq.php" class="stretched-link">FAQs</a>
    </div>
</footer>
</div>
</html>