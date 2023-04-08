<?php
$mysqli = require __DIR__ . '/database.php';
if (isset($_GET['id'])){
    // get posts from topic selected
    $topic = $_GET['id'];
    $query = "SELECT * FROM post WHERE topic LIKE '%$topic%' ORDER BY date DESC";
    $result_topic = $mysqli->query($query);
    $posts = array();
    while ($row = $result_topic->fetch_assoc()) {
        $posts[] = $row;
    }

    // search posts
    if(isset($_GET['search'])){
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $sql = "SELECT * FROM post WHERE content LIKE '%$search%' ORDER BY date DESC";
        $result = $mysqli->query($sql);
        $posts = array();

        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }

        // Retrieve the top 3 trending topics from the database
        $query2 = "SELECT topic FROM post GROUP BY topic ORDER BY COUNT(*) DESC LIMIT 3";
        $result_trending = $mysqli->query($query2);

        $mysqli->close();
    } else{
        header("Location: user_home.php");
        exit;
}
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

<body>
        <div>
            <form action="" method="get" class="d-flex">
                <input type="text" placeholder="Search..." name="search" value="<?php echo $search ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    <a href="login.php" class="buttons">Login or Signup</a>
    <a href="settings.php" class="buttons">User Settings</a>
    <a href="logout.php" class="buttons">Log Out</a>
    <h1> Join TheLab! </h1>
        <div class="col-sm-8">
            <?php foreach ($posts as $post) : ?>
                <div>
                        <div>
                            <h3>
                                <?php echo $post["title"]; ?></h3>
                                <?php echo substr($post['content'], 0, 200); ?>
                                <a href="login.php" class="stretched-link">Login to view full post!</a>
                        </div>
                        <div>
                            <img src="<?php echo $post["image"]; ?>" alt="post Image" class="img-changing" />
                        </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-4">
                    <?php // display the list of trending topics
                        echo "<h2>Trending Topics!</h2>";
                        echo "<ul>";
                        while ($row = mysqli_fetch_assoc($result_trending)) {
                            echo "<li>" . $row['topic'] . "</li>";
                        }
                        echo "</ul>"; ?>
                <div>
                    <h3>Create a New Post</h3>
                    <a href="new_post.php">New Post</a>
                </div>
        </div>
</body>

</html>