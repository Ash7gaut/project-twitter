<?php

session_start();

  try {
    $db = new PDO("mysql:host=localhost;dbname=twitter;port=8889", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      echo $e->getMessage();
    } 

    if (isset($_POST["email"]) AND isset($_POST["password"]))
    {
        if (!empty($_POST["email"]) AND !empty($_POST["password"]))
        {
            $email = $_POST["email"];
            $req = $db->prepare("SELECT id, email, password FROM User WHERE email = :email AND password = password");
            $req-> execute(array(
                "email" => $email));
            $resultat = $req->fetch();

             // dans le if
            if (password_verify($_POST["password"], $resultat["password"]))  {
              echo "Vous êtes connecté !<br/>";


              $_SESSION["user"] = $resultat["id"];

              header("Location: home.php");

              // session

          }
          $req->closeCursor();
            }
            else
            {
              echo "Email ou mot de passe incorrect.<br/>";
        } 
    }

?>


<!--  PARTIE INITIALISATION  ------------------------------>

<?php
  class User {
    private $_name;
    private $_username;
    private $_biography;
    private $_localisation;
    private $_joinedAt;
    private $_profilePicture;
    private $_banner;
    private $_followers;
    private $_followees;
    private $_email;
    private $_password;

    function __construct($name, $username, $biography, $localisation, $joinedAt, $profilePicture, $banner, $followers, $followees, $email, $password ) {

    $this->_name=$name;
    $this->_username=$username;
    $this->_biography=$biography;
    $this->_localisation=$localisation;
    $this->_joinedAt=$_joinedAt;
    $this->_profilePicture=$_profilePicture;
    $this->_banner=$_banner;
    $this->_followers=$_followers;
    $this->_followees=$_followees;
    $this->_email=$_email;
    $this->_password=$_password;
  }

  public function name() {
    return $this->_name;
  }

  public function username() {
    return $this->_username;
  }

  public function biography() {
    return $this->_biography;
  }

  public function localisation() {
    return $this->_localisation;
  }

  public function joinedAt() {
    return $this->_joinedAt;
  }

  public function profilePicture() {
    return $this->_profilePicture;
  }

  public function banner() {
    return $this->_banner;
  }

  public function followers() {
    return $this->_followers;
  }

  public function followees() {
    return $this->_followees;
  }

  public function tweets() {
    return $this->_tweets;
  }

  public function email() {
    return $this->_email;
  }

  public function password() {
    return $this->_password;
  }



}

  class Tweet {
    private User $_user;
    private $_likes;
    private $_comments;
    private $_publishedAt;
    private $_content;
    private $_tweets;

    function __construct($user, $likes, $comments, $publishedAt, $content, $tweets) {
      $this->_user=$user;
      $this->_likes=$likes;
      $this->_comments=$comments;
      $this->_publishedAt=$publishedAt;
      $this->_content=$content;
      $this->_tweets=$_weets;
    
    }

    public function user() {
      return $this->_user;
    }

    public function likes() {
      return $this->_likes;
    }

    public function comments() {
      return $this->_comments;
    }

    public function publishedAt() {
      return $this->_publishedAt;
    }

    public function content() {
      return $this->_content;
    }

    public function tweets() {
      return $this->_tweets;
    }

  }


?>

<!--  PARTIE HTML  ------------------------------>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Twitter du pauvre</title>
</head>
<body>
  
<div class="border-bg">
      <div class="left">  
        <img class="twitter" src="images/twitter.png">
      </div>
      <div class="right">
        <img class="logo" src="images/logo.png">
        <div class="other-page">
          <p class="title">Connexion</p>
          <a href="register.php">S'inscrire</a>
        </div>
        <form action="login.php" method="post">
          <label class="rand" for="email">Email</label>
          <input type="email" class="input-start" id="email" name="email"/>

          <label class="rand" for="password">Mot de passe</label>
          <input type="password" class="input-start" id="password" name="password"/>

          <button class="next" type="submit">Suivant</button>
        </form>
      </div>
    </div>



</body>
</html>