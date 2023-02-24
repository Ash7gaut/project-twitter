<?php
// $dsn = 'mysql:host=localhost;dbname=twitter';
// $username = 'root';
// $password = '';
// $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
// $db = new PDO($email, $name, $username, $biography, $localisation, $profilePicture, $banner, $email, $password);

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

if (!empty($_POST)) {
    $file_name = '';
    var_dump($_FILES['profilePicture']);
    if (isset($_FILES['profilePicture'])) {

      $tmp_name = $_FILES['profilePicture']['tmp_name'];

      $file_extension = strrchr($_FILES['profilePicture']['type'], "/");
      $file_extension = str_replace("/", ".", $file_extension);

      $file_name = date("ymdhs") . $file_extension;
      $folder = './upload/';

      if(!isset($error)) {
          if(move_uploaded_file($tmp_name, $folder . $file_name)) {
              echo "C'est réussi !";
          }
          else {
              echo "Ah...il semblerait que ça ne se passe pas comme prévu..";
          }
      }
      else {
          echo '<div>' . $error . '</div>';
      }
  }


    $sql = "UPDATE User SET name = :name, username = :username, biography = :biography, localisation = :localisation, profilePicture = :profilePicture, banner = :banner, email = :email, password = :password WHERE id = :id";
    
    $q = $db->prepare($sql);

    $name = $_POST['name'];
    $username = $_POST['username'];
    $biography = $_POST['biography'];
    $localisation = $_POST['localisation'];
    $profilePicture = $file_name;
    $banner = $_POST['banner'];
    $email = $_POST['email'];


    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);


    $q->bindParam(":name", $name);
    $q->bindParam(":username", $username);
    $q->bindParam(":biography", $biography);
    $q->bindParam(":localisation", $localisation);
    $q->bindParam(":profilePicture", $profilePicture);
    $q->bindParam("banner", $banner);
    $q->bindParam(":email", $email);
    $q->bindParam(":password", $password);
    $q->bindParam(":id", $_SESSION["user"]);

    $q->execute();

    // $statement->execute(compact('id', 'name', 'username', 'biography', 'localisation', 'profilePicture', 'banner', 'email', 'password'));
}

$sql = "SELECT id, name, username, biography, localisation, profilePicture, banner, email, password FROM User WHERE id = :id";

// $statement = $db->prepare($sql);
// $statement->execute();
// $listeUser = $statement->fetchAll(PDO::FETCH_OBJ);

$q = $db->prepare($sql);
$q->bindParam(":id", $_SESSION["user"]);
$q->execute();
$user = $q->fetch();


?>



<!-- Partie HTML -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="changeprofile.css">
  <title>Change Profile</title>
</head>
<body>
  <h1>Change Profile</h1>
  <form action='' method='post' enctype="multipart/form-data">

    <div class="form">
      <ul>
          <li>
            <p>Name</p>
            <input type="text" value="<?= $user['name']; ?>" name="name" />
            <p>Username (@)</p>
            <input type="text" value="<?= $user['username']; ?>" name="username" />
            <p>Biography</p>
            <input type="text" value="<?= $user['biography']; ?>" name="biography" />
            <p>Localisation</p>
            <input type="text" value="<?= $user['localisation']; ?>" name="localisation" />
            <p>Profile Picture</p>
            <input type="file" style="background-color: rgb(45, 45, 45)" value="<?= $user['profilePicture']; ?>" name="profilePicture" />
            <p>Banner</p>
            <input type="file" style="background-color: rgb(45, 45, 45)" background-color: rgb(45, 45, 45) value="<?= $user['banner']; ?>" name="banner" />
            <p>Email</p>
            <input type="text" value="<?= $user['email']; ?>" name="email" />
            <div><input class="change "type='submit' value='Modifier'/></div>
          </li>
      </ul>
    </div>
  </form>

  
</body>
</html>