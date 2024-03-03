<?php
session_start();
require('includes/db.php');

if (isset($_GET['id_article'])) {
    $id_article = $_GET['id_article'];

    $q = "SELECT ARTICLE.*, ARTISTE.nom, ARTISTE.prenom FROM ARTICLE INNER JOIN ARTISTE ON ARTICLE.id_artiste = ARTISTE.id WHERE ARTICLE.id_article = ?";
    $stmt = $bdd->prepare($q);
    $stmt->execute([$id_article]);

    $artiste = $stmt->fetch(PDO::FETCH_ASSOC);
}
 
if (isset($_GET['id_article'])) {
    $id_article = $_GET['id_article'];
    $_SESSION['id_article'] = $id_article; 
    $q = "SELECT * FROM ARTICLE WHERE id_article = ?";
    $stmt = $bdd->prepare($q);
    $stmt->execute([$id_article]);

    $article = $stmt->fetch(PDO::FETCH_ASSOC);

} else {
    header("Location: galerie.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $article['nom']; ?></title>
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
            <div class="row mb-4">
            <div class="col-6 ">
            <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['nom']; ?>" class="square-img" height="400px;">

                </div>
                
                <div class="col-6">
                <div class="ml-4">
                <h2 ><?php echo $article['nom']; ?></h2>
                <p style="font-size:14px; " class="card-text"><?php echo $article['type_oeuvre'] ?></p>

                <p style="margin-top: 30px;" class="card-text"><strong>Artiste :</strong><br> <?php echo $artiste['prenom'] . ' ' . $artiste['nom']; ?></p>
                <p style="margin-top: 20px;" class="card-text"><strong>Desctiption : </strong><br><?php echo $article['description']; ?></p>
                <p style="margin-top: 20px;" class="card-text"><strong>Prix : </strong><?php echo $article['prix']; ?> €</p>
                <form method="post" action="add_panier.php">
                    <input type="hidden" name="id_article" value="<?php echo $article['id_article']; ?>">
                    <p style="margin-top: 20px;"><strong>Quantité :</strong></p>
                    <input type="number" class="quantite" name="quantite" min="1" value="1">
                    <button class="btn_add_panier" type="submit">Ajouter au panier</button>
                </form>
                </div>
                </div>
                
            </div>
        
        </div>
</main>
        <script src="js/dark-mode.js"></script>
<?php include('includes/footer.php'); ?>
</body>
</html>