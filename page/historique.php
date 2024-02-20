<?php
    require_once '../script/bdd.php';
    if(!isset($_SESSION['Connect'])){
        header('Location: /page/connexion.php');
    }
    // On récupère les 20 derniers états des modules
    $reponse = $bdd->query('SELECT * FROM historique_etat ORDER BY ID DESC LIMIT 20');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/historique.css">
</head>
<body>
    <?php
        include './navbar.php';
        

        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Module</th>';
        echo '<th>Date</th>';
        echo '<th>Etat</th>';
        echo '</tr>';
        // On affiche les 20 derniers états des modules
        while ($donnees = $reponse->fetch()) {
            if($donnees['Etat'] == 1) {
                $donnees['Etat'] = 'Allumé';
            }else if($donnees['Etat'] == 2) {
                $donnees['Etat'] = 'En Panne';
            } else {
                $donnees['Etat'] = 'Eteint';
            }

            $module = $bdd->query('SELECT * FROM module WHERE ID = '.$donnees['Module']);
            $module = $module->fetchAll();
            $nom = $module[0]['Nom'];

            echo '<tr>';
            echo '<td>'.$donnees['ID'].'</td>';
            echo '<td>'.$nom.'</td>';
            echo '<td>'.$donnees['date'].'</td>';
            echo '<td>'.$donnees['Etat'].'</td>';
            echo '</tr>';
        }
    
        echo '</table>';
    ?>




</body>
</html>