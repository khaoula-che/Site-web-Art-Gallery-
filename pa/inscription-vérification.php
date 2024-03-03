<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription</title>
        <link rel="stylesheet" href="bootstrap/scss/bootstrap.scss">
        <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <header>
             <div class="menu">
                 <img class="logo" src="images/logo.png" height="75px">
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
                     <a href="">Connexion</a>
                     <a href="">Inscription</a>
                  </div>
            </div>  
        </header>>
        <div id="login-form">
            <div class="form-box" id="form">
                <div class="breadcrumb">
                       <ul>
                          <li><p  class="bred-p">1</p></li>
                          <li><p class="bred-p">2</p></li>
                          <li><p id= "third-child"class="bred-p">3</p></li>
                       </ul>
                </div>
                <div id="icon">
                    <img src="images/icon-enve.png" height="150px">
                    <h2>Merci pour votre inscription ! </h2>
                    <hr class="featurette-divider">
                <div class="ver-in">
                <p>Nous avons bien reçu votre demande d'inscription. </p>
                <p>Pour finaliser votre inscription, veuillez cliquer sur le lien de vérification que nous vous avons envoyé à votre adresse e-mail.</p>        
                </div>
                </div>
            </div>
        </div>
    </div>
        <script>
        var x=document.getElementById('login');
		var y=document.getElementById('register');
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