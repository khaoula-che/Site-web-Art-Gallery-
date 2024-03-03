<?php 
session_start();
if(
	!isset($_POST['contenu'])
	|| !isset($_POST['id_artiste'])
    || !isset($_POST['titre'])
    || !isset($_FILES['image'])
	|| empty($_POST['contenu'])
	|| empty($_POST['id_artiste'])
    || empty($_POST['titre'])
	|| empty($_FILES['image'])
){	
	$msg = 'Vous devez remplir tous les champs.';
	header('location: add-blog.php?message=' . $msg);
	exit;
}

include('includes/db.php');

$q = 'SELECT id_blog FROM BLOG WHERE contenu = :contenu ';
$req = $bdd->prepare($q);
$req->execute([
	'contenu' => $_POST['contenu']
	]);

$results = $req->fetchAll(); 

if(!empty($results)){
	$msg = 'Ce blog existe déjà.';
	header('location: add-blog.php?message=' . $msg);
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
		header('location: add-oeuvres.php?message=' . $msg);
		exit;
	}
	
	//vérifier que le fichier moins de 2Mo  (utiliser la size du fichier), si non : redirection
	$maxSize = 2 * 1024 * 1024; // 2Mo exprimée en octets
	if($_FILES['image']['size'] > $maxSize){
		$msg = 'Le fichier doit faire moins de 2 Mo.';
		header('location: add-oeuvres.php?message=' . $msg);
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
		header('location: add-blog.php.php?message=' . $msg);
		exit;
	}

}

$q = 'SELECT * FROM ARTISTE WHERE email = :email';
$req= $bdd->prepare($q);
$req->execute([
	'email' => $_SESSION['email']
]);
$result= $req->fetch();
$id_artiste = $result['id'];
    

$q = 'INSERT INTO BLOG (titre,contenu,image,id_artiste) VALUES (:titre,:contenu,:image,:id_artiste)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([
    'titre' => $_POST['titre'],
    'contenu' => $_POST['contenu'],
    'image' =>  isset($filename) ? $destination : '',
	'id_artiste'=> $id_artiste
]);


if(!$reponse){
	$msg = 'Erreur lors de l\'ajout en base de données.';
	header('location: add-blog.php?message=' . $msg);
	exit;
}

// Si on arrive ici, c'est que l'utilisateur a été créé en bdd
$msg = 'Le blog a été ajouté avec succès !';
header('location: add-blog.php?message=' . $msg);
exit;

?>
