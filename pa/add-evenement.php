<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajouter des ouvres d'art</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
</head>
<body>
    <main>
    <?php include('includes/header.php'); ?>
    <div class="add_form">
    <h3 >Ajoutez des évènements : </h3>
    <?php
    if(isset($_GET['message']) && !empty($_GET['message']) && isset($_GET['type']) && !empty($_GET['type'])){
        echo '<div class="alert alert-' . htmlspecialchars($_GET['type']) . ' alert-warning alert-dismissible fade show">' . htmlspecialchars($_GET['message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
    }
    ?>
        <form class="input-group-add" method="POST" action="verif_add_evenement.php" enctype="multipart/form-data">
            <label for="titre">Titre : </label> 
            <input class="input-field" type="text" name="titre"><br>
            <label for="adresse">Adresse :</label>
            <input class="input-field" type="text" name="adresse"><br>
            <label for="date_evenement">Date d'évènement : </label> 
            <input  class="input-field" type="date" name="date_evenement"><br>
            <label for="heure_debut">Heure de début : </label> 
            <input class="input-field" type="time" name="heure_debut"><br>
            <label for="heure_fin">Heure de fin : </label> 
            <input  class="input-field" type="time" name="heure_fin"><br>
            <label for="description">Description : </label> 
            <input class="input-field" type="text" name="description"><br>
            <div class="fileText">
                <label class="textImg" for="image">Image : </label> 
                <input type ="file" name="image" accept="image/gif, image/jpeg, image/png"><br>
            </div>
            <input class="submit-btn" type="submit" value="Ajouter">
        </form>
    </div>
</main>
<?php include('includes/footer.php');?>
</body>
</html>