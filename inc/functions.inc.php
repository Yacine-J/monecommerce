<!-- toutes nos fonctions -->
<!-- Execution requête -->
<?php
function executeRequete($req) {
    global $mysqli;
    try {
        $resultat = $mysqli->query($req);
        if (!$resultat) {
            die("Erreur sur la requête sql.<br>Message : " . $mysqli->error . "<br>Code : " . $req);
        }
        return $resultat;
    } catch (Exception $e) {
        return $e;
    }
}
// Affichage de notre debogage
function debug($var, $mode = 1) {
    echo '<div style="background: lightgrey; padding: 5px; float: right; clear: both; ">';
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    echo "Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].";
    if($mode === 1) {
        echo '<pre>'; print_r($var); echo '</pre>';
    } else {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}
// Savoir si un internaute est connecté
function internauteEstConnecte() { 
    if(!isset($_SESSION['membre'])) return false;
    else return true;
}
// Savoir si un internaute est connecté et est admin
function internauteEstConnecteEtEstAdmin() {
    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) return true;
    else return false;
}