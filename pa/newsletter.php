<?php
session_start();
if(isset($_POST['email']) && !empty($_POST['email'])){
	setcookie('email', $_POST['email'], time() + 24 * 3600);
}

if(!isset($_POST['email'])|| empty($_POST['email'])){
    $msg= 'L\adresse mail ne peut pas être vide';
    header('location: index.html?type=danger&message=' .$msg );
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $msg = 'Adresse email invalide.';
    header('location: inscription.php?type=danger&message=' .$msg);
    exit;
}
try{
    $bdd = new PDO('mysql:host=51.75.246.121;dbname=ARTSGALLERY', 'groupe3', 'G32023', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
   }
   
catch(Exception $e){
    die('Erreur PDO : ' . $e->getMessage());
}

$q = 'SELECT id FROM NEWSLETTER WHERE email = :email';
$req = $bdd->prepare($q);
$req->execute([
	'email' => $_POST['email']
]);
 
$results = $req->fetchAll();

if (count($results) > 0) {
    $msg= 'Cet e-mail est déjà utilisé par un autre utilisateur.';
    header('location: index.php?type=danger&message=' . $msg);
    exit;
}


$q = 'INSERT INTO NEWSLETTER (email) VALUES (:email)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([ 
    'email' => $_POST['email']
]);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

//Paramètres du serveur SMTP
$mail = new PHPMailer(true);

$mail->SMTPDebug = 0;                      //Activer la sortie de débogage
$mail->isSMTP();                                            //Utiliser SMTP
$mail->Host       = 'smtp.gmail.com';                //Spécifier le serveur SMTP
$mail->SMTPAuth   = true;                                   //Activer l'authentification SMTP
$mail->Username   = 'artsgallery.info@gmail.com';                 //Nom d'utilisateur SMTP
$mail->Password   = 'bmqpdwfnikbpcirt';                                    //Mot de passe SMTP
$mail->SMTPSecure = 'tls';                                  //Activer le chiffrement TLS
$mail->Port       = 587;                                  //Port SMTP
//Paramètres de l'e-mail
$mail->setFrom('artsgallery.info@gmail.com', 'Arts Gallery');
$mail->addAddress($_POST['email']);   //Ajouter le destinataire
$mail->isHTML(true);                                  //Définir le format de l'e-mail comme HTML
$mail->Subject = 'Inscription newsletter';
$mail->Body    = '<html>
                    <head>
                    </head>
                    <body>
                         <h2>Merci pour votre confiance !</h2>
                         <p>Nous sommes ravis de vous confirmer votre inscription à notre newsletter. Vous allez désormais recevoir nos dernières actualités, nos offres spéciales et nos événements à venir directement dans votre boîte de réception.</p>
                         <p>Si vous avez des questions ou des commentaires, n\'hésitez pas à nous contacter. Nous sommes toujours heureux d\'avoir de vos nouvelles.</p>
                    </body>
                    <footer>
                         <p>© 2023 Arts Gallery</p>
                    </footer>
                  </html>';

//Envoyer l'e-mail
if($mail->send()){
    echo 'Le message a bien été envoyé';
} else {
    echo 'Une erreur s\'est produite : ' . $mail->ErrorInfo;
}



?>

