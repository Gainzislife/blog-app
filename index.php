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
		<?php require('templates/head.php'); ?>
	</head>
	<body>
		<?php require('templates/title.php'); ?>

		<?php if ($not_found) : ?>
			<div class="error box">
				Error: cannot find the requested blog post
			</div>
		<?php endif; ?>

		<div class="post-list">
			<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
				<div class="post-synopsis">
					<h2>
						<?php echo htmlEscape($row['title']); ?>
					</h2>
					<div class="meta">
						<?php echo convertSqlDate($row['created_at']); ?>

						(<?php echo countCommentsForPost($row['id']); ?> comments)
					</div>
					<p>
						<?php echo htmlEscape($row['body']); ?>
					</p>
					<div class="read-more">
						<a href="view-post.php?post_id=<?php echo $row['id']; ?>">Read more...</a>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</body>
</html>