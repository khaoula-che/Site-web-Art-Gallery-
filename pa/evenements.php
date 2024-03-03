<?php
session_start();
require_once('includes/db.php');

$q = 'SELECT * FROM EVENEMENT ORDER BY date_creation DESC';
$req = $bdd->query($q);
$events = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évènements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
</head>
<body> 
    <main style="padding-top:120px;">
<?php include('includes/header.php'); ?>
    <div class="container">
        <h2 style="margin-bottom:30px;">Évènements</h2>
        <?php if(empty($events)) { ?>
            <p>Aucun évènement à afficher pour le moment.</p>
        <?php }else{?>
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
            <a style="margin-top:10px;" href="event.php?id_evenement=<?= $event['id_evenement']; ?>">S'inscrire</a>
        </div>
    </div>
</div>

            <?php } } ?>
    </div>
    </main>
    <script src="js/dark-mode.js"></script>
    <?php include('includes/footer.php'); ?>
</body>
</html>
