<?php 
session_start();
if(
	!isset($_POST['titre'])
    ||!isset($_POST['adresse'])
	|| !isset($_POST['description'])
	|| !isset($_POST['heure_debut'])
	|| !isset($_POST['heure_fin'])
    || !isset($_POST['date_evenement'])
	|| !isset($_FILES['image'])
	|| empty($_POST['titre'])
    || empty($_POST['adresse'])
    || empty($_POST['description'])
    || empty($_POST['heure_fin'])
	|| empty($_POST['date_evenement'])
	|| empty($_POST['heure_debut'])
	|| empty($_FILES['image'])
){	
	$msg = 'Vous devez remplir tous les champs.';
	header('location: add-evenement.php?type=success&message=' . $msg);
	exit;
}

include('includes/db.php');

$q = 'SELECT id_evenement FROM EVENEMENT WHERE titre = :titre ';
$req = $bdd->prepare($q);
$req->execute([
	'titre' => $_POST['titre']
]);

$results = $req->fetchAll(); 

if(!empty($results)){
	$msg = 'l\'évènement existe déjà.';
	header('location: add-evenement.php?type=success&message=' . $msg);
	exit;
}

if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){
	$acceptable = [
		'image/jpeg',
		'image/png',
		'image/gif',
	];

	if(!in_array($_FILES['image']['type'], $acceptable)){
		$msg = 'Le fichier doit être du type jpeg, gif ou png.';
		header('location: add-oeuvres.php?type=success&message=' . $msg);
		exit;
	}

	$maxSize = 2 * 1024 * 1024; 
	if($_FILES['image']['size'] > $maxSize){
		$msg = 'Le fichier doit faire moins de 2 Mo.';
		header('location: add-oeuvres.php?type=success&message=' . $msg);
		exit;
	}
	
	if(!file_exists('uploads')){
		mkdir('uploads'); 
	}

	$from = $_FILES['image']['tmp_name'];
	$timestamp = time(); 
	$_FILES['image']['name']; 
	$array = explode('.', $_FILES['image']['name']); 

	$extention = end($array); 
    
	$filename = 'image-' . $timestamp . '.' . $extention;
	$destination = 'uploads/' . $_FILES['image']['name'];
	$saveResult = move_uploaded_file($from, $destination);

	if(!$saveResult){
		$msg = 'Le fichier n\'a pas pu être enregistré.';
		header('location: add-oeuvres.php?type=success&message=' . $msg);
		exit;
	}

}
 
$id_artiste = $_SESSION['id'];

$q = 'INSERT INTO EVENEMENT (titre, description ,image, date_evenement, heure_debut, heure_fin, id_artiste, adresse) VALUES (:titre, :description ,:image, :date_evenement, :heure_debut, :heure_fin, :id_artiste, :adresse)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([
    'titre' => $_POST['titre'],
    'description' => $_POST['description'],
    'image' =>  isset($filename) ? $destination : '',
	'date_evenement' => $_POST['date_evenement'],
    'heure_debut' => $_POST['heure_debut'],
    'heure_fin' => $_POST['heure_fin'],
    'id_artiste'=> $id_artiste,
    'adresse' => $_POST['adresse'],
]);


if(!$reponse){
	$msg = 'Erreur lors de l\'ajout en base de données.';
	header('location: add-oeuvres.php?type=success&message=' . $msg);
	exit;
}

$msg = 'L\'évènement a été ajouté avec succès !';
header('location: add-oeuvres.php?type=success&message=' . $msg);
exit;

?>
