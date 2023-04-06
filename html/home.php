<?php
// recent posts from db
$mysqli = require __DIR__ . '/database.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM post WHERE title LIKE '%$search%' ORDER BY date DESC";
$result = $mysqli->query($sql);
$posts = array();

while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    </script>
    <link rel="stylesheet" href="./css/styles.css" />
</head>

<body>
    <h1> Join TheLab! </h1>

        <div>
            <form action="" method="get" class="d-flex">
                <input type="text" placeholder="Search posts by title..." name="search" value="<?php echo $search ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <div>
            <?php foreach ($posts as $post) : ?>
                <div class="col-md-6">
                    <div>
                        <div>
                            <h3>
                                <?php echo $post["title"]; ?></h3>
                            <?php echo substr($post['content'], 0, 100) . '...'; ?>
                            <a>More</a>
                        </div>
                        <div>
                            <img src="<?php echo $post["image"]; ?>" alt="User Image" class="img-changing" />
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>