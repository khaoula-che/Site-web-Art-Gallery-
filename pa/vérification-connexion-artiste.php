<?php
if(isset($_POST['email']) && !empty($_POST['email'])){
	setcookie('email', $_POST['email'], time() + 24 * 3600);
}

if(
	!isset($_POST['email'])
	|| !isset($_POST['pwd'])
	|| empty($_POST['email'])
	|| empty($_POST['pwd'])
){	
	$msg = 'Vous devez remplir les 2 champs.';
	header('location: connexion.php?message=' . $msg);
	exit;
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	$msg = 'Adresse email non valide.';
	header('location: connexion.php?message=' . $msg);
	exit;
}

include('includes/db.php');

$q = 'SELECT id FROM ARTISTE WHERE email = :email AND pwd = :pwd';
$req = $bdd->prepare($q);
$req->execute([
				'email' => $_POST['email'],
				'pwd' => $_POST['pwd']
]);

$result = $req->fetch(); 

if(!$result){
	$msg = 'Identifiants incorrects.';
	header('location: connexion.php?message=' . $msg);
	exit;
}

session_start();

$_SESSION['email'] = $_POST['email'];

header('location: profile.php');
exit;

?>