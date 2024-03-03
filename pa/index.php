<?php 
$title = 'Arts gallery';
include('includes/head.php');
?>
    <body >
        <?php include('includes/header1.php');?>         
        <main>
              <section class="banner">
                <div class="banner-top">
                    <h1 class="title" >Arts Gallery</h1>
                    <p class="mb-4" id="parag">Un intérieur unique avec nos pièces d’art </p> <!-- 4 = 1,5 rem --> 
                    <a  href="inscription.php" class="btn btn-primary"  role="button" data-bs-toggle="button">Découvrir</a>
                </div>
              </section>   
        </main>
        <div id="cookie_banner">
        <p>Arts gallery utilise des cookies pour assurer le bon fonctionnement et la sécurité du site et améliorer votre expérience sur notre site. En continuant à naviguer, vous acceptez les politiques de cookies.</p>
        <div class="cookie">
            <button id="accept_cookie" type="button" onclick="acceptCookies()">Accepter</button>
            <a id="lien_cookie" href="a-propos.php">En savoir plus </a>
         </div>
        </div>

      
        <section class="banner2">
            <div class="reveal">
               <h2>Galerie d'art en ligne</h2>
               <div class="text">
                   <p class="mb-1">Et pour quelles raisons les Beaux-Arts ne devraient rester accessibles qu’à l'élite ?</p>  <!-- 1 = 0.25rem --> 
                   <p class="mb-1">La galerie d’art en ligne Arts Gallery met sa passion dans la création artistique, toutes inspirations confondues et celà pour tous les publics.</p>
                   <p class="mb-1">Rendre accessible des œuvres d’Art, des œuvres sont créées par les mains d'artistes talentueux. </p>
                </div>
                <div class="row m-0" id="service">
                <div class="col-sm">
                    <img class="image-top" src="images/identité.png" height="60px">
                    <h4>Plateforme web communautaire Notation des vendeurs par les acheteurs.</h4>
                </div>
                <div class="col-sm">
                    <img class="image-top" src="images/communication.png" height="60px">
                    <h4>Possible négociation des prix et communication directe entre acheteur et vendeur.</h4>
                </div>
                <div class="col-sm">
                    <img class="image-top" src="images/paiment.png" height="60px">
                    <h4>Paiement en ligne sécurisé ou par virement.</h4>
                </div>
                <div class="col-sm">
                    <img class="image-top" src="images/Logo-retour-echange-colis-noir-379x400.png" height="60px">
                    <h4>Retours gratuits sous 30 jours sans justification.</h4>
                </div>
            </div>
            </div>
        </section>
        <section class="reveal">
            <div class="row " id="m_reveal" id="service">
                <div class="col-12 col-md-8">
                    <h2 class="featurette-heading fw-normal lh-1">Tableaux paysages</h2>
                    <p id="p-tableau">Art Gallery vous propose des peintures modernes et contemporaines variées et de qualité. Vous pouvez les découvrir au gré de vos envies ou en affinant votre recherche en fonction du thème, de la technique souhaitée ou selon votre budget.</p>
                    <div class="banner-top">
                        <a class="btn btn-secondary" id="bouton" role="button" data-bs-toggle="button" href="" style="color:black;">Voir plus</a>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <img id="image" src="images/sosuperawesome.jpg" height="320px">
                </div>
            </div>
        </section>
    
        </div>
        <section class="reveal">
            <div class="row" id="service">
                 <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">Tableaux scandinaves</h2>
                    <p>Vous aimez la verdure et les plantes ? Un tableau déco style scandinave mettant en valeur la flore sera parfait à proximité d’une plante d’intérieur. Le style scandinave est simple, épuré et s’inspire de la nature. Vous pourrez associer votre tableau décoration à n’importe quelle plante et mobilier de style scandinave.</p>
                    <div class="banner-top">
                    <a class="btn btn-secondary" id="bouton" role="button" data-bs-toggle="button" href="" style="color:black;">Voir plus
                    </a>
                    </div>
                 </div>
                <div class="col-md-4 ">
                    <img id="image" src="images/téléchargement (4).jpg" height="320px">
                </div>
           </div>
        </section>
        </div>
        <section class="ar-ins">
            <div class="banner-top">
                <h2>Rejoignez notre réseau d'artistes ! </h2>
                <p>Partagez, vendez et louez vos oeuvres artistiques. </p>
                <a href="inscription.php" id="bt" class="btn btn-primary" role="button" data-bs-toggle="button">Créer un compte</a>
            </div>
            
        </section>
        <section>
            <div class="newletter">
               <h5>Inscription Newletter</h5>
               <p>Inscrivez-vous et recevez les actualités en exclusivité de la platforme Arts Gallery tous les semaines !</p>
               <?php
                include('includes/message.php');
                ?>
               <form class="email_box" method="POST" action="newsletter.php">
                    <img src="images/enveloppe.png" height="40px">
                    <input class="tbox" type="text" name="email" placeholder="Entrez votre mail">
                    <input class="box" type="submit" value="Inscription">
                </form>
                <p class="newletter-p">En vous inscrivant vous acceptez nos <a href=""> CGV </a> et notre <a href="">politique de confidentialité et cookies.</a></p>
            </div>
            <?php include('includes/footer.php');?>
<script>
function acceptCookies() {
    const cookieBanner = document.getElementById('cookie_banner');
    const acceptButton = document.getElementById('accept_cookie');

    acceptButton.addEventListener('click', () => {
    cookieBanner.style.display = 'none';
});
}
</script>
<script src="js/dark-mode.js"></script>
<script src="js/animation.js"></script>

</body>
</html>