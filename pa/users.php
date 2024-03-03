<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>users</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
    </head>
    <body data-mode = 'light'>
		<?php include('includes/header.php'); ?>
		<main>
		<div class="container">
			<h1 class="title-users">Les utilisateurs</h1>
            <?php include('includes/message.php');?>
            <div class="col" style="display: flex; align-items: center;">
            <div class="search-container">
            <form action="">
                <input class="search-input" type="text" name="recherche" placeholder="Recherche..." oninput="searchUser()">
                <button onclick="getUser()" type="submit" class="search-btn"><img src="images/search.png" alt="Rechercher" height="20px"></button>
            </form>
            </div>
            </div>

            <div id="user-list"></div>
<?php 
if(isset($_GET['recherche']) && !empty($_GET['recherche'])){
    $recherche = $_GET['recherche'];
    $sql = "SELECT id, nom, prenom, email, pseudo FROM CLIENT WHERE nom LIKE :search 
        OR prenom LIKE :search 
        OR email LIKE :search 
        OR pseudo LIKE :search 
        UNION 
        SELECT id, nom, prenom, email, pseudo FROM ARTISTE 
        WHERE nom LIKE :search 
        OR prenom LIKE :search 
        OR email LIKE :search 
        OR pseudo LIKE :search";

    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ':search' => '%' . $recherche . '%'
    ]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($users){
		foreach ($users as $user) {
           echo' <table class="table table-striped">
            <tr>
                <th>Id</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>nom</th>
                <th>prenom</th>
                <th>Action</th>
            </tr>';
                echo '<tr>';
                echo '<td>' . $user['id'] . '</td>';
                echo '<td>' . $user['pseudo'] . '</td>';
                echo '<td>' . $user['email'] . '</td>';
                echo '<td>' . $user['nom'] . '</td>';
                echo '<td>' . $user['prenom'] . '</td>';
                echo '<td>
                         <a class="btn btn-secondary btn-sm" href="read-client.php?id=' .  $user['id'] . '">Consulter</a>
                         <a class="btn btn-danger btn-sm" href="delete-client.php?id=' .  $user['id'] . '">Supprimer</a>
                      </td>';
                echo '</tr>';
            }
        }
    }
            ?>
        </table>
         
            <h4 id="title-c">Compte client :</h4>
		    <?php 
            include('includes/db.php');
            ?>
            <?php
            $q = 'SELECT * FROM CLIENT ORDER BY id';
            $req = $bdd->query($q);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($results as $user){
                    echo '<tr>';
                    echo '<td>' . $user['id'] . '</td>';
                    echo '<td>' . $user['pseudo'] . '</td>';
                    echo '<td>' . $user['email'] . '</td>';
                    echo '<td>' . $user['nom'] . '</td>';
                    echo '<td>' . $user['prenom'] . '</td>';
                    echo '<td>
                             <a class="btn btn-secondary btn-sm" href="read-client.php?id=' .  $user['id'] . '">Consulter</a>
                             <a class="btn btn-danger btn-sm" href="delete-client.php?id=' .  $user['id'] . '">Supprimer</a>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </table>
			</div>
            <div class="container">
            <h4 id="title-c">Compte artiste :</h2>
            <?php
            $q = 'SELECT * FROM ARTISTE ORDER BY id';
            $req = $bdd->query($q);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($results as $user){
                    echo '<tr>';
                    echo '<td>' . $user['id'] . '</td>';
                    echo '<td>' . $user['pseudo'] . '</td>';
                    echo '<td>' . $user['email'] . '</td>';
                    echo '<td>' . $user['nom'] . '</td>';
                    echo '<td>' . $user['prenom'] . '</td>';
                    echo '<td>
                             <a class="btn btn-secondary btn-sm" href="read-artiste.php?id=' .  $user['id'] . '">Consulter</a>
                             <a class="btn btn-danger btn-sm" href="delete-artiste.php?id=' .  $user['id'] . '">Supprimer</a>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </table>
			</div>
            <div class="container">
            <h4 id="title-c">Les inscriptions à la newsletter :</h4>
		    <?php 
            include('includes/db.php');
            ?>
            <?php
            $q = 'SELECT * FROM  NEWSLETTER ORDER BY id';
            $req = $bdd->query($q);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($results as $user){
                    echo '<tr>';
                    echo '<td>' . $user['id'] . '</td>';
                    echo '<td>' . $user['email'] . '</td>';;
                    echo '<td>
                             <a class="btn btn-secondary btn-sm" href="read-newsletter.php?id=' .  $user['id'] . '">Consulter</a>
                             <a class="btn btn-danger btn-sm" href="delete-newsletter.php?id=' .  $user['id'] . '">Supprimer</a>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </table>
			</div>
		</main>

		<?php include('includes/footer.php'); ?>
        <script src="js/search.js"></script>
        <script src="js/dark-mode.js"></script>
	</body>
    </html>
