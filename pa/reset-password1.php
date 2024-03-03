<?php 
$title = 'Réinitialisation mot de passe';
include('includes/head.php');
?>
    <body>
        <header>
             <div class="menu">
                 <a href="index.html"><img  class="logo" src="images/Logo.png" height="75px"></a>
                 <nav>
                     <ul>
                        <li>
                            <a href="">Blog</a>
                        </li>
                        <li>
                             <a href="" title="">Evènements</a>
                        </li>
                        <li>
                             <a href="" title="">A propos</a>
                        </li>
                        <li>
                             <a href="" title="">Contact</a>
                        </li>
                        
                     </ul>
                  </nav>
                  <div class="login">
                     <img src="" height="30px">
                     <a href="connexion.php">Connexion</a>
                     <a href="inscription.php">Inscription</a>
                  </div>
            </div>  
        </header>
        <div id="login-form">
            <div class="form-box-reset">
                <p style=" text-align: center; padding:10px; padding-top:100px">Un lien pour réinitialiser votre mot de passe a été envoyé à l'adresse mail <?php echo $_SESSION['email'] ;?> </p>
                <p class="remarque">REMARQUE : Les courriels peuvent subir un délai de quelques minutes.</p>
            </div>
        </div>
    </div>
    </body>
    <?php include('includes/footer.php'); ?>
</html>
