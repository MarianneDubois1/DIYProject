<?php

function findAllUsers()
{
    require('./bdd.php');
    $sql = "SELECT * FROM `user`";
    $req = $db->query($sql);
    $users = $req->fetchAll();
    return $users;
}

function deleteUserById($id)
{
    require('./bdd.php');
    $sql = "DELETE FROM `user` WHERE `id` = $id";
    $db->query($sql);
}

function addUser($nickname, $email, $password)
{
    require('./bdd.php');
    $sql = "INSERT INTO `user` (`nickname`, `email`, `password`) VALUES (:nickname, :email, :password)";
    $req = $db->prepare($sql);
    $req->bindValue(':nickname', $nickname, PDO::PARAM_STR);
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->bindValue(':password', $password, PDO::PARAM_STR);
    $req->execute();
    return $db->lastInsertId();
}

function findUserByEmail($email)
{
    require('./bdd.php');
    $sql = "SELECT * FROM `user` WHERE `email` = :email";
    $req = $db->prepare($sql);
    $req->bindValue(":email", $email, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch();
    return $user;
}
