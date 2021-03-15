<?php

$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "blog";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$post_id = $_GET['post_id'];

$sql = "SELECT * FROM posts WHERE id = $post_id;";
$statement = $connection->prepare($sql);

$statement->execute();

$statement->setFetchMode(PDO::FETCH_ASSOC);

$post = $statement->fetch();

?>

<ul class="comments">
    <?php

    $sql = "SELECT * FROM comments WHERE post_id = $post_id;";
    $statement = $connection->prepare($sql);

    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $comments = $statement->fetchAll();

    ?>

    <?php foreach ($comments as $comment) { ?>
        <li>
            <h5><?php echo $comment['author'] ?></h5>
            <p><?php echo $comment['text'] ?></p>
        </li>
        <hr />
    <?php } ?>
</ul>