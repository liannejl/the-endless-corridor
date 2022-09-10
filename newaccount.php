<!DOCTYPE html>
<html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <title>Create Account - Endless Corridor</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  </head>

  <body>
    <div class="centered">
      <h3 class='typewriter'> Create A New Account </h3>
      <form action="accounthandler.php" method="post">
        <p>
          <label for="username">
            Username: <input class="input"type="text" name="username" id="username">
          </label>
        </p>
        <p>
          <label for="password">
            Password: <input class="input" type="password" name="password" id="password">
          </label>
        </p>
        <p>
          <input class="submit" type="submit" name="submit" value="submit">
        </p>
      </form>
      <?php
      if (isset($_GET["warning"])) {
        if ($_GET["warning"] == "taken") {
          echo "<p class=\"invalid\">Username taken</p>";
        }
        else {
          echo "<p class=\"invalid\">Invalid username or password</p>";
        }
      }
       ?>
      <a href="index.php"> Back To Login Page </a><br>

      <a href="https://atdpsites.berkeley.edu/validate/">Validator</a>
    </div>

  </body>

</html>
