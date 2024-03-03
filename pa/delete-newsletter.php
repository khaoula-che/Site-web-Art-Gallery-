<?php
include('includes/db.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $q = 'DELETE FROM NEWSLETTER WHERE id=:id';
    $stmt = $bdd->prepare($q);
    $stmt->execute(['id' => $id]);

    $msg = 'L\'utilisateur a été supprimé avec succès ! ';
    header("Location: users.php?type=success&message=" . $msg);
    exit();
}
?>