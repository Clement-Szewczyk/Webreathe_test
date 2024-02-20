<?php
    require_once './script/bdd.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/index.css">

    <!-- JavaScript (jQuery used for simplicity) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
        if(isset($_SESSION['Connect'])) {
            echo '<script src="./script/recup_etat.js"></script>';
        }
    ?>

</head>
<body>

    
    <?php
        include './page/navbar.php';
    ?>

    <?php
        if(isset($_SESSION['Connect'])) {
            $reponse = $bdd->query('SELECT * FROM module');
            while ($donnees = $reponse->fetch()) {
                echo '
                    <div class="position">
                        <a href="/page/visu_module.php?id='.$donnees['ID'].'">
                            <div class="module">
                                <div class="info">
                                    <h2 class="titre_module">'.$donnees['Nom'].'</h2>
                                    <p class="description">'.$donnees['description'].'</p>
                                </div>
                                <div class="info2">
                                    <h3 class="etat_nom">Etat:</h3>
                                    <p id="etat_'.$donnees['ID'].'" class="etat_text"><strong></strong></p>
                                </div>
                            </div>
                        </a>
                    </div>
                ';
            }
            $reponse->closeCursor();
        }
        else{
            echo '<div class="position">
                    <h1>Veuillez-vous connecter !!!</h1>
                </div>';
        }
        
    ?>

</body>
</html>