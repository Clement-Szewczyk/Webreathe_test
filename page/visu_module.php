<?php
require_once('../script/bdd.php');
if(!isset($_SESSION['Connect'])){
    header('Location: /page/connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap JS (optionnel si vous n'avez pas déjà inclus Bootstrap JS ailleurs dans votre projet) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Chart.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
        <!-- Script récupération etat -->
        <script src="../script/recup_etat_visu.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/visu.css">
</head>
<body>
    
   
    <?php
        include('./navbar.php');
        $id = $_GET['id'];
        $module = $bdd->query('SELECT * FROM module WHERE ID = '.$id);
        $module = $module->fetchAll();
    ?>
    <div class="titre">
     <h1><?=$module[0]['Nom']?></h1>
    </div>
    <div class="description">
        <h2>Description</h2>
        <p><?=$module[0]['description']?></p>
    </div>
    
    <div class="etat">
        <h2>Etat actuel</h2>
        <?php
            echo'<p id="etat_'.$module[0]['ID'].'" class="etat_text"><strong></strong></p>';
        ?>
    </div>

    <h2 class="graph">Evolution des données</h2>
    <?php
        // Récupération des données
        $name_value = $module[0]['valeur'];
        // Récupération des 10 dernières valeurs du module
        $reponse = $bdd->query('SELECT * FROM '.$module[0]['Nom'].' ORDER BY ID DESC limit 10');
        // Création des tableaux pour le graphique
        $date_label = array();
        $total_valeur = array();
        // Remplissage des tableaux
        while ($donnees = $reponse->fetch())
        {
            array_push($date_label, $donnees['date']);
            array_push($total_valeur, $donnees[$name_value]);
        }

        $reponse->closeCursor();
        
        ?>

        <div class="graphique">
            <div class="taille">
                <canvas id="myChart"></canvas>
            </div>
   
        </div>

        <!-- Bouton pour ajouter des éléments -->
        <div class="add">
            <a href="../script/add_element.php?id=<?=$id?>" class="ajout">Ajouter des éléments</a>
        </div>
        


        <!-- Script pour le graphique -->
        <script>
            // Récupération des données PHP
            var date_label = <?php echo json_encode($date_label); ?>;
            var total_valeur = <?php echo json_encode($total_valeur); ?>;

            // Création du graphique
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: date_label,
                    datasets: [{
                        label: ' <?=$module[0]['valeur']?>',
                        data: total_valeur,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
    </script>


</body>
</html>





