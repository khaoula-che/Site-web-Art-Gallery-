<?php
session_start();

if(isset($_POST['email']) && !empty($_POST['email'])){
 setcookie('email', $_POST['email'], time() + 24 * 3600);
}
 if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
     $msg = 'Adresse email non valide.';
     header('location: inscription-client.php?message=' . $msg);
     exit;
 }
 try{
  $bdd = new PDO('mysql:host=localhost;dbname=arts_gallery', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 }
 
 catch(Exception $e){
  die('Erreur PDO : ' . $e->getMessage());
 }

$q = 'SELECT id FROM artiste WHERE email = :email';
$req = $bdd->prepare($q);
$req->execute([
				'email' => $_POST['email']
]);
$results = $req->fetchAll();

if (count($results) > 0) {
    // L'e-mail existe déjà dans la base de données, afficher un message d'erreur
    $msg= 'Cet e-mail est déjà utilisé par un autre artiste.';
    header('location: inscription-artiste.php?message=' . $msg);
    exit;
}

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];

$q = 'INSERT INTO artiste (login, email, pwd, prenom, nom) VALUES (:login, :email, :pwd, :prenom, :nom)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([
    'login' => $_POST['login'],
    'email' => $_SESSION['email'],
    'pwd' =>  $_POST['pwd'],
    'prenom' => $_SESSION['prenom'],
    'nom' => $_SESSION['nom']
]);

if(strlen($_POST['pwd']) < 6 || strlen($_POST['pwd']) > 12){
 $msg = 'Le mot de passe doit faire entre 6 et 12 caractères.';
 header('location: inscription.php?message=' . $msg);
 exit;
}

$password = $_POST['pwd'];
$confirm_password = $_POST['pwd2'];

if(
   !isset($_POST['login']) 
   || !isset($_POST['email']) 
   || !isset($_POST['pwd']) 
   || !isset($_POST['pwd2'])
   || empty($_POST['login']) 
   || empty($_POST['email']) 
   || empty($_POST['pwd'])
   || empty($_POST['pwd2'])){
       $msg= 'Vous devez remplir tous les champs !';
       header('location: inscription-client.php ?message='.$msg );
       exit;
}else if ($password !== $confirm_password) {
       $msg= 'Le mot de passe n\'est pas identique !';
       header('location: inscription-client.php ?message2=' .$msg);
       
}else{
    $_SESSION['email'] = $_POST['email'];
    header('location: captcha.php');
}

?>
