<?php 
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start(); 
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Information newsletter</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
    </head>
</html>
    <body>
		<?php include('includes/header.php'); ?>
		<main>
		<div class="container">
        <h1>Information d'utilisateur</h1>
		    <?php 
            include('includes/db.php');

            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $q = 'SELECT * FROM NEWSLETTER WHERE id=:id';
                $stmt = $bdd->prepare($q);
                $stmt->execute(['id' => $id]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if($user){
                    echo '<p class="mb-2"><strong>Id :</strong> ' . $user['id'] . '</p>';
                    echo '<p class="mb-2"><strong>Email :</strong> ' . $user['email'] . '</p>';
                } else {
                    echo '<p>Cet utilisateur n\'existe pas.</p>';
                }
            } else {
                echo '<p>Aucun utilisateur sélectionné.</p>';
            }
            ?>
            <a class="btn-retour" href="users.php">Retour à la liste des utilisateurs </a>
			</div>
		</main>
        <script src="js/dark-mode.js"></script>
		<?php include('includes/footer.php'); ?>
	</body>
</html>
