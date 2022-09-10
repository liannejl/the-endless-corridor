<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en-US">

  <head>
    <meta charset="UTF-8">
    <title>Endless Corridor</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- JQuery -->
    <script src="script.js"></script>
  </head>

  <body>
    <div class="chatbox">
    <?php
    require_once "../../config.php";
    try {
      $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

      if (!isset($_SESSION["game"])) {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
          $sth = $dbh->prepare("SELECT * FROM user WHERE username = :currentUser");
          $sth->bindValue(":currentUser", $_POST["username"]);
          // username is valid?
          if ($sth->execute()) {
            $currentUserInfo = $sth->fetch();
            // password is valid?
            if (password_verify($_POST["password"], $currentUserInfo["password"])) {
              $_SESSION["game"] = $currentUserInfo["id"];
            }
            else {
              header("Location: index.php?valid=false");
            }
          }
          else {
            header("Location: index.php?valid=false");
          }
        }
        else {
          header("Location: index.php?valid=false");
        }
      }

      $sth = $dbh->prepare("SELECT * FROM room");
      $sth->execute();
      $room = $sth->fetchAll();

      //first entering game
      if (!isset($_POST["action"])) {
        $sth = $dbh->prepare("SELECT * FROM progress");
        $sth->execute();
        $playerProgress = $sth->fetchAll();

        $newPlayer = true;
        foreach($playerProgress as $progress) {
          if ($progress["player_id"] == $_SESSION["game"]) {
            $newPlayer = false;
          }
        }

        //if new player
        if ($newPlayer) {
          $sth = $dbh->prepare("SELECT * FROM room WHERE id = 1");
          $sth->execute();
          $start = $sth->fetch();

          $intro = "Welcome To The Endless Corridor. A game where you go on your own adventure and
           progress through rooms to make it to the end. Read the room description then make a choice on
           where you want to go by typing in specific keywords. (Example: 'Go To First Door') If you get
           stuck, you can type in /help to view the keywords to progress onwards.";

          echo "<p class='typewriter'>" . $intro . "</p>";
          echo "<p class='typewriter'>" . $start["description"] . "</p>";


          $dialogue = "<p>" . $intro . "</p>" . "<p>" . $start["description"] . "</p>";
          $sth = $dbh->prepare("INSERT INTO `progress` (`player_id`, `room_id`, `dialogue`)
          VALUES (:player_id, :room_id, :dialogue);");
          $sth->bindValue(":player_id", $_SESSION["game"]);
          $sth->bindValue(":room_id", $start["id"]);
          $sth->bindValue(":dialogue", $dialogue);
          $sth->execute();
        }
        //returning player
        else {
          $sth = $dbh->prepare("SELECT * FROM progress WHERE player_id = :id");
          $sth->bindValue(":id", $_SESSION["game"]);
          $sth->execute();
          $currentProgress = $sth->fetch();

          echo $currentProgress["dialogue"];
        }

        // if ($sth->execute()) {
        //   echo "<p>success</p>";
        // }
        // else {
        //   echo "<p>fail</p>";
        // }

      }
      //if typing something in
      else {
        //save what they're typing in to the dialogue
        $sth = $dbh->prepare("SELECT * FROM progress WHERE player_id = :currentPlayer");
        $sth->bindValue(":currentPlayer", $_SESSION["game"]);
        $sth->execute();
        // if ($sth->execute()) {
        //   echo "<p>success</p>";
        // }
        // else {
        //   echo "<p>fail</p>";
        // }
        $progress = $sth->fetch();

        echo $progress["dialogue"];
        echo "<p>" . $_POST["action"] . "</p>";

        $newDialogue = $progress["dialogue"] . "<p>" . $_POST["action"] . "</p>";

        // update save data
        $sth = $dbh->prepare("UPDATE progress SET dialogue = :newDialogue
        WHERE player_id = :id");
        $sth->bindValue(":newDialogue", $newDialogue);
        $sth->bindValue(":id", $_SESSION["game"]);
        $sth->execute();
        // if ($sth->execute()) {
        //   echo "<p>success</p>";
        // }
        // else {
        //   echo "<p>fail</p>";
        // }


        $sth = $dbh->prepare("SELECT * FROM room WHERE id = :currentRoomID");
        $sth->bindValue(":currentRoomID", $progress["room_id"]);
        $sth->execute();
        $rooms = $sth->fetch();
        // var_dump($rooms);

        $sth = $dbh->prepare("SELECT * FROM choices WHERE id = :choice1 OR id = :choice2");
        $sth->bindValue(":choice1", $rooms["choice1_id"]);
        $sth->bindValue("choice2", $rooms["choice2_id"]);
        $sth->execute();
        // if ($sth->execute()) {
        //   echo "<p>success</p>";
        // }
        // else {
        //   echo "<p>fail</p>";
        // }
        $choice = $sth->fetchAll();
        // var_dump($choice);

        // check if at an ending room
        $ending = false;
        if ($rooms["choice1_id"] == 0 || $rooms["choice2_id"] == 0) {
          $ending = true;
        }


        $action = strtolower($_POST["action"]);
        if (!$ending) {
          //to check whether one of the two choice keywords is in the user's input
          foreach ($choice as $a_choice) {
            // echo $a_choice["choice"];
            // var_dump(strpos($action, $a_choice["choice"]));
            // var_dump(strpos($action, "play again"));

            //player types in a choice
            if (strpos($action, $a_choice["choice"])>=0 && strpos($action, $a_choice["choice"]) !== false) {

              $sth = $dbh->prepare("SELECT * FROM room WHERE id = :fromID");
              $sth->bindValue(":fromID", $a_choice["goesTo_id"]);
              $sth->execute();
              // if ($sth->execute()) {
              //   echo "<p>success</p>";
              // }
              // else {
              //   echo "<p>fail</p>";
              // }
              $nextRoom = $sth->fetch();
              $nextRoomDescription = "<p>" . $nextRoom["description"] . "</p>";
              echo $nextRoomDescription;

              $sth = $dbh->prepare("SELECT * FROM progress WHERE player_id = :id");
              $sth->bindValue(":id", $_SESSION["game"]);
              $sth->execute();
              $currentProgress = $sth->fetch();

              $newDialogue = $currentProgress["dialogue"] . $nextRoomDescription;
              $sth = $dbh->prepare("UPDATE progress SET dialogue = :newDialogue WHERE player_id = :id");
              $sth->bindValue(":newDialogue", $newDialogue);
              $sth->bindValue(":id", $_SESSION["game"]);
              $sth->execute();

              $sth = $dbh->prepare("UPDATE progress SET room_id = :room_id WHERE player_id = :id;");
              $sth->bindValue(":room_id", $a_choice["goesTo_id"]);
              $sth->bindValue(":id", $_SESSION["game"]);
              $sth->execute();
              // if ($sth->execute()) {
              //   echo "<p>success</p>";
              // }
              // else {
              //   echo "<p>fail</p>";
              // }
              break;
            }
            elseif (strpos($action, '/help') !== false) {
              echo "<p>Keywords to progress on to the next room: ";
              $count = 0;
              foreach ($choice as $a_choice) {
                $count = $count + 1;
                if ($count == 1) {
                  echo $a_choice["choice"] . ", ";
                }
                else {
                  echo $a_choice["choice"];
                }
              }
              echo "</p>";
              break;
            }
          }
        }
        else {
          //player wants to play again
          if (strpos($action, "play again")>=0 && strpos($action, "play again") !== false) {
            // var_dump(strpos($action, "play again"));

            $sth = $dbh->prepare("DELETE FROM progress WHERE player_id = :id");
            $sth->bindValue(":id", $_SESSION["game"]);
            $sth->execute();
            header("Location: game.php");
          }
          // player asking for help at the end
          elseif (strpos($action, '/help') !== false) {
            echo "<p>Type \"play again\" to play again. </p>";
          }
          // player killed monster from flames room
          elseif ($progress["room_id"] == 8) {
            $sth = $dbh->prepare("UPDATE progress SET room_id = 1 WHERE player_id = :id");
            $sth->bindValue(":id", $_SESSION["game"]);
            $sth->execute();

            $sth = $dbh->prepare("SELECT * FROM room WHERE id = 1");
            $sth->execute();
            $firstRoom = $sth->fetch();

            echo "<p>" . $firstRoom["description"] . "</p>";

            $sth = $dbh->prepare("SELECT * FROM progress WHERE player_id = :id");
            $sth->bindValue(":id", $_SESSION["game"]);
            $sth->execute();
            $currentProgress = $sth->fetch();

            $newDialogue = $currentProgress["dialogue"] . $firstRoom["description"];
            $sth = $dbh->prepare("UPDATE progress SET dialogue = :newDialogue WHERE player_id = :id");
            $sth->bindValue(":newDialogue", $newDialogue);
            $sth->bindValue(":id", $_SESSION["game"]);
            $sth->execute();

          }
        }



      }


    }
    catch (PDOException $error) {
      echo "<p>" . $error->getMessage() . "</p>";
    }


       ?>


    </div>
    <div class="userinput">
      <form action="game.php" method="post">
        <input class="strech" type="text" name="action">
        <input class="submit" type="submit" value="Send To Console/ChatBox">
      </form>
    </div>
    <footer class="footer">
      <a href="logout.php">Log out</a>
      <a href="https://atdpsites.berkeley.edu/validate/">Validator</a>
    </footer>
  </body>

</html>
