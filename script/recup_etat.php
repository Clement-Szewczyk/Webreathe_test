<?php
    // Connexion à la base de données
    require_once './bdd.php';

    // Requête pour récupérer les états des modules avec leur ID
    $query = 'SELECT id, Nom, Etat FROM module';
    $statement = $bdd->query($query);

    // Tableau pour stocker les états des modules
    $moduleStates = array();

    // Parcours des résultats de la requête
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        // Ajout de l'état du module avec son identifiant unique au tableau
        $moduleState = '';
        switch ($row['Etat']) {
            case 0:
                $moduleState = 'Inactif';
                $_SESSION['panne'] = false;
                break;
            case 1:
                $moduleState = 'Actif';
                break;
            case 2:
                $moduleState = 'Panne';
                $_SESSION['panne'] = true;
                $_SESSION['nom_module'] = $row['Nom'];
                break;
            default:
                $moduleState = 'Inconnu';
                $_SESSION['panne'] = false;
                break;
        }
        $moduleStates[$row['id']] = array(
            'Nom' => $row['Nom'],
            'Etat' => $moduleState
        );
    }
    // Fermeture du curseur
    $statement->closeCursor();

    // Envoi des données JSON
    header('Content-Type: application/json');
    echo json_encode($moduleStates);
?>

