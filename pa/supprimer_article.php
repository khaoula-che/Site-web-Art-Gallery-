<?php
session_start();
require('includes/db.php');
if(isset($_GET['id_article'])){
    $id_article = $_GET['id_article'];

    $q = 'DELETE FROM FAVORIS WHERE id_article = :id_article';
    $stmt = $bdd->prepare($q);
    $stmt->execute(['id_article' => $id_article]);

    $q = 'DELETE FROM PANIER_COMPORTE WHERE id_article = :id_article';
    $stmt = $bdd->prepare($q);
    $stmt->execute(['id_article' => $id_article]);

    $q = 'DELETE FROM ARTICLE WHERE id_article = :id_article';
    $stmt = $bdd->prepare($q);
    $stmt->execute(['id_article' => $id_article]);

    $msg = 'L\'article a été supprimé avec succès ! ';
    header("Location: profile.php?type=success&message2=" . $msg);
    exit();
}
?>