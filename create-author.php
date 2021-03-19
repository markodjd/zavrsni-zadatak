<?php
include_once('connect-to-db.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST['first-name'] && $_POST['last-name'] && $_POST['gender']) {

        $sql = "INSERT INTO author (first_name, last_name, gender) VALUES ('{$_POST['first-name']}', '{$_POST['last-name']}', '{$_POST['gender']}');";
        $statement = $connection->prepare($sql);

        $statement->execute();

        header("Location: create-post.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../favicon.ico">
    <title>Vivify Blog - Create Author</title>

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
                <form class="create-post-form" action="create-author.php" method="POST">
                    <div class="form-group">
                        <label for="first-name">First name</label>
                        <input name="first-name" type="text" class="form-control" id="first-name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last name</label>
                        <input name="last-name" type="text" class="form-control" id="last-name" placeholder="Enter post title ">
                    </div>
                    <div class="form-group create-author-gender">
                        <label for="male">Male</label>
                        <input id="male" class="form-control" name="gender" type="radio" value="M" checked />
                        <label for="female">Female</label>
                        <input id="female" class="form-control" name="gender" type="radio" value="Z" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <?php include_once('sidebar.php'); ?>
        </div>
    </main>
    <?php include_once('footer.php'); ?>
    <script src="js/validation.js"></script>
</body>

</html>