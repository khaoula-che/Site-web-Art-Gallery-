<?php
session_start();
require('includes/db.php');

if (isset($_GET['id_evenement']) || isset($_SESSION['id_evenement'] ) ){
    $id_evenement = $_GET['id_evenement'];

    $q = "SELECT EVENEMENT.*, ARTISTE.nom, ARTISTE.prenom FROM EVENEMENT INNER JOIN ARTISTE ON EVENEMENT.id_artiste = ARTISTE.id WHERE EVENEMENT.id_evenement= ?";
    $stmt = $bdd->prepare($q);
    $stmt->execute([$id_evenement]);

    $artiste = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_GET['id_evenement']) || isset($_SESSION['id_evenement'] )) {
    $id_evenement = $_GET['id_evenement'];
    $q = "SELECT * FROM EVENEMENT WHERE id_evenement = ?";
    $stmt = $bdd->prepare($q);
    $stmt->execute([$id_evenement]);

    $event = $stmt->fetch(PDO::FETCH_ASSOC);

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $event['titre']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
	<style>
        .hidden {
        display: none;
        }
        .card-img-top {
        width: 100%;
        height: 300px;
        object-fit: cover;
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<main style="margin-top:70px;">
   <div class="container">
            <?php
            if(isset($_GET['message']) && !empty($_GET['message']) && isset($_GET['type']) && !empty($_GET['type'])){
                echo '<div class="alert alert-' . htmlspecialchars($_GET['type']) . ' alert-warning alert-dismissible fade show">' . htmlspecialchars($_GET['message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                
            }
            ?>
        <div class="row mb-4">
            <div class="col-6 ">
            
            <h2 ><?php echo $event['titre']; ?></h2>
            <p style="margin-top: 30px;" class="card-text"><strong>Artiste :</strong><br> <?php echo $artiste['prenom'] . ' ' . $artiste['nom']; ?></p>
            <p style="margin-top: 20px;" class="card-text"><strong>Desctiption : </strong><br><?php echo $event['description']; ?></p>
            <p style="margin-top:10px;" class="card-text"><strong>Date : </strong><?php echo date('d/m/Y', strtotime($event['date_evenement'])); ?></p>
            <p style="margin-top:10px;" class="card-text"><strong>Heure : </strong><?php echo date('H:i', strtotime($event['heure_debut'])); ?> - <?php echo date('H:i', strtotime($event['heure_fin'])); ?></p>
            <p style="margin-top:10px;" class="card-text"><strong>Lieu : </strong><?php echo $event['adresse']; ?></p>
            <a style="text-decoration: none;"href="inscription_evenement.php?id_evenement=<?= $event['id_evenement']; ?>"><button class="btn_add_panier" type="submit">Inscription</button></a>
            </div>
            <div class="col-6">
                <div class="ml-4">
                <img src="<?php echo $event['image']; ?>" class="square-img" height="400px;">

                </div>
            </div>
             
        </div>
    </div>
</main>
        <script src="js/dark-mode.js"></script>
<?php include('includes/footer.php'); ?>
</body>
</html>