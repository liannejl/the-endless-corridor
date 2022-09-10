<!DOCTYPE html>
<html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <title>Login - The Endless Corridor</title>
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="responsive.css"> -->
    <script src="script.js"></script>
  </head>

  <body>

    <?php

    ?>
    <div class="centered-grid">
      <div class="grid-column">
        <h3> The Endless Corridor &#9939; </h3>  <!-- 9814 // 9939 // 9733 -->
        <p class='flow'>
          Welcome To The Endless Corridor, a text-based (MUD-style) game that progresses you through a series of random rooms based on your actions. Create an account or login on the right to get started.
        </p>
      </div>
      <div class="grid-column">
        <form action="game.php" method="post">
          <p>
            <label for="username">
              Username: <input class="input" type="text" name="username" id="username">
            </label>
          </p>
          <p>
            <label for="password">
              Password: <input class="input" type="password" name="password" id="password">
            </label>
          </p>
          <?php
          if (isset($_GET["valid"])) {
            echo "<p class=\"invalid\">Invalid username or password</p>";
          }
          ?>
          <p>
            <input class="submit" type="submit" name="submit" value="submit">
          </p>
        </form>
        <p>New here? <a href="newaccount.php">Create an account</a>
      </div>
        <a href="https://atdpsites.berkeley.edu/validate/">Validator</a>

      </div>




  </body>

</html>
