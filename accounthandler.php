
<!DOCTYPE html>
<html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <title>Account Created</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div class="centered">
    <?php
    require_once "../../config.php";
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    try {
      if (isset($_POST["username"]) && isset($_POST["password"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
          header("Location: newaccount.php?warning=invalid");
        }
        else {
          $sth = $dbh->prepare("SELECT username FROM user");
          $sth->execute();
          $usernames = $sth->fetchAll();

          $valid = true;
          // checks if username already exists
          foreach ($usernames as $user) {
            if ($user["username"] == $_POST["username"]) {
              $valid = false;
            }
          }
          // var_dump($valid);
          // if username already exists, takes you back to create account
          if (!$valid) {
            header("Location: newaccount.php?warning=taken");
          }

          // if it is a valid user, add to db
          else {
            $sth = $dbh->prepare("INSERT INTO `user` (`username`, `password`)
            VALUES (:username, :password);");
            $sth->bindValue(":username", $_POST["username"]);
            $passHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $sth->bindValue(":password", $passHash);
            if ($sth->execute()) {
              echo "<p>Your Account has been created.</p>";
            }
            else {
              echo "<p>Failed at creating account</p>";
            }
          }
        }

      }
      else {
        header("Location: newaccount.php?warning=invalid");
      }
    }
    catch (PDOException $error) {
      echo "<p>" . $error->getMessage() . "</p>";
    }
     ?>
     <a href="index.php">Back To Log in Page</a><br>
     <a href="logout.php">Log out</a><br>
    <a href="https://atdpsites.berkeley.edu/validate/">Validator</a>
  </div>
  </body>

</html>
