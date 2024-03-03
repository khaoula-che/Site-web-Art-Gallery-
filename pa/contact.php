<?php
session_start();
$title = 'Contact';
include('includes/head.php');
?>
<body>
    <?php include('includes/header1.php');?>
    <div id="login-form">
            <div class="form-message">
                <h3 class="title_ins" >Contactez-nous !</h3>
                <form id="register" class="input-group-cli"  action="envoyer-message.php" method="post">
                    <label for="nom">Nom :</label>
                    <input type="text" class="input-field" id="nom" name="nom"><br>

                    <label for="email">Email : </label>
                    <input type="email" class="input-field" id="email" name="email"><br>

                    <label for="titre">Titre : </label>
                    <input type="text" class="input-field" id="titre" name="titre"><br>

                    <label id="label-message" for="message">Message :</label>
                    <textarea id="message" name="message"></textarea><br>

                    <input type="submit" class="submit-btn" value="Envoyer">
                </form>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    </body>
</html>