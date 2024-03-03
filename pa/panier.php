<?php
session_start();
require('includes/db.php');

if(isset($_SESSION['id'])){
    $id_user = $_SESSION['id'];
    $q = "SELECT ARTICLE.id_article, ARTICLE.nom, ARTICLE.prix, PANIER_COMPORTE.quantite FROM ARTICLE 
          JOIN PANIER_COMPORTE ON ARTICLE.id_article = PANIER_COMPORTE.id_article 
          JOIN PANIER ON PANIER_COMPORTE.id_panier = PANIER.id_panier
          WHERE PANIER.id_client = ?";
    $req = $bdd->prepare($q);
    $req->execute([
        $id_user
    ]);
    $panier = $req->fetchAll(PDO::FETCH_ASSOC);
    
    $total = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
</head>
<body>
	<main style="padding-top: 120px;">
	<div class="container">
	<?php include('includes/header.php')?>
	<h3>Mon panier</h3>
    <?php
            if(isset($_GET['message']) && !empty($_GET['message']) && isset($_GET['type']) && !empty($_GET['type'])){
                echo '<div class="alert alert-' . htmlspecialchars($_GET['type']) . ' alert-warning alert-dismissible fade show">' . htmlspecialchars($_GET['message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                
            }
            ?>
    <?php if(!isset($panier)){
        echo '<p> Votre panier est vide .</p>';
    }?>
	<table class="table table-striped">
                <tr>
                    <th>Article :</th>
                    <th>Prix unitaire :</th>
                    <th>Quantité :</th>
                    <th>Total :</th>
                    <th></th>
                </tr>
				
					<?php foreach($panier as $article){?>
						<tr>
							<td><?= $article['nom'] ?></td>
							<td><?= $article['prix'] ?> €</td>
							<td><?= $article['quantite'] ?></td>
							<td><?= $article['prix'] * $article['quantite'] ?> €</td>
                            <td>   
                                <a class="btn btn-danger btn-sm" href="delete-panier.php?id_article=<?=  $article['id_article']; ?>">Supprimer</a>
                            </td>
						</tr>
                        
			           <?php $total += $article['prix'] * $article['quantite']; ?>
                       <?php } ?>
                    
            </table>
            <h5 colspan="3">Total : <?= $total ?> €</h5>
            <?php if(count($panier) > 0){ ?>
        <hr>
        <h4>Passer la commande</h4>
        <div class="row mb-4">
            <div class="col-6 ">
          <form method="post" action="traitement_commande.php">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            <br>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
            <br>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" required>
            <br>
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" required>
            <br>
            <label for="code_postal">Code postal :</label>
            <input type="text" name="code_postal" id="code_postal" required>
            <br>
            <label for="pays">Pays :</label>
            <input type="text" name="pays" id="pays" required>
            <br>
            <input type="submit" value="Passer la commande" class="btn btn-primary">
        </form>
            </div>
        <div class="col-6">
                <div class="ml-4">
        <form action="traitement_paiement.php" method="POST">
        <label for="nom_carte">Nom sur la carte :</label>
        <input type="text" name="nom_carte" id="nom_carte" required>
        <br>
        <label for="num_carte">Numéro de carte :</label>
        <input type="text" name="num_carte" id="num_carte" required>
        <br>
        <label for="exp_mois">Mois d'expiration :</label>
        <input type="text" name="exp_mois" id="exp_mois" required>
        <br>
        <label for="exp_annee">Année d'expiration :</label>
        <input type="text" name="exp_annee" id="exp_annee" required>
        <br>
        <label for="code_secu">Code de sécurité :</label>
        <input type="text" name="code_secu" id="code_secu" required>
        <br>
            </div>
            </div>
    </form>
            </div>
    <?php } ?>

			</div>

	</main>
    <?php include('includes/footer.php');?>
    <script src="js/dark-mode.js"></script>
</body>
</html>
<?php } else {
        header("Location: connexion.php");
        exit;
} ?>
