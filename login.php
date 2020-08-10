<!DOCTYPE html>
<html>
  <head>
    <?php require 'templates/head.php' ?>
    <title>A Blog App | Login</title>
  </head>
  <body>
    <?php require('templates/title.php'); ?>

    <p>Login here:</p>

    <form method="POST">
      <p>
        Username:
        <input type="text" name="username">
      </p>
      <p>
        Password:
        <input type="password" name="password">
      </p>
      <input type="submit" name="submit" value="Login">
    </form>
  </body>
</html>