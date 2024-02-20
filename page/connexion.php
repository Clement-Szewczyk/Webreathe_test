<?php

    require_once('../script/bdd.php');

    // Si le formulaire est envoyé
    if(isset($_POST['connexion'])){
        // On vérifie que tous les champs sont remplis
        if(!empty($_POST['login']) && !empty($_POST['mdp'])){
            // On récupère les données du formulaire
            $pseudo = $_POST['login'];
            $mdp = $_POST['mdp'];
            // On récupère les données de la base de données
            $selRq = $bdd->prepare('SELECT * FROM user WHERE Login = :login');
            $selRq->execute(["login" => $pseudo]);
            $sel = $selRq->fetch();
            // On vérifie que le pseudo existe et que le mot de passe est correct
            if($sel){
                if(password_verify($mdp, $sel['MDP'])){
                    // on ajoute des information en session et on redirige vers la page d'accueil
                    $_SESSION["Connect"] = true;
                    $error = null;
                    header('Location: /');
                }else{
                    // on ajoute un message d'erreur en session et on redirige vers la page de connexion
                    $error = "Mauvais mot de passe";
                    
                }
            }else{
                // on ajoute un message d'erreur en session et on redirige vers la page de connexion
                $error = "Pseudo inconnu";
                
            }
        }else{
            // on ajoute un message d'erreur en session et on redirige vers la page de connexion
            $error = "Veuillez remplir tous les champs";
            
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/connexion.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <?php include('./navbar.php'); ?>
    <div class="position">
        <h2>Connexion</h2>
        <form action="" method="post">
            <input type="text" name="login" placeholder="Login">
            <input type="password" name="mdp" placeholder="Mot de passe">
            <input type="submit" value="Connexion" name="connexion">
        </form>
        <a href="./inscription.php">inscription</a>
    </div>

    <div>
        <?php
            if(isset($error)){
                echo $error;
            }
        ?>
    </div>
</body>
</html>