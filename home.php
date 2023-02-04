<?php

// on se connecte à la base de données
          try {
              // il faudra sûrement changer quelques infos pour vous
              $db = new PDO("mysql:host=localhost:8889;dbname=twitter", "root", "root");
              // permet d'attraper une erreur SQL si elle survient (désactivé par défaut)
              $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } 
          catch(Exception $e) {
              die('Erreur : '.$e->getMessage());
          }
  
          $query = "SELECT profilePicture FROM test";

        $result = $db->prepare($query);
        $result->execute();
        $test = $result->fetchAll();
      // ?>




<!-- Partie HTML  -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>En construction...</title>
</head>
<body>
  <!-- <a class="btn-back" href="login.php">Clique moi!</a> -->

  <section class="total">

    <div class="whats-new">

      <div class="pp">
        <img src="<?=  $test[0]['profilePicture'] ?>">
      </div> 
      <div class="content">
      <form action="home.php" method="post">
        <input type="text" id="title" name="title" required value="Quoi de neuf ?" onblur="javascript:msg_input()" onfocus="javascript:clean_input()"></input>
        <div class="div-button">
          <button class="tweeter" type="submit">Tweeter</button>
        </div>
      </form>

      </div>
    </div>

    <?php 
      for ($i = 0; $i < count($test); $i++) {
    ?>  

    <div class="new-tweets">
      <div class="pp">
        <img src="<?=  $test[$i]['profilePicture'] ?>">
      </div>

      <div class="content">
        <p>A dream of Spring. The North Remembers. The bear and the maiden fair. House Tarly of Horn Hill Winter is coming. The War of the 5 kings. House Tarly of Horn Hill Never Resting. Unbowed, Unbent, Unbroken. A forked purple lightning bolt, on black field speckled with four-pointed stars.</p>
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
  </section>

  <script src="script.js"></script>
</body>
</html>