<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// Vérifie si l'adresse e-mail est valide


// Si l'adresse e-mail est valide, continuez à réinitialiser le mot de passe
// Génère un jeton de réinitialisation de mot de passe unique
$token = bin2hex(random_bytes(32)); // Génère un jeton de 32 octets

// Stocke le jeton et l'adresse e-mail dans la base de données
// Remplacez les informations de connexion à la base de données par les vôtres
try {
    $bdd = new PDO('mysql:host=localhost;dbname=arts_gallery', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur PDO : ' . $e->getMessage());
}
$expiration = date('Y-m-d H:i:s', strtotime('+10 minutes'));
// Prépare une requête SQL pour insérer le jeton et l'adresse e-mail dans la base de données
$req = $bdd->prepare("INSERT INTO reset_password (email, token, expiration) VALUES (:email, :token, :expiration)");
$req->execute([
    'email' => $_POST['email'], 
    'token' => $token,
    'expiration' => $expiration
]);

// Vérifie si la requête a été exécutée avec succès
if ($req->rowCount() !== 1) {
    echo "Erreur lors de la génération du jeton de réinitialisation de mot de passe.";
    exit();
}


// Envoie un e-mail à l'utilisateur avec un lien de réinitialisation de mot de passe contenant le jeton

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;                      //Activer la sortie de débogage
$mail->isSMTP();                                            //Utiliser SMTP
$mail->Host       = 'smtp.gmail.com';                //Spécifier le serveur SMTP
$mail->SMTPAuth   = true;                                   //Activer l'authentification SMTP
$mail->Username   = 'artsgallery.info@gmail.com';                 //Nom d'utilisateur SMTP
$mail->Password   = 'bmqpdwfnikbpcirt';                                    //Mot de passe SMTP
$mail->SMTPSecure = 'tls';                                  //Activer le chiffrement TLS
$mail->Port       = 587;                                  //Port SMTP
$email = $_POST['email'];
$mail->setFrom('artsgallery.info@gmail.com', 'Arts Gallery');
$mail->addAddress($_POST['email']);   // le destinataire
$mail->isHTML(true);                                  //Définir le format de l'email comme HTML
$mail->Subject = "Réinitialisation de mot de passe";
$mail->Body    =  'Bonjour,\n\n";
        "Vous avez demandé à réinitialiser votre mot de passe.\n\n";
"Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe:\n\n";
"http://localhost/reset-new-password.php?token="' . $token . '"\n\n";
"Si vous n\'avez pas demandé cette réinitialisation, vous pouvez ignorer cet e-mail.\n\n"';


if($mail->send()){
    echo 
    $title = 'Réinitialisation mot de passe';
    include('includes/head.php');
    '<body>';
    include('includes/header.php');
    '</body>';
} else {
    echo "Une erreur est survenue lors de l'insertion du jeton de réinitialisation de mot de passe dans la base de données.";
}

?>
