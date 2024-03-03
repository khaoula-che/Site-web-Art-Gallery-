<?php
session_start();

if(isset($_POST['email']) && !empty($_POST['email'])){
 setcookie('email', $_POST['email'], time() + 24 * 3600);
}
 if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
     $msg = 'Adresse email non valide.';
     header('location: inscription-artiste.php?message=' . $msg);
     exit;
 }
 $password = $_POST['pwd'];
 $confirm_password = $_POST['pwd2'];
 
if(
    !isset($_POST['pseudo']) 
    || !isset($_POST['email']) 
    || !isset($_POST['pwd']) 
    || !isset($_POST['pwd2'])
    || empty($_POST['pseudo']) 
    || empty($_POST['email']) 
    || empty($_POST['pwd'])
    || empty($_POST['pwd2'])){
        $msg= 'Vous devez remplir tous les champs !';
        header('location: inscription-artiste.php?message='.$msg );
        exit;
}else if ($password !== $confirm_password) {
        $msg= 'Le mot de passe n\'est pas identique !';
        header('location: inscription-artiste.php?message2=' .$msg);
        exit;
}

if(strlen($_POST['pwd']) < 6 || strlen($_POST['pwd']) > 12){
    $msg = 'Le mot de passe doit faire entre 6 et 12 caractères.';
    header('location: inscription-artiste.php?message=' . $msg);
    exit;

}
include('includes/db.php');

$q = 'SELECT id FROM ARTISTE WHERE email = :email';
$req = $bdd->prepare($q);
$req->execute([
	'email' => $_POST['email']
]);
 
$results = $req->fetchAll();

if (count($results) > 0) {
    $msg= 'Cet e-mail est déjà utilisé par un autre utilisateur.';
    header('location: inscription-artiste.php?message=' . $msg);
    exit;
}
$q = 'SELECT id FROM CLIENT WHERE email = :email';
$req = $bdd->prepare($q);
$req->execute([
	'email' => $_POST['email']
]);
 
$results = $req->fetchAll();

if (count($results) > 0) {
    $msg= 'Cet e-mail est déjà utilisé par un autre utilisateur.';
    header('location: inscription-client.php?message=' . $msg);
    exit;
}

$nom = $_SESSION['nom_artiste'];
$prenom = $_SESSION['prenom_artiste'];
$token = bin2hex(random_bytes(32));
$token = '1234567890abcdef';
$q = 'INSERT INTO ARTISTE (pseudo, email, pwd, prenom, nom, token) VALUES (:pseudo, :email, :pwd, :prenom, :nom, :token)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([
    'pseudo' => $_POST['pseudo'],
    'email' => $_POST['email'],
    'pwd' =>  $_POST['pwd'],
    'prenom' => $_SESSION['prenom_artiste'],
    'nom' => $_SESSION['nom_artiste'],
    'token' => $token
]);

$_SESSION['email']= $_POST['email'];
$_SESSION['pseudo']= $_POST['pseudo'];
$_SESSION['token']= $token;
header('location: captcha.php');
exit;
?>