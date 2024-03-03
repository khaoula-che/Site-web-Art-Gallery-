<?php
session_start();
include('includes/db.php');

//si une image est postée ($_FILES['image']) :
if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){

	//vérifier que le fichier est de type jpg, png ou gif (utiliser le type du fichier), si non : redirection
	// tableau des types acceptés
	$acceptable = [
					'image/jpeg',
					'image/png',
					'image/gif',
				];

	if(!in_array($_FILES['image']['type'], $acceptable)){
		$msg = 'Le fichier doit être du type jpeg, gif ou png.';
		header('location: inscription.php?type=danger&message=' . $msg);
		exit;
	}
	
	//vérifier que le fichier moins de 2Mo  (utiliser la size du cfichier), si non : redirection
	$maxSize = 2 * 1024 * 1024; // 2Mo exprimée en octets
	if($_FILES['image']['size'] > $maxSize){
		$msg = 'Le fichier doit faire moins de 2 Mo.';
		header('location: inscription.php?type=danger&message=' . $msg);
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
		header('location: inscription.php?type=danger&message=' . $msg);
		exit;
	}

}
$q = 'SELECT id FROM IMAGE_PROFIL WHERE image = :image';
$req = $bdd->prepare($q);
$req->execute([
	'image' => $filename
]);
$result= $req->fetch();
$q = $bdd->prepare("SELECT * FROM CLIENT WHERE email = ?");
                $q->execute([$_SESSION['email']]);
                $result = $q->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    // Utilisateur trouvé dans la table clients
                    // Récupère les informations de l'utilisateur à partir de l'email stocké dans la session
                    $q = 'SELECT * FROM CLIENT WHERE email = :email';
					$req= $bdd->prepare($q);
					$req->execute([
						'email' => $_SESSION['email']
					]);
					$result= $req->fetch();

					$id_client= $result['id'];
					$email= $result['email'];
					$q = 'INSERT INTO IMAGE_PROFIL (image, id_client) VALUES (:image, :id_client)';
					$req = $bdd->prepare($q);
					$reponse = $req->execute([
						'image' => isset($filename) ? $filename : '',
						'id_client' => $id_client
					]);
					
                } else {
                    // Utilisateur non trouvé dans la table clients, vérifier la table artistes
                    $q = $bdd->prepare("SELECT * FROM ARTISTE WHERE email = ?");
                    $q->execute([$_SESSION['email']]);
                    $result = $q->fetchAll(PDO::FETCH_ASSOC);
                    if (count($result) > 0) {
                        // Utilisateur trouvé dans la table artistes
                        // Récupère les informations de l'utilisateur à partir de l'email stocké dans la session
                        $q = 'SELECT * FROM ARTISTE WHERE email = :email';
						$req= $bdd->prepare($q);
						$req->execute([
							'email' => $_SESSION['email']
						]);
						$result= $req->fetch();

						$id_artiste = $result['id'];
						$email= $result['email'];
						$q = 'INSERT INTO IMAGE_PROFIL (image, id_artiste) VALUES (:image, :id_artiste)';
                        $req = $bdd->prepare($q);
                        $reponse = $req->execute([
                            'image' => isset($filename) ? $filename : '',
                            'id_artiste' => $id_artiste
						]);
                    } else {
                        // Utilisateur non trouvé dans la table clients ni artistes, erreur
                        echo "Utilisateur non trouvé";
                        exit;
                    }
                }
$msg ='Votre profil a été mis à jour avec succès';
header('location: profile.php?type=success&message=' . $msg);
if(!$reponse){
	$msg = 'Erreur lors de l\'inscription en base de données.';
	header('location: modification-profile.php?type=danger&message=' . $msg);
	exit;
}
?>