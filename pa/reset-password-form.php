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
        </header>>
        <div id="login-form">
            <div class="form-box-reset">
                <h3 style="text-align: center; padding-top:40px; padding-bottom:20px; margin:0px;" >Mot de passe oublié</h3>
                <p style=" text-align: center; padding:10px;">Si vous avez oublié votre mot de passe, veuillez entrer votre adresse e-mail enregistrée.<br>Nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
                <?php 
			    if(isset($_GET['message']) && !empty($_GET['message'])){
				  echo '<p style="font-size: 11px;">' . htmlspecialchars($_GET['message']) . '</p>';
			     }
			    
                if(isset($_POST['email'])) {
                $_SESSION['email'] = $_POST['email'];
                }
			    ?>
                
	            <form class="input-group-cli" method="post" action="reset-password.php">
                <div id="reset" >
	        	<input class="input-field" type="email" id="email" name="email" value="<?= isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : '' ?>" required>
	         	<input class="submit-btn-reset" type="submit" name="submit" value="Réinitialiser le mot de passe">
	            </form>
            </div>
            </div>
            
        </div>
    </div>
    </body>
    <?php include('includes/footer.php'); ?>
</html>
