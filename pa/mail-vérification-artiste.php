<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

include('includes/db.php');
// Insertion du token dans la base de données
$token= $_SESSION['token'];
$confirmLink = 'https://artsgallery.ddns.net//compte-artiste.php?token=' . $token;

$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;                      //Activer la sortie de débogage
$mail->isSMTP();                                            //Utiliser SMTP
$mail->Host       = 'smtp.gmail.com';                //Spécifier le serveur SMTP
$mail->SMTPAuth   = true;                                   //Activer l'authentification SMTP
$mail->Username   = 'artsgallery.info@gmail.com';                 //Nom d'utilisateur SMTP
$mail->Password   = 'bmqpdwfnikbpcirt';                                    //Mot de passe SMTP
$mail->SMTPSecure = 'tls';                                  //Activer le chiffrement TLS
$mail->Port       = 587;                                  //Port SMTP
$email = $_SESSION['email'];
$mail->setFrom('artsgallery.info@gmail.com', 'Arts Gallery');
$mail->addAddress($email);   // le destinataire
$mail->isHTML(true);                                  //Définir le format de l'email comme HTML
$mail->Subject = 'Merci pour votre inscription !';
$mail->Body    = '<html>
                     <head>
                     </head>
                     <body>
                        <h2>Confirmation de votre compte</h2>
                        <p>Bonjour,</p>
                        <p>Confirmez votre compte Arts Gallery en cliquant sur le lien ci-dessous :</p>
                        <a href="'.$confirmLink.'">'.$confirmLink.'</a>
                     </body>
                     </html>';

 if($mail->send()){
   header('location: inscription-finalisation.php ');
   exit;
 } else {
     echo 'Une erreur s\'est produite : ' . $mail->ErrorInfo;
 }
 ?>