<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Post</title>
    <link rel="stylesheet" href="./css/styles.css" />
</head>
<div class="row">
  <div class="column">
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
<body>
    <form action="insertPost.php" method="POST" id="post_form">
        <div>
            <p><label for="title">Title</label></p>
            <input type="text" id="title" name="title" placeholder="Title" />
        </div>
        <div>
            <p><label for="content" >Content</label></p>
            <textarea id="content" name="content" rows="3" placeholder="Content"></textarea>
        </div>
        <div>
            <p><label for="topic" >Topic</label></p>
            <input type="text" id="title" name="title" placeholder="Topic" />
        </div>   
        <div>  
            <p><label for="image" >Image</label></p>
            <input type="file"  id="image" name="image" placeholder="Upload Image" />
        </div>
        <div>
            <button type="submit"> Post </button>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            $("#post_form").submit(function (e) {
                e.preventDefault();
                var title = $("#title").val().trim();
                var content = $("#content").val().trim();
                var topic = $("#topic").val().trim();
                var image = $("#image").val().trim();
                if (title == "" || content == "" || topic == "") {
                    alert("Please fill out all fields.");
                } else {
                    this.submit();
                }
            });
        });
    </script>
</body>
</html>