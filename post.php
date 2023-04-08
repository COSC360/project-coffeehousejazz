<?php
session_start();

// connect to the database
$mysqli =  require __DIR__ . '/database.php';

// get username
$userprofilename = $_SESSION['username'];

// check if the post data
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // get post data
    $result = mysqli_query($mysqli, "SELECT * FROM post INNER JOIN user ON post.username = user.username WHERE post.postId=$id  ");
    $row = mysqli_fetch_array($result);

    // get data
    if ($row) {
        $title = $row['title'];
        $content = $row['content'];
        $date = $row['date'];
        $username = $row['username'];
        $image = $row['postImage'];

        // get profile picture of the user who created the post
        $result = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username' ");
        $row = mysqli_fetch_array($result);
        $profilepicture = $row['profileImage'];
    }

    // get the comments
    $result = mysqli_query($mysqli, "SELECT * FROM comments INNER JOIN user ON comments.username = user.username WHERE comments.postId=$id  ");
    $comments = array();
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
} else {
    // home
    header("Location: user_home.php");
}

// comments
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get user_id from session
    session_start();
    $username = $_SESSION['username'];

    // get from url
    $post_id = $_GET['id'];

    // insert comment
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');
    $stmt = $mysqli->prepare("INSERT INTO comments (username, postId, content, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('siss', $username, $post_id, $content, $date);
    $stmt->execute();

    // display new comment
    header("Location: post.php?id=$post_id");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/styles.css">


    <title>Post</title>



<body>

    <main>

    <div class="row">
  <div class="column">
        <form action="" method="get">
        <input type="text" placeholder="Search..." name="search" value="<?php echo $search ?>">
            <button type="submit">Search</button>
        </form>
  </div>
  <div class="column">
    <h1><a href="user_home.php" class="stretched-link">Salt and Pepper</a></h1>
  </div>
  <div class="column">
        <a href="login.php" class="stretched-link">Login or Signup</a> &nbsp
  </div>
</div>

        <div>
            <div>
                <h1><?php echo $title; ?></h1>
                <img src="<?php echo $image; ?>"/>
                <p class="card-text"><?php echo $content; ?></p>
            </div>
            <div>
                <div>
                    <?php
                if (!isset($profilepicture) || empty($profilepicture)) {
                    $profilepicture = './img/defaultpfp.jpg';
                }
                ?>
                    <img src="<?php echo $profilepicture; ?>" style="width: 50px; height: 50px;" />
                    <div>
                        <p>By <?php echo $username; ?></p>
                        <h6><?php echo $date; ?></h6>
                    </div>
                </div> 
            </div>
                    </div>
                </div>
                <div>
            <h3>Comments</h3>
            <div class="comments">
                <?php foreach ($comments as $comment) : ?>
                    <h5><?php echo $comment['username']; ?></h5>
                    <h6><?php echo $comment['date']; ?></h6>
                    <p><?php echo $comment['content']; ?></p>
                <?php endforeach; ?>
                </div>
                <form method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <?php echo "<input type='text' name='username' id='username' value='$userprofilename' readonly />"; ?>
                    </div>
                    <div>
                        <label for="content">Comment</label>
                        <textarea name="content" id="content" rows="5" required></textarea>
                    </div>
                    <button type="submit">Submit</button>
                </form>
        </div>
            </div>
        </div>
    </main>
    <script>
    </script>

</body>

</html>