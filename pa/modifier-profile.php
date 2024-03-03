<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=arts_gallery', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(Exception $e) {
    die('Erreur PDO : ' . $e->getMessage());
}

$req = $bdd->prepare('SELECT * FROM client WHERE id = :id');
$req->execute(['id' => $_SESSION['id']]);
$user = $req->fetch();

if(!empty($_POST)){
    extract($_POST);

    $valid = true;

    if(!isset($_POST['form1'])){
        if (isset($_POST['email'])){
            $valid = false;
            $msg ="Le champ ne peut pas etre vide"; 
        }else {
            $req = $bdd->prepare('SELECT * FROM client WHERE email = :email');
            $req->execute(['email' => $_SESSION['email']]);
            $results = $req->fetchAll();
        }
        if (isset($req['id'])){
            $valid = false;
            $msg ="L'e-mail est déja utilisé !";

        }

    }else if(isset($_POST['form2'])) {

    }

    if(isset($email)){
        $email = $_SESSION['email'];
    }
}


?>

<form action="modification_profile.php" method="post">
  <?php
   if(isset($_GET['message']) && !empty($_GET['message'])){
    echo '<p style="font-size: 11px;">' . htmlspecialchars($_GET['message']) . '</p>';
   }
  ?>
  <label for="nom">Nom :</label>
  <input type="text"  name="nom" value=" <?php echo  $_SESSION['email'] ;  ?>"><br>

  <label for="prenom">Prénom :</label>
  <input type="text" name="prenom"><br>

  <label for="email">Email :</label>
  <input type="email"  name="email" ><br>

  <label for="login">Login :</label>
  <input type="text" id="login" name="login"><br>

  <input type="submit" name="form1" value="Modifier">
  </form>
  <form action="modification_profile.php" method="post">

  <label for="password">Mot de passe actuel :</label>
  <input type="password" id="password" name="pwd">

  <label for="password">Nouveau mot de passe :</label>
  <input type="password" id="password" name="pwd">

  <label for="password">Confirmation de mot de passe :</label>
  <input type="password" id="password" name="pwd" placeholder="Confirmer le mot de passe">
  
  <input type="submit" name="form2" value="Modifier">
</form>