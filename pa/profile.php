<?php
session_start();
$email = $_SESSION['email'];
require('includes/db.php');
$q = $bdd->prepare("SELECT * FROM CLIENT WHERE email = ?");
                $q->execute([$_SESSION['email']]);
                $result = $q->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    // Utilisateur trouvé dans la table clients
                    $q = 'SELECT id, pseudo, nom, prenom FROM CLIENT WHERE email = :email';
                    $req = $bdd->prepare($q);
                    $req->execute(['email' => $_SESSION['email']]);
                    $user = $req->fetch();
                    $id = $user['id'];
                    $_SESSION['id'] = $id;
                    
                } else {
                    $q = $bdd->prepare("SELECT * FROM ARTISTE WHERE email = ?");
                    $q->execute([$_SESSION['email']]);
                    $result = $q->fetchAll(PDO::FETCH_ASSOC);
                    if (count($result) > 0) {
                        // Utilisateur trouvé dans la table artistes
                        $q = 'SELECT id, pseudo, nom, prenom FROM ARTISTE WHERE email = :email';
                        $req = $bdd->prepare($q);
                        $req->execute(['email' => $_SESSION['email']]);
                        $user = $req->fetch();
                        $id = $user['id'];
                        $_SESSION['id'] = $id;
                        
                    } else {
                        // Utilisateur non trouvé dans la table clients ni artistes, erreur
                        echo "Utilisateur non trouvé";
                        exit;
                    }
                }
              
$q = "SELECT * FROM IMAGE_PROFIL WHERE id_client = $id OR id_artiste = $id ORDER BY id DESC LIMIT 1";
$req = $bdd->prepare($q);
$req->execute();
$success = $req->fetch();
if ($success) {
    $image = $success['image'];
} else {
    $image = "default.jpg"; // image par défaut si aucune image n'est trouvée
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">

</head>
<body>
    <?php include('includes/header.php'); ?>
    <main>
        <div class="container">
            <div>
                <h3 class="title-users" > Mon profil : </h3>
                <?php include('includes/message.php'); ?>
            </div>
            <div class="row mb-4">
            <div class="col-6 ">
                <?php
                if(!isset($_SESSION['email'])){ // l'utilisateur est connecté
                    header('location: connexion.php');
                    exit;
                }
                  // Inclut le fichier de connexion à la base de données
                include('includes/db.php');
                
              ?>
                
                <h4 class="mb-3"> Mes informations : </h4><br>
                <p class="mb-2"><strong>Pseudo: </strong> <?php echo $user['pseudo']; ?></p><br>
                <p class="mb-2"> <strong>Nom : </strong><?php echo $user['nom']; ?></p><br>
                <p class="mb-2"><strong>Prénom : </strong><?php echo $user['prenom']; ?></p><br>
                <p class="mb-2"><strong>E-mail : </strong><?php echo $_SESSION['email']; ?></p>

                </div>

                <div class="col-6">
                <div class="ml-4">
                    <h4 class="mb-3">Photo de profile : </h4>
                    <?php
                    if (empty($success)) {
                        echo "Aucune image de profil n'a été enregistrée pour cet utilisateur.";
                    } else {
                        $image = $success['image'];
                        echo '<img src="uploads/' .  $image . '"alt="profil"  height="200px" style="border-radius: 50%;" >'; 
                    }
                    ?>
                    
                </div>
                </div>
                
            </div> 
        <?php 
        $q = $bdd->prepare("SELECT * FROM ARTISTE WHERE email = ?");
        $q->execute([$_SESSION['email']]);
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            
        $q = 'SELECT * FROM ARTICLE WHERE id_artiste = :id_artiste';
        $req = $bdd->prepare($q);
        $req->execute(['id_artiste' => $id]);
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
        <div class="album py-5">
		<div class="container">
            <h4>Mes oeuvres ajoutées :</h4><br>
            <?php
            if(isset($_GET['message']) && !empty($_GET['message']) && isset($_GET['type']) && !empty($_GET['type'])){
                echo '<div class="alert alert-' . htmlspecialchars($_GET['type']) . ' alert-warning alert-dismissible fade show">' . htmlspecialchars($_GET['message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                
            }
            ?>
            <?php if (empty($results)){ ?>
                <p> Aucune oeuvre n'a été ajoutée.</p>
            <?php }else{ ?>
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
				<?php foreach ($results as $result) {
					$image = $result['image'];
					?>
					<div class="col">
						<div class="card shadow-sm">
							<a href="article.php?id_article=<?= $result['id_article'] ?>"><img  src="<?php echo $image ?>" alt="profil" class="card-img-top" ></a>
							<div class="card-body">
								<h5><?php echo $result['nom'] ?></h5>
								<p style="font-size:14px;" class="card-text"><?php echo $result['type_oeuvre'] ?></p>
								<div class="btn-group">
                                <small style="margin-top:10px;" class="text-muted"><?php echo $result['prix'] ?> €</small>
								</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a id="a-art" href="article.php?id_article=<?= $result['id_article']; ?>">Voir l'article</a>
                                <a id="a-art" href="">Modifier</a>
                                <a id="a-art" href="supprimer_article.php?id_article=<?= $result['id_article'];?>" >Supprimer</a>
                            </div>

						</div>
					</div>
				</div>
				<?php }} ?>
			</div>
		</div>
	</div>
    <h4>Mes évènements ajoutés :</h4><br>
    <?php 
        $q = 'SELECT * FROM EVENEMENT WHERE id_artiste = :id_artiste';
        $req = $bdd->prepare($q);
        $req->execute(['id_artiste' => $id]);
        $events = $req->fetchAll(PDO::FETCH_ASSOC);
        if(empty($events)) { ?>
            <p>Aucun évènement à afficher pour le moment.</p>
        <?php }else{ ?>
                <?php foreach($events as $event) { ?>
                    <div class="row g-0 border rounded overflow-hidden mb-4 shadow-sm">
        <div class="col-md-4">
            <img src="<?= $event['image'] ?>" alt="" class="img-fluid">
        </div>
        <div class="col-md-8">
            <div class="p-4 d-flex flex-column">
                <h3 class="mb-0"><?php echo $event['titre']; ?></h3>
                <div class="mb-1 text-body-secondary">Publié le : <?php echo date('d/m/Y', strtotime($event['date_creation'])) ;?></div>
                <p style="margin-top:30px;" class="card-text mb-auto"><?php echo $event['description']; ?></p>
                <p style="margin-top:10px;"><strong>Date : </strong><?php echo date('d/m/Y', strtotime($event['date_evenement'])); ?></p>
                <p style="margin-top:10px;"><strong>Heure : </strong><?php echo date('H:i', strtotime($event['heure_debut'])); ?> - <?php echo date('H:i', strtotime($event['heure_fin'])); ?></p>
                <p style="margin-top:10px;"><strong>Lieu : </strong><?php echo $event['adresse']; ?></p>
                <a style="margin-top:10px;" href="#" class="stretched-link">S'inscrire</a>
            </div>
        </div>
        <?php } } ?>
    </div>
    <h4 style="margin-top:50px;">La liste des participants :</h4><br>
        <?php 
        $q = 'SELECT * FROM EVENEMENT WHERE id_artiste = :id_artiste';
        $req = $bdd->prepare($q);
        $req->execute(['id_artiste' => $id]);
        $events = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($events as $event) {
            $id_evenement = $event['id_evenement'];
            $titre = $event['titre'];
        }
        
        $q = "SELECT INSCRIRE.*, CLIENT.nom, CLIENT.prenom, CLIENT.email FROM INSCRIRE INNER JOIN CLIENT ON INSCRIRE.id_participant = CLIENT.id WHERE INSCRIRE.id_evenement = :id_evenement";
        $stmt = $bdd->prepare($q);
        $stmt->execute(['id_evenement' => $id_evenement]);
        
        $participants = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($participants)) { ?>
            <p>Aucun participant pour le moment.</p>
        <?php } else { ?>
            <table class="table table-striped">
                <tr>
                    <th>Titre d'évènement :</th>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Action</th>
                </tr>
                <?php foreach($participants as $participant) { ?>
                    <tr>
                        <td><?= $titre; ?></td>
                        <td><?= $participant['email']; ?></td>
                        <td><?= $participant['nom']; ?></td>
                        <td><?= $participant['prenom']; ?></td>
                        <td>
                            <a class="btn btn-secondary btn-sm" href="read-client.php?id=<?= $participant['id_participant']; ?>">Consulter</a>
                            <a class="btn btn-danger btn-sm" href="delete-client.php?id=<?= $participant['id_participant']; ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php }} ?>
 
        <div class="modif">
            <a id="btn-modif" href="modification-profile.php">Modifier le profil</a>
        </div>
        <div class="modif">
         <a id="btn-modif" href="fichier-pdf.php" target="_blank">Télécharger mon profil en PDF</a>
            </div>
            <div class="modif">
         <a id="btn-modif" href="déconnexion.php">Déconnexion</a>
            </div>
                </div>
        </main>
        <script src="js/dark-mode.js"></script>
        <?php include('includes/footer.php'); ?>
    </body>
</html>
