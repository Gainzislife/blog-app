<?php
require_once('lib/database.php');
require_once('lib/view-post.php');
require('lib/common.php');

// Get the post ID
if (isset($_GET['post_id'])) {
  $postId = $_GET['post_id'];
} else {
  $postId = 0;
}

$row = getPostRow($db, $postId);

// If the post doesn't exist
if (!$row) {
  redirectAndExit('index.php?not-found=1');
}

$errors = null;

if ($_POST) {
  $commentData = array(
    'name' => $_POST['comment-name'],
    'website' => $_POST['comment-website'],
    'text' => $_POST['comment-text'],
  );

  $errors = addCommentToPost($db, $postId, $commentData);

  // If there are no errors, redirect back to self redisplay
  if (!$errors) {
    redirectAndExit('view-post.php?post_id=' . $postId);
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      A Blog App | <?php echo htmlEscape($row['title']); ?>
    </title>
    <?php require('templates/head.php'); ?>
  </head>
  <body>
    <?php require('templates/title.php'); ?>

    <h2>
      <?php echo htmlspecialchars($row['title'], ENT_HTML5, 'UTF-8'); ?>
    </h2>
    <div>
      <?php echo convertSqlDate($row['created_at']); ?>
    </div>
    <p>
      <?php echo convertNewLinesToParagraphs($row['body']); ?>
    </p>

    <h3><?php echo countCommentsForPost($postId); ?> comments</h3>

    <?php foreach (getCommentsForPost($postId) as $comment) : ?>
      <hr>
      <div class="comment">
        <div class="comment-meta">
          Comment from
          <?php echo htmlEscape($comment['name']); ?>
          on
          <?php echo convertSqlDate($comment['created_at']); ?>
        </div>
        <div class="comment-body">
          <?php echo convertNewLinesToParagraphs($comment['text']); ?>
        </div>
      </div>
    <?php endforeach; ?>

    <?php require('templates/comment-form.php'); ?>
  </body>
</html>