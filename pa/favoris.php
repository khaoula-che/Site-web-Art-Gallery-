<?php
session_start();
require_once('includes/db.php');


// Récupérer les articles favoris de l'utilisateur
$q = 'SELECT * FROM ARTICLE INNER JOIN FAVORIS ON ARTICLE.id_article = FAVORIS.id_article WHERE FAVORIS.id_user = :id_user';
$req = $bdd->prepare($q);
$req->execute([
    'id_user' => $_SESSION['id']
]);

$results = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mes favoris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
    <style>
        .card-img-top {
  width: 100%;
  height: 300px;
  object-fit: cover;
}
        </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <main style="padding-top:120px;">
	<div class="container">
        <h2>Mes favoris</h2>
		<?php if (empty($results)){?>
            <p>Aucun article favori pour le moment.</p>
        <?php }else{ ?>
        <div class="album py-5">
		<div class="container">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
				<?php foreach ($results as $result) {
					$image = $result['image'];
					?>
					<div class="col">
						<div class="card shadow-sm">
							<a href="article.php?id=<?= $result['id_article'] ?>"><img class="card-img-top" src="<?php echo $image ?>" alt="profil" class=".card-img-top"></a>
							<div class="card-body">
								<h5><?php echo $result['nom'] ?></h5>
								<p style="font-size:14px;" class="card-text"><?php echo $result['type_oeuvre'] ?></p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
                                <small style="margin-top:10px;" class="text-muted"><?php echo $result['prix'] ?> €</small>
								</div>
                                <a href="add_favoris.php?id=<?php echo $result['id_article'] ?>"><img src="images/coeur-de-cercle.png" height="25px"></a>
							</div>
							<a id="a-art" href="article.php?id_article=<?php echo $result['id_article']; ?>">Voir l'article</a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	</div>
	<?php } ?>
	</div>
    </main>
	<script src="js/dark-mode.js"></script>
	<?php include('includes/footer.php'); ?>
</body>
</html>
