<?php
include('includes/db.php');

if(isset($_GET['id'])){
    $id_client = $_GET['id']; 

    $q = 'DELETE FROM INSCRIRE WHERE id_participant = :id_client';
    $req = $bdd->prepare($q);
    $req->execute(['id_client' => $id_client]);

    $q = 'DELETE FROM PANIER_COMPORTE WHERE id_panier IN (SELECT id_panier FROM PANIER WHERE id_client = :id_client)';
    $req = $bdd->prepare($q);
    $req->execute(['id_client' => $id_client]);

    $q = 'DELETE FROM PANIER WHERE id_client = :id_client';
    $req = $bdd->prepare($q);
    $req->execute(['id_client' => $id_client]);

    $q = 'DELETE FROM FAVORIS WHERE id_user = :id_client';
    $req = $bdd->prepare($q);
    $req->execute(['id_client' => $id_client]);

    $q = 'DELETE FROM CLIENT WHERE id=:id';
    $req = $bdd->prepare($q);
    $req->execute(['id' => $id_client]);

    $msg = 'L\'utilisateur a été supprimé avec succès !';
    header("Location: users.php?type=success&message=" . $msg);
    exit();
}
?>
