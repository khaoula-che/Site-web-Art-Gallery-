<?php
session_start();
require('includes/db.php');

if (isset($_SESSION['id_article'])) {
    $id_article = $_SESSION['id_article'];
    $quantite = $_POST['quantite'];
    $id_client = $_SESSION['id'];
    
    $q = "INSERT INTO PANIER (id_client) VALUES (?)";
    $stmt = $bdd->prepare($q);
    $stmt->execute([
        $id_client
    ]);

    $id_panier = $bdd->lastInsertId();
}
if(isset($_SESSION['id_article']) && isset($_POST['quantite'])) {
    $id_article = $_SESSION['id_article'];
    $quantite = $_POST['quantite'];
    
    if(isset($_SESSION['id'])) {
        $id_user = $_SESSION['id'];

        $q = "SELECT * FROM PANIER_COMPORTE WHERE id_panier = ? AND id_article = ?";
        $stmt = $bdd->prepare($q);
        $stmt->execute([$id_panier, $id_article]);
        $panier_article = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($panier_article){
            $q = "UPDATE PANIER_COMPORTE SET quantite = quantite + ? WHERE id_panier = ? AND id_article = ?";
            $stmt = $bdd->prepare($q);
            $stmt->execute([$quantite, $id_panier, $id_article]);
        } else {
            $q = "INSERT INTO PANIER_COMPORTE (id_panier, id_article, quantite) VALUES (?, ?, ?)";
            $stmt = $bdd->prepare($q);
            $stmt->execute([$id_panier, $id_article, $quantite]);
            header('Location: panier.php');
            exit();
        }
        
        
    } else {
        header("Location: connexion.php");
        exit;
}
} 

?>