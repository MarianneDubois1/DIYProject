<?php
session_start();
include('components/header.php');
include('components/nav.php');
require('model/user.php');

if ($_SESSION['user']['role'] !== '["ROLE_ADMIN"]') {
    $_SESSION['message'] = "Vous n'avez pas accès à cette partie du site.";
    header('location: index.php');
    exit();
}

if(isset($_GET['deleteUser']) && $_GET['token'] === $_SESSION['user']['token']){
    deleteUserById($_GET['deleteUser']);
    $_SESSION['message'] = "Utilisateur bien supprimé.";
    unset($_SESSION['message']);
}

$users = findAllUsers();


?>

<div >
    <h2 >DASHBOARD</h2>
    <div class="box2" >
        <h4 style="text-align:center;">Utilisateurs inscrits :</h4>
        <div class="container2">

            <?php foreach ($users as $user) : ?>
                <div>
                <img style="width:100px; border-radius:50%;" src="https://oasys.ch/wp-content/uploads/2019/03/photo-avatar-profil.png" alt="image profil">
                    <div>
                        <h5 ><?= $user['nickname'] ?></h5>
                        <p>ID : <?= $user['id'] ?> </p>
                        <p>Email : <?= $user['email'] ?> </p>
                        <a href="http://localhost:3000/admin.php?deleteUser=<?=$user['id']?>&token=<?=$_SESSION['user']['token']?>" >Bannir</a>
                    </div>
                </div>

            <?php endforeach ?>

        </div>
    </div>
</div>

<?php
include('components/footer.php');