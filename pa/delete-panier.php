<?php
session_start();
require('includes/db.php');

if(isset($_GET['id_article'])){
    $id_user = $_SESSION['id'];
    $id_article = $_GET['id_article'];
    
    $q = "DELETE FROM PANIER_COMPORTE WHERE id_article = ? AND id_panier IN (SELECT id_panier FROM PANIER WHERE id_client = ?)";
    $req = $bdd->prepare($q);
    $req->execute([
        $id_article,
        $id_user
    ]);
    $msg = 'L\'article a été supprimé !';
    header("Location: panier.php?type=success&message=" . $msg);
    exit;
}
?>
