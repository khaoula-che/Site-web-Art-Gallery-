<?php 
require 'vendor/autoload.php';

session_start();

// Vérifier si le formulaire a été soumis

    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $titre = htmlspecialchars($_POST['titre']);
    $message = htmlspecialchars($_POST['message']);

    $mail->setFrom($_POST['email'], $nom);
    $mail->addAddress('artsgallery.info@gmail.com');   // le destinataire
    $mail->isHTML(true); 
    $mail->Subject = $titre;
    $mail->Body = $message;

    // Envoyer l'e-mail et vérifier si l'envoi a réussi ou non
    if ($mail->send()) {
        $message_envoye = true;
    } else {
        $erreur = 'Une erreur est survenue lors de l\'envoi du message : ' . $mail->ErrorInfo;
    }

?>
