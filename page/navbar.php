<div class="navbar">
    <a href="/index.php"><h2>Home</h2></a>
    <a href="/page/ajout_module.php"><h2>Ajout module</h2></a>
    <a href="/page/historique.php"><h2>Historique Etat</h2></a>
    <a href=""></a>
    <?php
        // Si l'utilisateur est connecté on affiche le bouton de deconnexion
        if(isset($_SESSION['Connect'])) {
            echo '<a href="/script/logout.php"><h2>Deconnexion</h2></a>';
        } else {
            echo '<a href="/page/connexion.php"><h2>Connexion</h2></a>';
        }
    ?>
</div>