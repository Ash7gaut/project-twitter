<?php

session_start();
if(empty($_SESSION["user"])) {
  header("Location: login.php");
  die();
}
$user = $_SESSION["user"];

try {
  $db = new PDO("mysql:host=localhost:8889;dbname=twitter;", "root", "root");

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(Exception $e) {
  die('Erreur : '.$e->getMessage());
}





  $tweetsSql = "SELECT * FROM tweets WHERE user_id = :id";
  $qTweets = $db->prepare($tweetsSql);
  $qTweets->bindParam(":id", $_SESSION["user"]);
  $qTweets->execute();
  $tweets = $qTweets->fetchAll();


  $sql = "SELECT id, name, username, biography, localisation, profilePicture, joinedAt, followers, followees, banner, email FROM User WHERE id = :id";
  $q = $db->prepare($sql);
  $q->bindParam(":id", $_SESSION["user"]);
  $q->execute();

  // $sql = "SELECT id, name, username, biography, localisation, profilePicture, banner, email, password FROM User WHERE id = :id";

// $q = $db->prepare($sql);
// $q->bindParam(":id", $_SESSION["user"]);
// $q->execute();
$user = $q->fetch();

$date = date_format(date_create($user['joinedAt']), 'F Y');

?>

<!-- Partie HTML  -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="home.css"> -->
  <link rel="stylesheet" href="profile.css">

  <title>Twitter</title>
</head>
<body>
  <!-- <a class="btn-back" href="login.php">Clique moi!</a> -->

  <section class="total">
      <div class="header">
        <a href="profile.php" class="edit">Éditer le profil</a>
        <a href="logout.php" class="edit">Déconnexion</a>
      </div>

      <div class="container-profile">
        <div class="banner">
          <img class="user-banner" src="https://media.discordapp.net/attachments/533702987948883978/1078383410860540045/image.png">
        </div>
        <div class="button-username">
          <div class="pp">
            <img class="user-pp" src ="http://localhost:8888/twitter/upload/<?= $user['profilePicture'] ?>">
          </div>
          <div class="button">
            <button>Suivre</button>
          </div>
        </div>
        <div class="name">
          <p><?= $user['name']; ?></p>
        </div>
          <div class="username">
            <p>@<?= $user['username']; ?></p>
          </div>
        <div class="biography">
          <p><?= $user['biography']; ?></p>
        </div>
        <div class="local-joined">
          <div class="localisation">
            <img class="img-localisation" src="images/localisation.svg">
            <p><?= $user['localisation']; ?></p>
          </div>
          <div class="joinedat">
            <img class="img-date" src="images/date.svg">
            <p>has joined Twitter in <?= $date; ?></p>
          </div>
        </div>

        <div class="followers-followees">
          <div class="followees">
            <p><?= $user['followees'] ?> <span class="grey">followees</span> </p>
          </div>
          <div class="followers">
            <p><?= $user['followers'] ?> <span class="grey">followers</span> </p>
          </div>
        </div>

        <?php 
              for ($i = 0; $i < count($tweets); $i++) {
            ?>  
            <div class="new-tweets">
              <div class="pp-followers">
                <img class="tweet-pp" src="http://localhost:8888/twitter/upload/<?= $user['profilePicture'] ?>">
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

            <?php
  }
  
  ?>
         </div>

        </div>


  </section>

  <script src="script.js"></script>
</body>
</html>










