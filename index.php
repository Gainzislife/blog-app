<?php
require_once('database.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>A Blog App</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	</head>
	<body>
		<h1>Blog Title</h1>
		<p>This is a paragraph that summarises what the blog is about.</p>

		<?php for ($postId = 1; $postId < 4; $postId++) : ?>
			<h2>Article <?php echo $postId; ?> title</h2>
			<div>dd Mon YYYY</div>
			<p>A paragraph summarising article <?php echo $postId; ?>.</p>
			<p>
				<a href="#">Read more...</a>
			</p>
		<?php endfor; ?>

	</body>
</html>