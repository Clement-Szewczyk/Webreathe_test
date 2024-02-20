<?php 
    require_once('../script/bdd.php');
    $erreur = "";
    // On vérifie si le formulaire a été soumis
    if(isset($_POST['inscription'])) {
        // On vérifie si les champs sont remplis
        if(!empty($_POST['login']) && !empty($_POST['password'])) {

            $login = $_POST['login'];
            // On hash le mot de passe
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // On regarde si le login existe déjà
            $selRq = $bdd->prepare('SELECT * FROM user WHERE Login = :login');
            $selRq->execute(["login" => $login]);
            $sel = $selRq->fetch();

            // Si le login n'existe pas on l'insère dans la base de données
            if(!$sel) {
                $query = $bdd->prepare('INSERT INTO user (Login, MDP) VALUES (:login, :password)');
                $query->execute(array(':login' => $login, ':password' => $password));
                header('Location: /page/connexion.php');
            }else{
                $erreur = "Ce login existe déjà";
            }

            
            
        } else {
            $erreur = "Veuillez remplir tous les champs";
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
        <h2>Inscription</h2>
        <form action="" method="post">
            <input type="text" name="login" placeholder="Login">
            <input type="password" name="password" placeholder="Mot de passe">
            <input type="submit" value="Inscription" name="inscription">
        </form>
        <a href="./connexion.php">Se connecter</a>
    </div>
    
    <div class="position">
        <?php
            if(isset($erreur)){
                echo $erreur;
            }
        ?>
    </div>
</body>
</html>