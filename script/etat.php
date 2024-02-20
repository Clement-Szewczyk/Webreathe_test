<?php
    // Connexion à la base de données
    require_once './bdd.php';
    if(!isset($_SESSION['Connect'])){
        header('Location: /page/connexion.php');
    }
    // Sélectionner un module aléatoire
    $query = 'SELECT id FROM module ORDER BY RAND() LIMIT 1';
    $statement = $bdd->query($query);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $moduleId = $row['id'];

    // Générer un état aléatoire (0 ou 1)
    $randomState = rand(0, 2);

    // Mettre à jour l'état du module dans la base de données
    $updateQuery = 'UPDATE module SET Etat = :etat WHERE id = :id';
    $updateStatement = $bdd->prepare($updateQuery);
    $updateStatement->execute(array(
        ':etat' => $randomState,
        ':id' => $moduleId
    ));
    
    //On ajoute l'etat, le nom du module et l'heure du changement d'etat dans la table historique
    $insertQuery = 'INSERT INTO historique_etat (Etat, date, Module) VALUES (:etat, :date, :module)';
    $insertStatement = $bdd->prepare($insertQuery);
    $insertStatement->execute(array(
        ':etat' => $randomState,
        ':date' => date('Y-m-d H:i:s'),
        ':module' => $moduleId
    ));


    
?>
