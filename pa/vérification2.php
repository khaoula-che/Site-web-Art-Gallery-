<?php
session_start();
if( 
    !isset($_POST['nom_artiste']) 
    || !isset($_POST['prenom_artiste']) 
    || empty($_POST['nom_artiste']) 
    || empty($_POST['prenom_artiste'])){
    $msg = 'Vous devez remplir tous les champs !';
    header('location: inscription.php?message=' . $msg);
    exit;
}else{
    $_SESSION['nom_artiste'] = $_POST['nom_artiste'];
    $_SESSION['prenom_artiste'] = $_POST['prenom_artiste'];
    header('location: inscription-artiste.php' );
    exit;
}
?>