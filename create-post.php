<?php
include_once('connect-to-db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST['author'] && $_POST['title'] && $_POST['post']) {

        $sql = "INSERT INTO posts (author_id, body, title, created_at) VALUES ('{$_POST['author']}', '{$_POST['post']}', '{$_POST['title']}', NOW());";
        query($connection, $sql, 'POST');

        header("Location: index.php");
    }
}
$sql = "SELECT * FROM author;";
$authors = query($connection, $sql, 'GET', true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../favicon.ico">
    <title>Vivify Blog - Create Post</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>
    <?php include_once('header.php'); ?>
    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-8">
                <form class="create-post-form" action="create-post.php" method="POST">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <select class="form-select form-control" name="author">
                            <?php foreach ($authors as $author) { ?>
                                <option class="<?php echo $author['gender']; ?>" value="<?php echo $author['id']; ?>"><?php echo $author['first_name'] . ' ' . $author['last_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Post title</label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="Enter post title ">
                    </div>
                    <div class="form-group">
                        <label for="post">Post content</label>
                        <textarea name="post" class="form-control" id="post" rows="20" placeholder="Your post..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <?php include_once('sidebar.php'); ?>
        </div>
    </main>
    <?php include_once('footer.php'); ?>
</body>
<script src="js/validation.js"></script>
<script src="js/select.js"></script>

</html>