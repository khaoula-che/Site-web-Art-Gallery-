<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modifier votre profil</title>
    </head>
    <body>      
        <div>Modification</div>
        <form method="post" action="modification-profile-test.php">
            <?php
                if (isset($er_nom)){
     
                    echo '<div>'$er_nom '</div>';
        
                }
            ?>
            <input type="text" placeholder="Votre nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }else{ echo $results['nom'];}?>" required>   
            <?php
                if (isset($er_prenom)){
                ?>
                    <div><?= $er_prenom ?></div>
                <?php   
                }
            ?>
            <input type="text" placeholder="Votre prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }else{ echo $results['prenom'];}?>" required>   
            <?php
                if (isset($er_mail)){
                ?>
                    <div><?= $er_mail ?></div>
                <?php   
                }
            ?>
            <input type="email" placeholder="Adresse mail" name="email" value="<?php if(isset($mail)){ echo $mail; }else{ echo $results['email'];}?>" required>
            <button type="submit" name="modification">Modifier</button>
        </form>
    </body>
</html>