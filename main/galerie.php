<link rel="stylesheet" href="style.css">

<?php
  session_start();
  $flag = $_SESSION['flag'];
  include_once '../config/database.php';
  try {
      $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $bdd->prepare("SELECT username, flag, montage, id FROM montages ORDER BY `date` DESC");
      $query->execute();

      $i = 0;
      $tab = null;
      while ($val = $query->fetch()) {
        $querycomments= $bdd->prepare("SELECT commentaire, flag FROM comments WHERE idmontage=:id ORDER BY `date` ASC");
        $querycomments->execute(array(':id' => $val[3]));
        echo '<div class="photocontainerhome">';
          echo "<div class='posterhome'><p>$val[0]</p></div>";
          echo "<img class='photohome' src='$val[2]'/> <br/>";
          
          echo '<div class="commentshome">';
          $querylike= $bdd->prepare("SELECT * FROM likes WHERE idmontage=:idmontage AND flag=:flag");
          $querylike->execute(array(':idmontage' => $val[3], ':flag' => $flag));
    
          $like = $querylike->fetch();
          if ($like == null) {
            echo  "<form method='post'action='./like.php'>
            <input type='hidden' name='id' value='$val[3]' >
            <input type='hidden' name='flag' value='$flag' >
            <input type='submit' value='Like'></form>";
          }
          else
          {
            echo  "<form method='post'action='./like.php'>
            <input type='hidden' name='id' value='$val[3]' >
            <input type='hidden' name='flag' value='$flag' >
            <input type='submit' value='DisLike'></form>";
          }


            echo  "<form method='post'action='./commentaire.php'>
                  <input type='hidden' name='id' value='$val[3]' >
                  <input type='hidden' name='flag' value='$flag' >
                  <input type='text' name='comment' value='' required> 
                  <input type='submit' value='Envoyer'></form>";
            while ($val = $querycomments->fetch()) {
              $commentuser= $bdd->prepare("SELECT username FROM users WHERE flag=:flag");
              $commentuser->execute(array(':flag' => $val[1]));
              $user = $commentuser->fetch();
              echo "<div class='comcontainerhome'><p class='comcontenthome'>$user[0]</p><p class='comcontent2home'>$val[0]</p></div>";
            }
          echo '</div>';
        echo '</div>';

        $tab[$i] = $val;
        $i++;
      }
      $query->closeCursor();
      return ($tab);
    } catch (PDOException $e) {
      return ($e->getMessage());
    }

?>