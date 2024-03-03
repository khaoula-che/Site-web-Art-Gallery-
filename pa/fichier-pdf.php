<?php
require_once('tcpdf/tcpdf.php');
session_start();
require('includes/db.php');

$q = $bdd->prepare("SELECT * FROM CLIENT WHERE email = ?");
$q->execute([$_SESSION['email']]);
$result = $q->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
    // Utilisateur trouvé dans la table clients
    $q = 'SELECT id, pseudo, nom, prenom, email FROM CLIENT WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute(['email' => $_SESSION['email']]);
    $user = $req->fetch();
    $id = $user['id'];

} else {
    // Utilisateur non trouvé dans la table clients, vérifier la table artistes
    $q = $bdd->prepare("SELECT * FROM ARTISTE WHERE email = ?");
    $q->execute([$_SESSION['email']]);
    $result = $q->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) > 0) {
        // Utilisateur trouvé dans la table artistes
        $q = 'SELECT id, pseudo, nom, prenom, email FROM ARTISTE WHERE email = :email';
        $req = $bdd->prepare($q);
        $req->execute(['email' => $_SESSION['email']]);
        $user = $req->fetch();
        $id = $user['id'];
    } else {
        // Utilisateur non trouvé dans la table clients ni artistes, erreur
        echo "Utilisateur non trouvé";
        exit;
    }
}

$q = "SELECT * FROM IMAGE_PROFIL WHERE id_client = $id OR id_artiste = $id ORDER BY id DESC LIMIT 1";
$req = $bdd->prepare($q);
$req->execute();
$result = $req->fetch();
if ($result) {
    $image = $result['image'];
} else {
    $image = "default.jpg"; // image par défaut si aucune image n'est trouvée
}

// Récupérer les informations de profil de l'utilisateur
$nom = $user['nom'];
$prenom = $user['prenom'];
$email = $user['email'];
$pseudo = $user['pseudo'];

// Créer une nouvelle instance de TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Ajouter une page
$pdf->AddPage();

// Écrire les informations de profil dans le PDF
$html = '
    <h1>Profil utilisateur</h1>
    <h2>Mes informations : </h2>
    <p><strong>Nom d\'utilisateur : </strong>' . $pseudo . '</p>
    <p><strong>Nom : </strong>' . $nom . '</p>
    <p><strong>Prénom : </strong>' . $prenom . '</p>
    <p><strong>Adresse email : </strong>' . $email . '</p>

    <h4 >Photo de profil : </h4>';
                    
if (empty($result)) {
    $html .= "Aucune image de profil n'a été enregistrée pour cet utilisateur.";
} else {
    $html .= '<img src="uploads/' . $image . '" alt="profil" height="200px">';
}

$pdf->writeHTML($html, true, false, true, false, '');

// Exporter le PDF
$pdf->Output('profil-utilisateur.pdf', 'I');

?>
