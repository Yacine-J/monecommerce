<!Doctype html>
<html>
    <head>
        <title>Mon E-commerce</title>
        <link rel="stylesheet" href="<?php echo RACINE_SITE ?>public/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="<?php echo RACINE_SITE ?>inc/js/main.js"></script>
    </head>

    <body>
        <header>
            <div class="conteneur">
                <nav class="topnav" id="myTopnav">
                    <?php
                if (internauteEstConnecteEtEstAdmin()) {
                    echo '<a href="' . RACINE_SITE . 'admin/gestion-membre.php">Gestion des membres</a>';
                    echo '<a href="' . RACINE_SITE . 'admin/gestion-commande.php">Gestion des commandes</a>';
                    echo '<a href="' . RACINE_SITE . 'admin/gestion-boutique.php">Gestion de la boutique</a>';
                } if (internauteEstConnecte()) {
                    echo '<a href="' . RACINE_SITE . 'profil.php">Voir votre profil</a>';
                    echo '<a href="' . RACINE_SITE . 'boutique.php">Accès à la boutique</a>';
                    echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                    echo '<a href="' . RACINE_SITE . 'connexion.php?action=deconnexion">Se déconnecter</a>';
                } else {
                    echo '<a href="' . RACINE_SITE . 'inscription.php">Inscription</a>';
                    echo '<a href="' . RACINE_SITE . 'connexion.php">Connexion</a>';
                    echo '<a href="' . RACINE_SITE . 'boutique.php">Accès à la boutique</a>';
                    echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                }
                    ?>
                    <a href="javascript:void(0);" class="icon" onclick="toggleNav()">
                        <i class="fa fa-bars"></i>
                    </a>
                </nav>
            </div>
        </header>
        <section>
            <div class="conteneur">
