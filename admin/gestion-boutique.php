<?php require('../inc/init.inc.php'); ?>
<?php
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin()) {
    header("location:../connexion.php");
    exit();
}
//--- ENREGISTREMENT PRODUIT ---//
if(!empty($_POST)) {
    $photo_bdd = ""; 
    if(!empty($_FILES['photo']['name'])) {
        $nom_photo = $_POST['reference'] . '_' .$_FILES['photo']['name'];
        $photo_bdd = RACINE_SITE . "photo/$nom_photo";
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "/photo/$nom_photo"; 
        copy($_FILES['photo']['tmp_name'],$photo_dossier);
    }
    foreach($_POST as $indice => $valeur) {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    executeRequete("INSERT INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) values ('', '$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]', '$_POST[public]',  '$photo_bdd',  '$_POST[prix]',  '$_POST[stock]')");
    $contenu .= '<div class="validation">Le produit a été ajouté</div>';
}
?>
<!-- --------------------------------- AFFICHAGE HTML --------------------------------- -->
<?php require('../inc/haut.inc.php'); ?>
<h1>Formulaire Produits</h1>
<form method="post" action="" enctype="multipart/form-data">
    <label for="reference">Référence</label>
    <input type="text" id="reference" name="reference" placeholder="La référence du produit">
    <button>Enregistrer le produit</button>
</form>


<?php require('../inc/bas.inc.php'); ?>