<?php
// $dsn = 'mysql:host=localhost;dbname=twitter';
// $username = 'root';
// $password = '';
// $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
// $db = new PDO($email, $name, $username, $biography, $localisation, $profilePicture, $banner, $email, $password);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $sql = "UPDATE auteurs SET name = :name, username = :username, biography = :biography, localisation = :localisation, profilePicture = :profilePicture, banner = :banner, email = :email, password = :password WHERE id = :id";
  $statement = $db->prepare($sql);

  foreach ($_POST['id'] as $id) {
    $nom = $_POST['nom'][$id] ?? '';
    $prenom = $_POST['prenom'][$id] ?? '';
    $statement->execute(compact('id', 'name', 'username', 'biography', 'localisation', 'profilePicture', 'banner', 'email', 'password'));
  }
}

$sql = "SELECT id', 'name', 'username', 'biography', 'localisation', 'profilePicture', 'banner', 'email', 'password' FROM User";

$statement = $db->prepare($sql);
$statement->execute();
$listeUser = $statement->fetchAll(PDO::FETCH_OBJ);

$qCategories = $db->prepare($queryCategories);
$qCategories->execute();
$categories = $qCategories->fetchAll();

?>
<form action='' method='post'>
  <ul>
    <?php foreach ($listeUser as $User) { ?>
      <li>
        <input type="hidden" value="<?= $auteur->id; ?>" name="id[]" />
        <input type="text" value="<?= $auteur->nom; ?>" name="nom[<?= $auteur->id; ?>]" />
        <input type="text" value="<?= $auteur->prenom; ?>" name="prenom[<?= $auteur->id; ?>]" />
      </li>
    <?php } ?>
  </ul>
  <div><input type='submit' value='modifier' /></div>
</form>


<!-- Partie HTML -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="home.css">
  <title>Profile</title>
</head>
<body>
  
</body>
</html>