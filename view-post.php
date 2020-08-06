<?php
require_once('lib/database.php');
require('lib/common.php');

// Get the post ID
if (isset($_GET['post_id'])) {
  $postId = $_GET['post_id'];
} else {
  $postId = 0;
}

$query = 'SELECT title, created_at, body
          FROM post
          WHERE id = :id';
$stmt = $db->prepare($query);

if ($stmt === false) {
  throw new Exception('There was a problem preparing this query');
}

$result = $stmt->execute(array('id' => $postId, ));

if ($result === false) {
  throw new Exception('There was a problem running this query');
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Swap carriage returns for paragraph breaks
$body_text = htmlEscape($row['body']);
$paragraph_text = str_replace('\n', '</p><p>', $body_text);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      A Blog App | <?php echo htmlspecialchars($row['title'], ENT_HTML5, 'UTF-8'); ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
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
      <?php echo $paragraph_text; ?>
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
          <?php echo htmlEscape($comment['text']); ?>
        </div>
      </div>
    <?php endforeach; ?>
  </body>
</html>