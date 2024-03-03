<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
    </head>
    <body>
        <?php include('includes/header1.php');?>
        <div id="login-form" class="login-page">
            <div class="form-box">
            <h3 class="title_ins" >Inscription</h3>
                <div class="breadcrumb">
                       <ul>
                          <li><p class="bred-p">1</p></li>
                          <li><p id="second-child"class="bred-p">2</p></li>
                          <li><p  class="bred-p">3</p></li>
                       </ul>
                </div>
                <?php 
			    if(isset($_GET['message']) && !empty($_GET['message'])){
				  echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
			     }
			    ?>
                <form id="register" class="input-group-art" method="POST" action="vérification-inscription-artiste.php">
                    <input type="text" class="input-field" name="pseudo" placeholder="Nom d'utilisateur">
		            <input value="<?= isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : '' ?>" type="email" class="input-field" name="email" placeholder="Email">
                    <input type="password" class="input-field" name="pwd" placeholder="Mot de passe">
                    <label style="font-size: 11px;" for="pwd">Entre 6 et 12 caractères</label>
                    <?php 
			        if(isset($_GET['message2']) && !empty($_GET['message2'])){
				      echo '<p>' . htmlspecialchars($_GET['message2']) . '</p>';
			        }
			         ?>
		            <input type="password" class='input-field' name="pwd2" placeholder="Confirmer le mot de passe">
                    <input type="submit" class="submit-btn" value="Suivant">
		        </form>
            </div>
        </div>
    </div>
    </body>
    <footer>
        <div class="mb-5"> <!-- 5 = 3rem--> 
            <div class="menu_footer" >
                <div class="menu_title">
                     <h3 ><strong>Service client</strong></h3>
                     <a href="">Nous contacter</a>
                     <a href="">Votre oeuvre sur mesure</a>
                     <a href="">Mon compte</a>
                 </div>
                 <div class="menu_title">
                     <h3 ><strong>Qui sommes nous?</strong></h3>
                     <a href="">A propos de nous</strong></a>
                     <a href="">CGU</a>
                 </div>
                 <div class="menu_title">
                      <h3 ><strong>Etes-vous créateur ?</strong> </h3>
                      <a href="">Comment nous rejoindre en tant qu'artiste</a>
                      <a href="">Connexion</a>
                      <a href="">Aide</a>
                 </div>
        </div>
        </div>
        <div class="menu-footer2">
            <div class="top_footer">
                <a href=""><img class="image_rs" src="images/instagramlogo.png" height="27px"></a>
                <a href=""><img class="image_rs" src="images/facebooklogo.png" height="27px"></a>
                <a href=""><img  class="image_rs" src="images/pinterest logo.png" height="27px"></a>
                <a href=""><img  class="image_rs" src="images/logotiktok.png" height="26px"></a>
            </div>
            <div class="menu-top-footer">
                <p>GALLERIE</p>
                <p>|</p>
                <p>EXPOSITIONS</p> 
                <p>|</p>
                <p>BLOG</p> 
            </div>
            <hr class="featurette-divider">
            <p class="copyright">© 2023 Arts Gallery</p> <!-- 2 = 	0.5rem  --> 
        </div> 
    </footer>
</html>