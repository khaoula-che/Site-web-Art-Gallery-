<?php
session_start();
require('includes/db.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Galerie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
</head>
<body>
<?php
include('includes/header.php');

$categorie = isset($_GET['type_oeuvre']) ? $_GET['type_oeuvre'] : '';
$prixMax = isset($_GET['prix']) ? $_GET['prix'] : '';

$q = 'SELECT * FROM ARTICLE';
if (!empty($categorie)) {

	$categorie = $bdd->quote($categorie);
	$q .= " WHERE type_oeuvre = $categorie";
	
}
if (!empty($prixMax)) {
    if (!empty($categorie)) {
        $q .= " AND prix <= $prixMax";
    } else {
        $q .= " WHERE prix <= $prixMax";
    }
}
$q .= ' ORDER BY id_article DESC';

$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<main style="padding-top:120px;">
<div class="container">
<h2 style="margin: 0;">Galerie</h2>
<div class="row">

  <div class="col" style="display: flex; align-items: center;">
    
    <p style="margin: 0 0 0 10px;">Trouvez toutes sortes d’œuvres d'art sur Arts Gallery</p>
  </div>
  <div class="col" style="display: flex; align-items: center;">
    <div class="search-container">
      <form action="">
        <input class="search-input" type="text" name="nom" placeholder="Recherche..." oninput="searchCards()">
        <button onclick="getCards()" type="submit" class="search-btn"><img src="images/search.png" alt="Rechercher" height="20px"></button>
      </form>
    </div>
  </div>
</div>
<form method="GET" style="display:flex; align-items:center;">
	<div class="form-group" style="margin-right: 10px;">
		<label id="label-filtre" for="categorie">Catégorie :</label>
		<select class="form-control" id="categorie" name="type_oeuvre">
		    <option value="">Toutes les catégories</option>
			<option value="Paysage">Paysage</option>
			<option value="Portrait">Portrait</option>
			<option value="Urbain">Urbain</option>
			<option value="Culture populaire">Culture populaire</option>
			<option value="Scandinaves">Scandinaves</option>
		</select>
	</div>
	<div class="form-group" style="margin-right: 10px;">
		<label id="label-filtre" for="prix">Prix maximum :</label>
		<input type="number" class="form-control" id="prix" name="prix" min="0" step="0.01">
	</div>
	<button class="btn_filtre" type="submit">Filtrer</button>
</form>
<div id="card_list"></div>
<?php 
if(isset($_GET['nom']) && !empty($_GET['nom'])){
    $nom = $_GET['nom'];
    $sql = "SELECT id_article, nom, type_oeuvre, prix, image FROM ARTICLE WHERE nom LIKE ?";
    $stmt = $bdd->prepare($sql);
    $success = $stmt->execute([
        "%" .$nom . "%"
    ]);
    if($success){
		$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($articles as $article) {
			echo "<p>";
			echo '<div class="album py-5">
				<div class="container">
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
			
				$image = $article['image'];
				echo '<div class="col">
					<div class="card shadow-sm">
						<a href="article.php?id=' . $article['id_article'] .'"><img class="card-img-top" src="'. $image .'" alt="profil" class=".card-img-top"></a>
						<div class="card-body">
							<h5>' .  $article['nom'] . '</h5>
							<p style="font-size:14px;" class="card-text">' . $article['type_oeuvre'] . '</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<small style="margin-top:10px;" class="text-muted">' .  $article['prix'] . '€</small>
								</div>
								<a href="add_favoris.php?id=' . $article['id_article'] . '"><img src="images/coeur-de-cercle.png" height="25px"></a>
							</div>
						</div>
					</div>
				</div>';
			}
			echo '</div>
				</div>
			</div>
			</p>';
		}
		echo '<hr class="featurette-divider">';
		echo "</div>";
	}
	?>
	
	<div class="album py-5">
		<div class="container">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
				<?php foreach ($results as $result) {
					$image = $result['image'];
					?>
					<div class="col">
						<div class="card shadow-sm">
							<a href="article.php?id_article=<?= $result['id_article'] ?>"><img class="card-img-top" src="<?php echo $image ?>" alt="profil" class=".card-img-top"></a>
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
				</main>
<script>
function toggleFilter() {
  const form = document.getElementById("filter-form");
  form.classList.toggle("hidden");
}
</script>
<script src="js/search_oeuvre.js"></script>
<script src="js/dark-mode.js"></script>
<?php include('includes/footer.php'); ?>
</body>
</html>
