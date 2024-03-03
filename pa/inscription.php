<?php 
$title = 'Inscription';
include('includes/head.php'); 
?>
    <body>
<?php include('includes/header1.php'); ?>
        <div id="login-form">
            <div class="form-box">
                <h3 class="title_ins" >Inscription</h3>
                <div class="breadcrumb">
                       <ul>
                          <li><p id= "first-child" class="bred-p">1</p></li>
                          <li><p class="bred-p">2</p></li>
                          <li><p class="bred-p">3</p></li>
                       </ul>
                </div>
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" onclick="client()" class="toggle-btn">Client</button>
                    <button type="button" onclick="artiste()" class="toggle-btn">Artiste</button>
                </div>
                <?php 
                if(isset($_GET['message']) && !empty($_GET['message'])){
                    echo '<p style="font-size: 11px;">' . htmlspecialchars($_GET['message']) . '</p>';
                }
                ?>
                <form id="register" class="input-group-cli" method="POST" action="vérification.php">
                    <input type="text" class="input-field" name="nom_client" placeholder="Nom">
                    <input type="text" class="input-field" name="prenom_client" placeholder="Prénom">
                    <input type="submit" class="submit-btn" value="Suivant">
		        </form>
                
		        <form id="register-art" class="input-group-art" method="POST" action="vérification2.php">
		            <input type="text" class="input-field" name="nom_artiste" placeholder="Nom">
                    <input type="text" class="input-field" name="prenom_artiste" placeholder="Prénom">
                    <input type="submit" class="submit-btn" value="Suivant">
	            </form>
            </div>
        </div>
    </div>
        <script>
        var x=document.getElementById('register');
		var y=document.getElementById('register-art');
		var z=document.getElementById('btn');
        
		function artiste()
		{
			x.style.left='-400px';
			y.style.left='80px';
			z.style.left='110px';
		}
		function client()
		{
			x.style.left='0px';
			y.style.left='450px';
			z.style.left='0px';
		}
	</script>
	<script>
        var modal = document.getElementById('login-form');
        window.onclick = function(event) 
        {
            if (event.target == modal) 
            {
                modal.style.display = "none";
            }
        }
    </script>
<script src="js/dark-mode.js"></script>
    <?php include('includes/footer.php');?>
    </body>
</html>