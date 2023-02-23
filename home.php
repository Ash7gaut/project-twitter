<?php

session_start();
if(empty($_SESSION["user"])) {
  header("Location: login.php");
  die();
}
$user = $_SESSION["user"];

try {
  // il faudra sûrement changer quelques infos pour vous
  $db = new PDO("mysql:host=localhost:8889;dbname=twitter", "root", "root");
  // permet d'attraper une erreur SQL si elle survient (désactivé par défaut)
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(Exception $e) {
  die('Erreur : '.$e->getMessage());
}


//
// POST A NEW TWEET
//
        if (isset($_POST["tweet"])) {
          echo "tu essaies de tweeter " . $_POST["tweet"];

          $query = "INSERT INTO tweets(content) VALUES (:content)";
          try {
            $q = $db->prepare($query);
  
            $q->bindParam(":content", $_POST["tweet"]);

            $q->execute();
              
          } catch (PDOException $e) {
            echo "Erreur dans la base de données : ".$e->getMessage();
          } catch (Exception $e) {
            echo "Erreur PHP : ".$e->getMessage();
          }
        }



        //
// GET ALL TWEETS
//

// on se connecte à la base de données

  
          // $query = "SELECT profilePicture, text FROM test";
          $query = "SELECT content FROM tweets";

          $result = $db->prepare($query);
          $result->execute();
          $tweets = $result->fetchAll();



      // ?>




<!-- Partie HTML  -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="home.css"> -->
  <link rel="stylesheet" href="test.css">

  <title>Twitter</title>
</head>
<body>
  <!-- <a class="btn-back" href="login.php">Clique moi!</a> -->

  <section class="total">
      <div class="body-left">
        <a href="profile.php" class="edit">Éditer le profil</a>
        <a href="logout.php" class="edit">Déconnexion</a>
      </div>
          <div class="body-right">
              <div class="whats-new">
                <div class="pp">
                  <img class="user-pp" src="">
                </div> 
                <div class="content">
                <form action="home.php" method="post">
                  <textarea cols="80" rows="2" id="title" name="tweet" onblur="javascript:msg_input()" onfocus="javascript:clean_input()">Quoi de neuf ?</textarea>
                  <div class="div-button">
                    <button class="tweeter" type="submit">Tweeter</button>
                  </div>
                </form>
                </div>
              </div>  
            <?php 
              for ($i = 0; $i < count($tweets); $i++) {
            ?>  

            <div class="new-tweets">
              <div class="pp">
                <img class="tweet-pp" src=">">
              </div>

              <div class="content">
                <p> <?php echo $tweets[$i]['content'] ?> </p>
                <div class="icon"> 
                  <img class="comments" src="images/comments.svg">
                  <img class="retweet" src="images/retweet.svg">
                  <img class="like" src="images/likes.svg">
                  <img class="share" src=images/share.svg>
                </div>
              </div>
            </div>
         </div>
    <?php
  }
  
  ?>
  </section>

  <script src="script.js"></script>
</body>
</html>