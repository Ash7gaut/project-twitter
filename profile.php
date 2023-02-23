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


  $sql = "SELECT id, name, username, biography, localisation, profilePicture, joinedAt, banner, email FROM User WHERE id = :id";
  
  $q = $db->prepare($sql);
  
  $q->bindParam(":id", $_SESSION["user"]);

  $q->execute();

  // $sql = "SELECT id, name, username, biography, localisation, profilePicture, banner, email, password FROM User WHERE id = :id";

// $q = $db->prepare($sql);
// $q->bindParam(":id", $_SESSION["user"]);
// $q->execute();
$user = $q->fetch();



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
          <img class="user-banner" src="/">
        </div>
        <div class="pp">
          <img class="user-pp" src ="/">
        </div>
        <div class="name">
          <p><?= $user['name']; ?></p>
        </div>
        <div class="username">
          <p><?= $user['username']; ?></p>
        </div>
        <div class="biography">
          <p><?= $user['biography']; ?></p>
        </div>
        <div class="localisation">
          <p><?= $user['localisation']; ?></p>
        </div>
        <div class="joinedat">
          <p><?= $user['joinedAt']; ?></p>
        </div>


  </section>

  <script src="script.js"></script>
</body>
</html>










