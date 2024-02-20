<?php
    // On récupère la connexion à la base de données
    require_once '../script/bdd.php';
    // Si l'utilisateur n'est pas connecté on le redirige vers la page de connexion
    if(!isset($_SESSION['Connect'])){
        header('Location: /page/connexion.php');
    }
    // On vérifie si le formulaire a été soumis
    if(isset($_POST['button'])){
        $erreur = "";
        // On vérifie si les champs sont remplis
        if(!empty($_POST['name_module']) && !empty($_POST['text_describe']) && !empty($_POST['name_value'])){
            // On récupère les valeurs des champs
            $name_module = $_POST['name_module'];
            $text_describe = $_POST['text_describe'];
            $name_value = $_POST['name_value'];
            // On insère les valeurs dans la base de données
            $req = $bdd->prepare('INSERT INTO module (Nom, description, etat, valeur) VALUES(:name_module, :text_describe, :etat, :valeur)');
            $req->execute(array(
                'name_module' => $name_module,
                'text_describe' => $text_describe,
                'etat' => '1',
                'valeur' => $name_value
            ));

            //Création d'une table pour stocker les valeurs du module
            $creation = $bdd->prepare("CREATE TABLE `$name_module` (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `$name_value` INT(8) NOT NULL, date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)");
            $creation->execute();


            // On vide les champs
            unset($_POST['name_module']);
            unset($_POST['text_describe']);
            unset($_POST['name_value']);

            // On redirige l'utilisateur vers la page d'accueil
            header('Location: /');
        }
        else{
            // Si les champs ne sont pas remplis on affiche un message d'erreur
            $erreur =  "Veuillez remplir tous les champs";
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout</title>

    <!--CSS-->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/ajout_module.css">
</head>
<body>
<?php
    include './navbar.php';
?>
<div class="titre">
    <h2>Ajout d'un Module</h2>
</div>
<!--Formulaire d'ajout de module-->
<div class="formulaire">
    <form action="" method="POST">
        <div class="contenu">
            <label for="name_module" class="">Nom Module</label>
            <input type="text" class="" id="name_module" name="name_module" required>
        </div>
        <div class="contenu">
            <label for="text_describe">Description</label>
            <textarea name="text_describe" id="text_describe" required></textarea>
        </div>
        <div class="contenu">
            <label for="name_value">Nom de la valeur</label>
            <input type="text" name="name_value" required>
        </div>
        <input type="submit" name="button">
        </form>
</div>

<!--Message d'erreur-->
<div class="erreur_message">
    <?php
        if(isset($erreur)){
            echo $erreur;
        }
    ?>
</div>

</body>
</html>