<?php
session_start();
include('components/header.php');
include('components/nav.php');

if(!$_SESSION['user']){
    $_SESSION['message'] = "Il faut être connecté pour accéder à cette partie du site.";
    header('location: home.php');
    exit();
}

?>


<div class="container">
     <img style="width:150px; border-radius:50%;" src="https://oasys.ch/wp-content/uploads/2019/03/photo-avatar-profil.png" alt="image profil">
    <h4>Profil de <?= $_SESSION['user']['nickname'] ?></h4>
    <div class="box">
        <p>ID : <?= $_SESSION['user']['id'] ?></p>
        <p>Pseudo : <?= $_SESSION['user']['nickname'] ?></p>
        <p>@email : <?= $_SESSION['user']['email'] ?></p>
    </div>
</div>


<?php
include('components/footer.php');
?>