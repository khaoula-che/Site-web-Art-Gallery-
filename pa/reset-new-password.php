<?php
session_start();
// Vérifie si le jeton de réinitialisation de mot de passe est présent dans l'URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

        // Le jeton est valide, affichez le formulaire de réinitialisation du mot de passe
        echo '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Réinitialiser le mot de passe</title>
            </head>
            <body>
                <h1>Réinitialiser le mot de passe</h1>
                <form method="post" action="update_password.php">
                    <input type="hidden" name="token" value="' . $token . '">
                    <label for="password">Nouveau mot de passe:</label>
                    <input type="pwd" id="pwd" name="pwd" required>
					<input type="submit" name="submit" value="Réinitialiser le mot de passe">
				</form>
			</body>
			</html>
		';
	} 

?>
