<?php require("./inc/init.inc.php"); ?>
<?php
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion") {
    session_destroy();
} 
if(internauteEstConnecte()) {
    header("location: profil.php");
}
if($_POST) {
    $resultat = executeRequete("SELECT * FROM utilisateur WHERE pseudo='$_POST[pseudo]'");
    if($resultat->num_rows != 0) {
        $membre = $resultat->fetch_assoc();
        if(password_verify($_POST['mot_de_passe'], $membre['mot_de_passe'])) {
            foreach($membre as $indice => $element) {
                if($indice != 'mot_de_passe') {
                    $_SESSION['membre'][$indice] = $element;
                }
            } header("location: profil.php"); // si tout est bon on redirige vers le profil
        } else {
            $contenu .= '<div class="erreur">Erreur de mot de passe</div>';
        }
    } else {
        $contenu .= '<div class="erreur">Erreur de pseudo</div>';
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<?php require("./inc/haut.inc.php"); ?>
<?php echo $contenu ?>

<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo"><br><br>
         
    <label for="mot_de_passe" id="mot_de_passe" >Mot de passe</label><br>
    <input type="password" name="mot_de_passe"><br><br>
 
    <button>Se connecter</button>
</form>

<?php require("./inc/bas.inc.php"); ?>