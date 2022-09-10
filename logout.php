<!DOCTYPE html>
<html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <title>Log out - The Endless Corridor</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div class="centered">
    <?php
    session_start();
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
    }
    session_destroy();
    echo "<p>Sucessfully Logged out.</p>";
     ?>
     <a href="index.php">Log in</a><br>
    <a href="https://atdpsites.berkeley.edu/validate/">Validator</a>
  </div>
  </body>

</html>
