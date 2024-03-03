<?php 
$title = 'Inscription';
include('includes/head.php'); 
?>
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
				  echo '<p style="font-size: 13px;">' . htmlspecialchars($_GET['message']) . '</p>';
			     }
			    ?>
                <?php 
			        if(isset($_GET['message2']) && !empty($_GET['message2'])){
				      echo '<p style="font-size: 13px">' . htmlspecialchars($_GET['message2']) . '</p>';
			        }
			         ?>
                <form id="register" class="input-group-cli" method="POST" action="vérification-inscription-client.php">
                    <input type="text" class="input-field" name="pseudo" placeholder="Nom d'utilisateur">
		            <input value="<?= isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : '' ?>" type="email" class="input-field" name="email" placeholder="Email">
                    <input type="password" class="input-field" name="pwd" placeholder="Mot de passe">
                    <label style="font-size: 11px;" for="pwd">Entre 6 et 12 caractères</label>
		            <input type="password" class="input-field" name="pwd2" placeholder="Confirmer le mot de passe">
                    <input type="submit" class="submit-btn" value="Inscription">
		        </form>
                
            </div>
        </div>
    </div>
    <script src="js/dark-mode.js"></script>
    <?php include('includes/footer.php');?>
    </body>
</html>