<?php
session_start();

if (!isset($_SESSION['email'])) { // l'utilisateur n'est pas connecté
    header('location: connexion.php');
    exit;
}

// Inclut le fichier de connexion à la base de données
include('includes/db.php');

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $q = $bdd->prepare("SELECT * FROM CLIENT WHERE email = ?");
    $q->execute([$_SESSION['email']]);
    $result = $q->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) > 0) {
        // Utilisateur trouvé dans la table clients
        // Récupère les informations de l'utilisateur à partir de l'email stocké dans la session
        // Récupère les données du formulaire
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    
    // Met à jour les informations de l'utilisateur dans la base de données
    $q = 'UPDATE CLIENT SET pseudo = :pseudo, nom = :nom, prenom = :prenom WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute(['pseudo' => $pseudo, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email]);

    // Redirige l'utilisateur vers la page de modification de profil avec un message de succès
    $msg ='Votre profil a été mis à jour avec succès';
    header('location: profile.php?type=success&message=' . $msg);
    exit;
    } else {
        // Utilisateur non trouvé dans la table clients, vérifier la table artistes
        $q = $bdd->prepare("SELECT * FROM ARTISTE WHERE email = ?");
        $q->execute([$_SESSION['email']]);
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            // Récupère les données du formulaire
            $email = $_POST['email'];
            $pseudo = $_POST['pseudo'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            
            // Met à jour les informations de l'utilisateur dans la base de données
            $q = 'UPDATE ARTISTE SET pseudo = :pseudo, nom = :nom, prenom = :prenom WHERE email = :email';
            $req = $bdd->prepare($q);
            $req->execute(['pseudo' => $pseudo, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email]);

            // Redirige l'utilisateur vers la page de modification de profil avec un message de succès
            $msg ='Votre profil a été mis à jour avec succès';
            header('location: profile.php?type=success&message=' . $msg);
            exit;
        } else {
            // Utilisateur non trouvé dans la table clients ni artistes, erreur
            echo "Utilisateur non trouvé";
            exit;
        }
    }
    }
?>
