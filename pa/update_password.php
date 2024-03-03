<?php
session_start();
// Vérifie si le formulaire de réinitialisation a été soumis
if (isset($_POST['submit'])) {
    // Récupère le jeton de réinitialisation et le nouveau mot de passe à partir du formulaire
    $token = $_POST['token'];
    $pwd = $_POST['pwd'];

    // Vérifie si le jeton de réinitialisation est valide
    // Remplacez les informations de connexion à la base de données par les vôtres
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=arts_gallery', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur PDO : ' . $e->getMessage());
    }
    $expiration = date('Y-m-d H:i:s', strtotime('+10 minutes'));
    $q = 'SELECT email FROM reset_password WHERE token = :token AND expiration = :expiration';
    $req = $bdd->prepare($q);
    $req->execute([
        'token' => $token,
        'expiration' => $expiration
    ]);

    $result = $req->fetch();
    // Met à jour le mot de passe de l'utilisateur dans la base de données
    $q = 'UPDATE client SET pwd = :password WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute([
        'password' => password_hash($pwd, PASSWORD_DEFAULT)
    ]);

    // Supprime le jeton de réinitialisation de la base de données
    $q = 'DELETE FROM reset_password WHERE token = :token';
    $req = $bdd->prepare($q);
    $req->execute([
        'token' => $token,
    ]);

    // Affiche un message de succès
    echo "Le mot de passe a été réinitialisé avec succès.";

    if (!$result) {
    // Affiche un message d'erreur si la requête n'a pas retourné de résultat
    echo "Le jeton de réinitialisation de mot de passe est invalide ou a expiré.";
   }

}
?>
