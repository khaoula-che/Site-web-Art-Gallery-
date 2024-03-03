<?php
session_start();
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
	header('location: connexion-administrateur.php?message=' . $msg);
	exit;
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	$msg = 'Adresse email non valide.';
	header('location: connexion-administrateur.php?message=' . $msg);
	exit;
}

if( isset($_POST['email']) && isset($_POST['pwd']) && $_POST['email']  == 'khaoulachetioui4@gmail.com' && $_POST['pwd'] == 'groupe3'){
    header('location: users.php');
exit;
}else {
    echo '<p>Identifiants inconnus.</p>';
    echo '<a href="site_formulaire.php">Retour au formulaire</a>';
}


?>