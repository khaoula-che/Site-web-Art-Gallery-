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
    <script src="js/dark-mode.js"></script>
    <?php include('includes/footer.php');?>
    </body>

</html>