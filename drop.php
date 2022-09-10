<!DOCTYPE html>
<html lang="en-US">
<head>
  <title> Drop Tables (P2) </title>
</head>
<body>
  <?php

  require_once "../../config.php";

  try {

    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

    $query = file_get_contents('drop.sql');
    $dbh->exec($query);
    echo "<p> Successfully dropped tables. </p>";


  }
  catch (PDOException $error) {
    echo "<p>Error dropping tables. </p>";
    echo "<br>";
    echo "<p>" . $error->getMessage() . "</p>";
  }

  ?>
</body>
</html>
