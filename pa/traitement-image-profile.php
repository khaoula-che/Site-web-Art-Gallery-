<?php 
session_start();
require('includes/db.php');

if(isset($_SESSION['email']) && isset($_POST['submit'])){

	$email = $_SESSION['email'];

	// Vérifie si un fichier a été téléchargé
	if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

		// Vérifie si le fichier est une image
		if($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/png'){

			// Déplace le fichier téléchargé vers le répertoire "uploads"
			$image = uniqid() . '_' . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);

			// Met à jour l'image de profil de l'utilisateur
			$q = 'UPDATE users SET image = :image WHERE email = :email';
			$req = $bdd->prepare($q);
			$req->execute([
				'image' => $image,
				'email' => $email
			]);

			// Affiche un message de confirmation
			$_SESSION['success'] = 'L\'image de profil a été mise à jour avec succès.';
			header('Location: profil.php');
			exit;
		}
	} 
?>