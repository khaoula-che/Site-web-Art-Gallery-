<?php 
session_start();
if(
	!isset($_POST['nom'])
	|| !isset($_POST['description'])
	|| !isset($_POST['prix'])
	|| !isset($_FILES['image'])
	|| empty($_POST['nom'])
	|| empty($_POST['prix'])
	|| empty($_POST['description'])
	|| empty($_FILES['image'])
){	
	$msg = 'Vous devez remplir tous les champs.';
	header('location: add-oeuvres.php?type=success&message=' . $msg);
	exit;
}

include('includes/db.php');

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
	
	//vérifier que le fichier moins de 2Mo  (utiliser la size du fichier), si non : redirection
	$maxSize = 2 * 1024 * 1024; // 2Mo exprimée en octets
	if($_FILES['image']['size'] > $maxSize){
		$msg = 'Le fichier doit faire moins de 2 Mo.';
		header('location: add-oeuvres.php?type=success&message=' . $msg);
		exit;
	}
	
	if(!file_exists('uploads')){
		mkdir('uploads'); // chmod 0777 par défaut
	}

	$from = $_FILES['image']['tmp_name'];
	$timestamp = time(); // nombre de seconde ecoulées depuis le 01/01/1970
	// récupération de l'extention originale 

	$_FILES['image']['name']; // image.jpg / progfil.gif / doc.min.png
	$array = explode('.', $_FILES['image']['name']); // ['doc', 'min', 'png']
	$extention = end($array); // on recupère le dernier élement du tableau 
 
	$filename = 'image-' . $timestamp . '.' . $extention;
	$destination = 'uploads/' . $_FILES['image']['name'];
	$saveResult = move_uploaded_file($from, $destination);

	if(!$saveResult){
		$msg = 'Le fichier n\'a pas pu être enregistré.';
		header('location: add-oeuvres.php?type=success&message=' . $msg);
		exit;
	}

}
$q = 'SELECT id_article FROM ARTICLE WHERE image = :image ';
$req = $bdd->prepare($q);
$req->execute([
	'image' => isset($filename) ? $destination : '',
	]);

$results = $req->fetchAll(); 

if(!empty($results)){
	$msg = 'Cet article existe déjà.';
	header('location: add-oeuvres.php?type=success&message=' . $msg);
	exit;
}
$q = 'SELECT * FROM ARTISTE WHERE email = :email';
$req= $bdd->prepare($q);
$req->execute([
	'email' => $_SESSION['email']
]);
$result= $req->fetch();
$id_artiste = $result['id'];
    

$q = 'INSERT INTO ARTICLE (nom, prix, description ,image, type_oeuvre, id_artiste) VALUES (:nom, :prix, :description, :image,:type_oeuvre, :id_artiste)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([
    'nom' => $_POST['nom'],
    'prix' => $_POST['prix'],
    'description' => $_POST['description'],
    'image' =>  isset($filename) ? $destination : '',
	'type_oeuvre' => $_POST['type_oeuvre'],
    'id_artiste'=> $id_artiste
]);


if(!$reponse){
	$msg = 'Erreur lors de l\'ajout en base de données.';
	header('location: add-oeuvres.php?type=success&message=' . $msg);
	exit;
}

$msg = 'L\'oeuvre d\'art a été ajouté avec succès !';
header('location: add-oeuvres.php?type=success&message=' . $msg);
exit;

?>
