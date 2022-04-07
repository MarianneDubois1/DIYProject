<?php

try {
    $db = new PDO('mysql:dbname=diyproject;host=127.0.0.1', 'root', '');
    $db->exec('SET NAMES utf8');
    $db->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE, 
        PDO::FETCH_ASSOC);
} catch(PDOException $e){
    echo $e->getMessage();
} 