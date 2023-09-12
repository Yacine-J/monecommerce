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
        $photo_bdd = "public/img/$nom_photo";
        $photo_dossier = "../public/img/$nom_photo"; 
        copy($_FILES['photo']['tmp_name'],$photo_dossier);
    }
    foreach($_POST as $indice => $valeur) {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    executeRequete("INSERT INTO produit (reference, categorie, titre, 
    description, couleur, taille, public, photo, prix, stock) 
    values ('$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]', '$_POST[public]',  '$photo_bdd',  '$_POST[prix]',  '$_POST[stock]')");
    $contenu .= '<div class="validation">Le produit a été ajouté</div>';
}
// Liens produits
$contenu .= '<a href="?action=affichage">Affichage des produits</a>';
$contenu .= '<a href="?action=ajout">Ajout d\'un produits</a>';
?>
<!-- --------------------------------- AFFICHAGE HTML --------------------------------- -->
<?php 
if (isset($_GET['action']) && $_GET['action'] == "affichage") {
    $resultat = executeRequete("SELECT * FROM produit");
    $contenu .= '<h2>Affichage des produits</h2>';
    $contenu .= 'Nombre de produits disponibles : ' . $resultat->num_rows;
    $contenu .= '<table border="1"><tr>';
    while ($colonne = $resultat->fetch_field()) {
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= '<th>Modification</th>';
    $contenu .= '<th>Suppression</th>';
    $contenu .= '</tr>';
    while ($ligne = $resultat->fetch_assoc()) {
        $contenu .= '<tr>';
        foreach ($ligne as $indice => $information) {
            if ($indice == "photo") {
                $contenu .= '<td><img src="' . RACINE_SITE . $information . '" height="70"></td>';
            } else {
                $contenu .= '<td>' . $information . '</td>';
            }
        }
        $contenu .= '<td><a href="?action=modification&id_produit=' . $ligne['id_produit'] . '"><img src ="../inc/assets/icons/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=suppression&id_produit=' . $ligne['id_produit'] . '" OnClick="return(confirm(\'En êtes vous certain\'));"><img src ="../inc/assets/icons/delete.png"></a></td>';
        $contenu .= '</tr>';
    }
    $contenu .= '</table>';
}
?>
<?php require('../inc/haut.inc.php'); ?>
<?php echo $contenu; ?>
<?php
if (isset($_GET['action']) && $_GET['action'] == "ajout") {
    echo '
<h1> Formulaire Produits </h1>
<form method="post" action="" enctype="multipart/form-data">
    <label for="titre">Référence</label><br>
    <input type="text" id="reference" name="reference" placeholder="Référence du produit"><br><br>

    <label for="categorie">Catégorie</label><br>
    <input type="text" id="categorie" name="categorie" placeholder="Catégorie du produit"><br><br>

    <label for="titre">Titre</label><br>
    <input type="text" id="titre" name="titre" placeholder="Titre du produit"><br><br>

    <label for="description">Déscription</label><br>
    <textarea id="description" name="description" placeholder="Description du produit"></textarea><br><br>

    <label for="couleur">Couleur</label><br>
    <input type="text" id="couleur" name="couleur" placeholder="Couleur du produit"><br><br>

    <label for="taille">Taille</label><br>
    <select name="taille">
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
    </select><br><br>
 
    <label for="public">Public</label><br>
    <input type="radio" name="public" value="m" checked>Homme
    <input type="radio" name="public" value="f">Femme<br><br>

    <label for="photo">Photo</label><br>
    <input type="file" id="photo" name="photo"><br><br>
 
    <label for="prix">Prix</label><br>
    <input type="text" id="prix" name="prix" placeholder="Prix du produit"><br><br>
     
    <label for="stock">Stock</label><br>
    <input type="text" id="stock" name="stock" placeholder="Stock du produit"><br><br>

    <button>Enregistrer le produit</button>
</form>';
}
?>

<?php require('../inc/bas.inc.php'); ?>
