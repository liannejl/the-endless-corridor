<html>
<head>
  <title>Install Endless Corridor DB</title>
</head>
<body>
  <?php
  require_once "../../config.php";
  try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

    // $query = file_get_contents('rooms.sql');
    // $dbh->exec($query);

    $query = file_get_contents("connection.sql");
    $dbh->exec($query);

    echo "<p>Successfully installed databases</p>";
  }
  catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
  }
  ?>
</body>
</html>
