<?php
    session_start();
    //connection à la base de données
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=webreath;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }
?>