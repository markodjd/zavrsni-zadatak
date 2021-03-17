<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['post_id'])) {
    header('Location: not-found.php');
}

include_once('connect-to-db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['name'] && $_POST['comment']) {
        $sql = "INSERT INTO comments (author, text, post_id) VALUES ('{$_POST['name']}', '{$_POST['comment']}', {$_GET['post_id']});";
        $statement = $connection->prepare($sql);

        $statement->execute();

        header("Location: single-post.php?post_id={$_GET['post_id']}");
    }
}

$post_id = $_GET['post_id'];

$sql = "SELECT * FROM posts WHERE id = $post_id;";
$statement = $connection->prepare($sql);

$statement->execute();

$statement->setFetchMode(PDO::FETCH_ASSOC);

$post = $statement->fetch();

if (!$post) {
    header('Location: not-found.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../favicon.ico">
    <title>Vivify Blog - <?php echo $post['title']; ?></title>

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

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <h2 class="blog-post-title"><?php echo $post['title']; ?></h2>
                    <p class="blog-post-meta"><?php echo date('F d, Y', strtotime($post['created_at'])); ?> by <a href="#"><?php echo $post['author'] ?></a></p>

                    <p><?php echo $post['body'] ?></p>
                </div><!-- /.blog-post -->
                <?php include_once('comments.php'); ?>
            </div>
            <?php include_once('sidebar.php'); ?>
        </div>
    </main>

    <?php include_once('footer.php'); ?>
    <script src="js/validation.js"></script>
</body>

</html>