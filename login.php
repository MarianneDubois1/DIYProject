<?php
session_start();
require('model/user.php');
include('./components/header.php');
?>

<div class="container">
    <img style="width: 250px;" src="./assets/D.png" alt="logo">
        <h2>Connexion</h2>
        <form class="box" action="login.php" method="POST">
            <label for="email">Email :</label>
            <input type="email" name="email" autocomplete="off">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password">
            <button class="btn" type="submit">Se connecter</button>
        </form> 
        <button class="btn2"><a href="/registration.php"> S'inscrire </a></button>
</div>
    

<?php
// récupération des donénes utilisateurs dans le POST
if(!isset($_POST['email']) && !isset($_POST['password'])
|| empty($_POST['email']) || empty($_POST['password'])){
    $_SESSION['message'] = "Veuillez remplir les champs.";
    
    exit();
}


// vérification si il s'agit bien d'un email
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $_SESSION['message'] = "Adresse email invalide.";
    exit();
}


$user = findUserByEmail($_POST['email']);


// vérification si utilisateur existe
if(!$user){
    $_SESSION['message'] = "L'utilisateur n'existe pas.";

    exit();
}


// comparaison du mdp envoyé et celui en bdd
if(!password_verify($_POST['password'], $user['password'])){
    $_SESSION['message'] = "Les identifiants ne sont pas corrects.";

    exit();
}


// stockage des infos utilisateurs en session
$_SESSION['user'] = [
    'id' => $user['id'],
    'nickname' => $user['nickname'],
    'email' => $user['email'],
    'role' => $user['role'],
    'token' => md5(uniqid())
];

if($user['role'] === '["ROLE_ADMIN"]'){
    header('location: admin.php');
    exit();
}


// redirection
header('location: home.php');
exit();