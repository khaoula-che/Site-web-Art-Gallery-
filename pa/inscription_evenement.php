<?php
session_start();
include('includes/db.php');
$id_evenement = $_GET['id_evenement'];
$id_participant = $_SESSION['id'];

$q = 'SELECT id_inscription FROM INSCRIRE WHERE id_participant = :id_participant AND id_evenement = :id_evenement';
$req = $bdd->prepare($q);
$req->execute([
	'id_participant' => $_SESSION['id'],
    'id_evenement' => $id_evenement
]);
 
$results = $req->fetchAll();

if (count($results) > 0) {
    $msg= 'Vous êtes déja inscrit !';
    header('location: event.php?id_evenement='. $id_evenement . '&type=danger&message=' . urlencode($msg));
    exit;
}
$q = 'INSERT INTO INSCRIRE (id_evenement, id_participant) VALUES (:id_evenement, :id_participant)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([
    'id_evenement' => $_GET['id_evenement'],
    'id_participant' => $_SESSION['id'],
]);
$msg = 'Félicitations, votre action a été accomplie avec succès !';
header('Location: event.php?id_evenement=' . $id_evenement . '&type=success&message=' . urlencode($msg));
exit;
