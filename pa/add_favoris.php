<?php
session_start();
require_once('includes/db.php');
$id_article = $_GET['id'];
$id_user = $_SESSION['id'];

$q = 'SELECT id FROM FAVORIS WHERE id_article = :id_article AND id_user = :id_user ';
$req = $bdd->prepare($q);
$req->execute([
	'id_article' => $_GET['id'],
	'id_user' => $id_user
]);

$results = $req->fetchAll(); 

if(!empty($results)){
	$msg = 'Cet article existe déjà.';
	header('location: galerie.php?message=' . $msg);
	exit;
}
else {


$q = 'INSERT INTO FAVORIS (id_article, id_user) VALUES (:id_article, :id_user)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([
    'id_article' => $_GET['id'],
    'id_user' => $_SESSION['id'],
]);
}

header('Location: galerie.php?message=Article ajouté aux favoris.');
exit;
?>