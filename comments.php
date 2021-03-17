<?php

$sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY id DESC;";
$statement = $connection->prepare($sql);

$statement->execute();

$statement->setFetchMode(PDO::FETCH_ASSOC);

$comments = $statement->fetchAll();

?>

<div>
    <h4>Leave a comment:</h4>
    <form class="comment-form" action="single-post.php?post_id=<?php echo $_GET['post_id'] ?>" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="post">Comment</label>
            <textarea name="comment" class="form-control" id="post" placeholder="Your comment..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php if (count($comments)) { ?>
        <h3 class="comments-title">Comments:</h3>
    <?php } else { ?>
        <h5 class="comments-title">No comments, be first to comment on this post</h5>
    <?php } ?>
    <ul class="comments">
        <?php foreach ($comments as $key => $comment) { ?>
            <li>
                <h5><?php echo $comment['author'] ?></h5>
                <p><?php echo $comment['text'] ?></p>
            </li>
            <hr />
        <?php } ?>
    </ul>
</div>