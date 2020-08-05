<?php
require_once('lib/database.php');

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
    <h1>Blog Title</h1>
    <p>This paragraph summarises what the blog is about.</p>

    <h2>
      <?php echo htmlspecialchars($row['title'], ENT_HTML5, 'UTF-8'); ?>
    </h2>
    <div>
      <?php echo $row['created_at']; ?>
    </div>
    <p>
      <?php echo htmlspecialchars($row['body'], ENT_HTML5, 'UTF-8'); ?>
    </p>
  </body>
</html>