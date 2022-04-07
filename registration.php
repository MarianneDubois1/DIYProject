<?php
session_start();
require('model/user.php');
include('./components/header.php');
?>

<div class="container">
    <img style="width: 250px;" src="./assets/D.png" alt="logo">
    <h2>S'inscrire</h2>
     <form class="box" action="registration.php" method="POST">
          <label for="nickname">Pseudo :</label>
          <input type="text" name="nickname" autocomplete="off">
          <label for="email">Email :</label>
          <input type="email" name="email" autocomplete="off">
          <label for="password">Mot de passe :</label>
          <input type="password" name="password">
          <button class="btn" type="submit">Envoyer</button>
     </form>

     <button class="btn2"><a href="/login.php"> Se connecter </a></button>
</div>



<?php
if(!isset($_POST['email']) && !isset($_POST['password']) && !isset($_POST['nickname'])
|| empty($_POST['email']) || empty($_POST['password']) || empty($_POST['nickname']) ){
    $_SESSION['message'] = "Veuillez remplir les champs.";
  
    exit();
}

if(strlen($_POST['password']) < 4 || strlen($_POST['password']) > 12){
    $_SESSION['message'] = "Le mot de passe doit contenir entre 4 et 12 caractères.";
    
    exit();
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $_SESSION['message'] = "Adresse email invalide.";
   
    exit();
}

// dejouer faille XSS
$rawPassword = strip_tags($_POST['password']);
$password = password_hash($rawPassword, PASSWORD_BCRYPT);
$email = $_POST['email'];
$nickname = strip_tags($_POST['nickname']);


// c'est pas top top... :(
$id = addUser($nickname, $email, $password);


// stockage des infos utilisateurs en session
$_SESSION['user'] = [
    'id' => $id,
    'nickname' => $nickname,
    'email' => $email,
    'roles' => "ROLE_USER"
];

// redirection
header('location: home.php');
exit();
?>
