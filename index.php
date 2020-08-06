<?php
require_once('lib/database.php');
require('lib/common.php');

$stmt = $db->query(
	'SELECT id, title, created_at, body
	 FROM post
	 ORDER BY created_at DESC'
);

if ($stmt === false) {
	throw new Exception('There was a problem running this query');
}

$not_found = isset($_GET['not-found']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>A Blog App</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	</head>
	<body>
		<?php require('templates/title.php'); ?>

		<?php if ($not_found) : ?>
			<div style="border: 1px solid #ff6666; padding: 6px;">
				Error: cannot find the requested blog post
			</div>
		<?php endif ?>

		<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
			<h2>
				<?php echo htmlEscape($row['title']); ?>
			</h2>
			<div>
				<?php echo convertSqlDate($row['created_at']); ?>

				(<?php echo countCommentsForPost($row['id']); ?> comments)
			</div>
			<p>
				<?php echo htmlEscape($row['body']); ?>
			</p>
			<p>
				<a href="view-post.php?post_id=<?php echo $row['id']; ?>">Read more...</a>
			</p>
		<?php endwhile ?>

	</body>
</html>