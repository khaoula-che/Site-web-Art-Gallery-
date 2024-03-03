<?php
session_start();
require_once('includes/db.php');

if (!isset($_SESSION["email"])) {
    header("Location: connexion.php");
    exit();
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $q= "SELECT * FROM ARTISTE WHERE token = :token";
    $req = $bdd->prepare($q);
    $req->execute([
        'token' => $token
    ]);
    $user = $req->fetch();
    $user['id'] = $_SESSION['id'];
    if (!$user) {
        echo "Token invalide";
        exit;
    } else {
        if (!is_null($user['token'])) {
            $q ="UPDATE ARTISTE SET token = NULL WHERE id = :id";
            $req = $bdd->prepare($q);
            $req->execute([
                ':id' => $user['id']
            ]);
        }
        
    }
    $user['id'] = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <main style="padding-top:120px;">
        <h3 style=" text-align: center;">Bonjour <?php echo  $user['prenom'] ; ?> , votre compte a été créé avec succès !</h3>
    </main>
    <?php include('includes/footer.php'); ?>
</body>
    
</html>