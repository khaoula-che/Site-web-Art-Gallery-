<?php
session_start();
if( 
    !isset($_POST['nom_client']) 
    || !isset($_POST['prenom_client']) 
    || empty($_POST['nom_client']) 
    || empty($_POST['prenom_client'])){
    $msg = 'Vous devez remplir tous les champs !';
    header('location: inscription.php?message=' . $msg);
    exit;
}else{
    $_SESSION['nom'] = $_POST['nom_client'];
    $_SESSION['prenom'] = $_POST['prenom_client'];
    header('location: inscription-client.php' );
    exit;
}
?>