<?php require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if($_POST) {
    // $contenu .=  "pseudo : " . $_POST['pseudo'] . "<br>mot_de_passe : " .  $_POST['mot_de_passe'] . "";
    $resultat = executeRequete("SELECT * FROM utilisateur WHERE pseudo='$_POST[pseudo]'");
    if($resultat->num_rows != 0) {
        // $contenu .=  '<div style="background:green">pseudo connu!</div>';
        $utilisateur = $resultat->fetch_assoc();
        if($utilisateur['mot_de_passe'] == $_POST['mot_de_passe']) {
            //$contenu .= '<div class="validation">mot_de_passe connu!</div>';
            foreach($utilisateur as $indice => $element) {
                if($indice != 'mot_de_passe') {
                    $_SESSION['utilisateur'][$indice] = $element;
                }
            } header("location:profil.php");
        } else {
            $contenu .= '<div class="erreur">Erreur de mot_de_passe</div>';
        }       
    } else {
        $contenu .= '<div class="erreur">Erreur de pseudo</div>';
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<?php require_once("inc/haut.inc.php"); ?>
 
<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo"><br> <br>
         
    <label for="mdp">Mot de passe</label><br>
    <input type="text" id="mot_de_passe" name="mot_de_passe"><br><br>
 
    <button>Se connecter</button>
</form>
 
<?php require_once("inc/bas.inc.php"); ?>