<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acceuil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="images/png.png" sizes="20x20">
    </head>
    <body>
        <script src="animation.js"></script>   
        <?php include('includes/header.php')?>
        <main>
            
        <h2 class="title-carousel">Nouveautés</h2>
        <p>Découvrez les dernières arrivées</p>
        <?php
        
        $q = "SELECT * FROM ARTICLE ORDER BY id_article DESC LIMIT 3";
        $stmt = $bdd->prepare($q);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="carousel1">
        <div class="carousel1-container">
            <?php foreach($articles as $article){?>
            <div class="carousel1-item">
                <img src="<?= $article['image'] ?>" alt="<?= $article['nom'] ?>">
            </div>
            <?php } ?>
        </div>
        <div class="carousel1-nav">
        <button class="carousel1-prev">&lt;</button>
        <button class="carousel1-next">&gt;</button>
        </div>
        </div>
        
        <script>
        const carousel = document.querySelector('.carousel1');
        const container = carousel.querySelector('.carousel1-container');
        const prevBtn = carousel.querySelector('.carousel1-prev');
        const nextBtn = carousel.querySelector('.carousel1-next');
        const items = carousel.querySelectorAll('.carousel1-item');
        const size = items[0].clientWidth + 20; // adding margin-right value

        let index = 0;

        nextBtn.addEventListener('click', () => {
        if (index < items.length - 1) {
        index++;
        container.style.transform = `translateX(${-size * index}px)`;
        checkButtons();
        }
        });

        prevBtn.addEventListener('click', () => {
        if (index > 0) {
        index--;
        container.style.transform = `translateX(${-size * index}px)`;
        checkButtons();
        }
        });

        function checkButtons() {
        if (index === 0) {
        prevBtn.disabled = true;
        } else {
        prevBtn.disabled = false;
        }

        if (index === items.length - 1) {
        nextBtn.disabled = true;
        } else {
        nextBtn.disabled = false;
        }
        }

        </script>
        </main>
        <div class="section">
        <h2>Quel est votre style ?</h2>
        <p style="margin-bottom:20px ;">Explorez nos oeuvres par thèmes, des sélections d'œuvres d'art par thématiques réalisées par nos curateurs experts</p>
        <div class="cards">
        <a href="" id="card3"><span>Paysage</span></a>
        <a href="" id="card1"><span>Portrait</span></a>
        <a href="" id="card2"><span>scandinaves</span></a>
        <a href="" id="card4"><span>Urbain</span></a>
        <a href="" id="card5"><span>Abstraction</span></a>
        <a href="" id="card6"><span>Culture<br> Populaire</span></a>
        </div>
        </div>
            <div class="newletter">
               <h5>Inscription Newletter</h5>
               <p>Inscrivez-vous et recevez les actualités en exclusivité de la platforme Arts Gallery tous les semaines !</p>
               <form class="email_box" method="POST" action="newsletter.php">
                    <img src="images/enveloppe.png" height="40px">
                    <input class="tbox" type="text" name="email" placeholder="Entrez votre mail">
                    <input class="box" type="submit" value="Inscription">
                </form>
                <p class="newletter-p">En vous inscrivant vous acceptez nos <a href=""> CGV </a> et notre <a href="">politique de confidentialité et cookies.</a></p>
            </div>
            <script src="js/dark-mode.js"></script>
            <?php include('includes/footer.php'); ?>
    </body>
</html>