<?php

// On inclut le fichier de connexion à la base de données
require_once('bdd.php');
if(!isset($_SESSION['Connect'])){
    header('Location: /page/connexion.php');
}
echo '<link rel="stylesheet" href="../css/main.css">';
// Vérification si l'ID est passé en paramètre
if(isset($_GET['id'])) {
    $ID = $_GET['id'];

    // Sélection du module correspondant à l'ID
    $module_query = $bdd->prepare('SELECT * FROM module WHERE ID = :id');
    $module_query->execute(array(':id' => $ID));
    $module = $module_query->fetch();

    if($module) {
        if($module['Etat'] != 1) {
            echo '<p class="erreur">Le module est désactivé ou en panne.</p>';
            header("refresh:2;url=../page/visu_module.php?id=".$ID."");
            exit();
        }
        $module_name = $module['Nom'];
        $module_valeur = $module['valeur'];

        $repetition_aleatoire = rand(1, 10);

        // Préparation de la requête d'insertion
        $insert_query = $bdd->prepare('INSERT INTO '.$module_name.' (date,'.$module_valeur.') VALUES (:date, :valeur)');
        
        // Boucle pour effectuer les insertions aléatoires
        for ($i = 0; $i < $repetition_aleatoire; $i++) {
            // Exécution de la requête d'insertion avec des valeurs aléatoires
            $insert_query->execute(array(':date' => date('Y-m-d H:i:s'), ':valeur' => rand(1, 50)));
        }

        echo '<p class="succes">Les données ont été insérées avec succès.</p>';
    } else {
        echo '<p class="erreur">Le module avec l\'ID spécifié n\'a pas été trouvé.</p>';
    }
} else {
    echo '<p class="erreur">Aucun ID spécifié.</p>';
}


//temps d'attente avant de rediriger
header("refresh:2;url=../page/visu_module.php?id=".$ID."");
?>

