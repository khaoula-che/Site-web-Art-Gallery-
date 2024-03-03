<?php 
// Connexion à la base de données
session_start();
$email = $_SESSION['email'];
require('includes/db.php');
// Récupération des catégories
$q = 'SELECT * FROM categorie';
$req = $bdd->query($q);
$categories = $req->fetchAll(PDO::FETCH_ASSOC);

// Récupération des articles
$q = 'SELECT * FROM article';
$req = $bdd->query($q);
$articles = $req->fetchAll(PDO::FETCH_ASSOC);

// Filtrage des articles par catégorie et prix
if(isset($_POST['filtrer'])) {
    $id_categorie = $_POST['categorie'];
    $prix_min = $_POST['prix_min'];
    $prix_max = $_POST['prix_max'];

    $q = 'SELECT * FROM article WHERE prix BETWEEN :prix_min AND :prix_max';
    if($id_categorie != 'toutes') {
        $q .= ' AND id_categorie = :id_categorie';
    }

    $req = $bdd->prepare($q);
    $req->execute([
        'prix_min' => $prix_min,
        'prix_max' => $prix_max,
        'id_categorie' => $id_categorie
    ]);
    $articles = $req->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Système de filtrage</title>
</head>
<body>
    <form method="post">
        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie">
            <option value="toutes">Toutes les catégories</option>
            <?php foreach($categories as $categorie) { ?>
                <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['nom']; ?></option>
            <?php } ?>
        </select>
        <br><br>
        <label for="prix_min">Prix minimum :</label>
        <input type="number" name="prix_min" id="prix_min">
        <br><br>
        <label for="prix_max">Prix maximum :</label>
        <input type="number" name="prix_max" id="prix_max">
        <br><br>
        <button type="submit" name="filtrer">Filtrer</button>
    </form>
    <br><br>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach($articles as $article) { ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <a href=""><img class="card-img-top" src="<?php echo $article['image']; ?>" alt="image de l'article"></a>
                            <div class="card-body">
                                <h5><?php echo $article['nom']; ?></h5>
                                <p style="font-size:14px;" class="card-text"><?php echo $article['description']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <small style="margin-top:10px;" class="text-muted"><?php echo $article['prix']; ?> €</small>
                                    </div>                          
                                </div>
                            </div>
                </div>
                <?php } ?>
                </div>
                </div>
                </div>
                </div>
                </div>

