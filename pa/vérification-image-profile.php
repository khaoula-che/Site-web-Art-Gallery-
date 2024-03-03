<?php
session_start();
try{
	$bdd = new PDO('mysql:host=localhost;dbname=arts_gallery', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
   }
   
catch(Exception $e){
	die('Erreur PDO : ' . $e->getMessage());
}


if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){
	$acceptable = [
					'image/jpeg',
					'image/png',
					'image/gif',
				];

	if(!in_array($_FILES['image']['type'], $acceptable)){
		$msg = 'Le fichier doit être du type jpeg, gif ou png.';
		header('location: profile.php?type=danger&message=' . $msg);
		exit;
	}
	
	//vérifier que le fichier moins de 2Mo  (utiliser la size du fichier), si non : redirection
	$maxSize = 2 * 1024 * 1024; // 2Mo exprimée en octets
	if($_FILES['image']['size'] > $maxSize){
		$msg = 'Le fichier doit faire moins de 2 Mo.';
		header('location: profile.php?type=danger&message=' . $msg);
		exit;
	}
	
	//créer un dossier dossier "uploads" s'il n'existe pas (fonctions file_exists et mkdir)
	if(!file_exists('uploads')){
		mkdir('uploads'); // chmod 0777 par défaut
	}

	//y enregistrer le fichier (le déplacer de son emplacement temp vers le dossier uploads)
	$from = $_FILES['image']['tmp_name'];

	//remenage de fichier : risque de doublon si 2 fichiers avec la meme exit. sont envoyés de la meme seconde
	$timestamp = time(); // Nb de secondes écoulées depuis le 01/01/1978
	// récupération de l'extension originale
	$_FILES['image']['name']; //image.jpg / profile.gif / doc.min.png 
	$array = explode('.', $_FILES['image']['name']); // ['doc', 'min', 'png']
	$extension = end($array); // on récupère le dernier élément de tableaux 

	$filename = 'image-' . $timestamp . '.' . $extension;
	$destination = 'uploads/' . $filename;
	
	$saveResult = move_uploaded_file($from, $destination);

	if(!$saveResult){
		$msg = 'Le fichier n\'a pas pu être enregistré.';
		header('location: profile.php?type=danger&message=' . $msg);
		exit;
	}

}

$q ="UPDATE client SET image = :image WHERE id = :id";
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'image' => $image,
    'id' => $id
]);

if(!$reponse){
	$msg = 'Erreur lors de l\'inscription en base de données.';
	header('location: profile.php?type=danger&message=' . $msg);
	exit;
}

// Si on arrive ici, c'est que l'utilisateur a été créé en bdd
$msg = 'Compte créé avec succès !!';
header('location: profile.php?type=sucesse&message=' . $msg);
exit;

?>