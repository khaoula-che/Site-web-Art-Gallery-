<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>

    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
</head>
<body>
<?php include('includes/header.php');?>
    <main>
<div class="container">
   <div class="row mb-4">
    
	<h3 class="title-users">Modifier mon profile</h3>
    <div class="col-lg-6">
    <?php
                if(!isset($_SESSION['email'])){ // l'utilisateur est connecté
                    header('location: connexion.php');
                    exit;
                }
                
                include('includes/db.php');
                
                $q = $bdd->prepare("SELECT * FROM CLIENT WHERE email = ?");
                $q->execute([$_SESSION['email']]);
                $result = $q->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    $q = 'SELECT email, pseudo, nom, prenom FROM CLIENT WHERE email = :email';
                    $req = $bdd->prepare($q);
                    $req->execute(['email' => $_SESSION['email']]);
                    $user = $req->fetch();
                } else {
                    $q = $bdd->prepare("SELECT * FROM ARTISTE WHERE email = ?");
                    $q->execute([$_SESSION['email']]);
                    $result = $q->fetchAll(PDO::FETCH_ASSOC);
                    if (count($result) > 0) {
                        $q = 'SELECT email, pseudo, nom, prenom FROM ARTISTE WHERE email = :email';
                        $req = $bdd->prepare($q);
                        $req->execute(['email' => $_SESSION['email']]);
                        $user = $req->fetch();
                    } else {
                        echo "Utilisateur non trouvé";
                        exit;
                    }
                }
                ?>
                <h4> Mes informations : </h4><br>
                <form method="post" action="update.php">
                
                <p><strong>Pseudo :</strong>
                <input type="text" class="input-field" name="pseudo" value="<?php echo $user['pseudo']; ?>"></p><br>
                
                <p><strong>Nom :</strong>
                <input type="text" class="input-field" name="nom" value="<?php echo $user['nom']; ?>"></p><br>

                <p><strong>Prénom :</strong>
                <input type="text" class="input-field" name="prenom" value="<?php echo $user['prenom']; ?>"></p><br>

                <p><strong>E-email :</strong>
                <input type="email" class="input-field" name="email" value="<?php echo $user['email']; ?>"></p><br>

                <input id="btn-modif" type="submit" value="Enregistrer">
                </form>
            </div>
                <div class="col-lg-6">
                <h4>Photo de profile : </h4>
                <form method="POST" action="image_profil.php" enctype="multipart/form-data">
                    <p>
                    <label for="image">Choisissez une image de profil :</label>
                    <input type="file" name="image" id="file" accept="image/png, image/jpeg">
                    </p>
                    <p>
                    <input id="btn-modif" type="submit" value="Enregistrer">
                    </p>
                </form>	
                
            </div>
            </div>
            </div>
        </main>
    <?php include('includes/footer.php');?>
</body>
</html>




