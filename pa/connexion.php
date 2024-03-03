<?php 
$title = 'Connexion';
include('includes/head.php'); 
?>
<body>
<?php include('includes/header1.php');?>  
    <div class="top-body">
        <div id="form-conex">
            <h3 class="title_ins" >Connectez-vous</h3>
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
            <?php
            if(isset($_POST['email'])) {
                $_SESSION['email'] = $_POST['email'];
            }
            ?>
            <form id="login" class="input-group-cli" method="POST" action="vérification-connexion-client.php">
                <input type="email" class="input-field" name="email" placeholder="Email" value="<?= isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : '' ?>">
                <input type="password" class="input-field" name="pwd" placeholder="Mot de passe">
                <a id="reset" href="reset-password-form.php">Mot de passe oublié ? </a>
                <input type="submit" class="btn-conex" value="Se connecter">
            </form>
            
            <form id="login-art" class="input-group-art" method="POST" action="vérification-connexion-artiste.php">
                <input type="email" class="input-field" name="email" placeholder="Email">
                <input type="password" class="input-field" name="pwd" placeholder="Mot de passe">
                <a id="reset" href="reset-password-form.php">Mot de passe oublié ? </a>
                <input type="submit" class="btn-conex" value="Se connecter">
            </form>
            <p style="font-size: 14px; margin-top: 280px;">Vous n'avez pas un compte ? <a href="inscription.php">S'inscrire</a></p>
            </div>
        <img  id ="image_login"  src="images/artist_set_3.png" height="500px">
    </div>
<script>
    var x=document.getElementById('login');
    var y=document.getElementById('login-art');
    var z=document.getElementById('btn');
    
    function artiste()
    {
        x.style.left='-400px';
        y.style.left='70px';
        z.style.left='130px';
    }
    function client()
    {
        x.style.left='0px';
        y.style.left='450px';
        z.style.left='0px';
    }
</script>
<script>
    var modal = document.getElementById('top-body');
    window.onclick = function(event) 
    {
        if (event.target == modal) 
        {
            modal.style.display = "none";
        }
    }
</script>
<script>
            const toggleButton = document.getElementById('toggle');
            const body = document.body;

            toggleButton.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            });
</script>
<?php include('includes/footer.php');?>
    </body>
</html>