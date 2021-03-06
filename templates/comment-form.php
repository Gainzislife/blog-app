<?php
/**
 * @var string $errors
 * @var array $commentData
 */
?>

<?php // Report any errors in a bullet-point list ?>
<?php if ($errors) : ?>
  <div class="error box">
    <ul>
      <?php foreach ($errors as $error) : ?>
        <li><?php echo $error; ?></li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif ?>

<h3>Add your comment</h3>

<form method="POST">
  <p>
    <label for="comment-name">Name:</label>
    <input type="text" id="comment-name" name="comment-name" value="<?php echo htmlEscape($commentData['name']); ?>">
  </p>
  <p>
    <label for="comment-website">Website:</label>
    <input type="text" id="comment-website" name="comment-website" value="<?php echo htmlEscape($commentData['website']); ?>">
  </p>
  <p>
    <label for="comment-text">Comment:</label>
    <textarea type="text" id="comment-text" name="comment-text" rows="8" cols="70">
      <?php echo htmlEscape($commentData['text']); ?>
    </textarea>
  </p>
  <input type="submit" value="Submit comment">
</form>