<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajouter des ouvres d'art</title>
    <link rel="stylesheet" href="bootstrap/scss/bootstrap.scss">
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
</head>
<body>
    <?php include('includes/header-artiste.php'); ?>
    <h3>Ajoutez des oeuvres d'art </h3>
    <form method="POST" action="verif_post.php" enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="Le titre d'oeuvre">
        <input type="text" name="description" placeholder="La description">
        <div class="fileText">
            <label class="textImg" for="file">Image : </label> 
            <input type ="file" name="image" accept="image/gif, image/jpeg, image/png">
        </div>
        <input id="btn-modif" type="submit" value="Ajouter">
    </form>
</body>
</html>