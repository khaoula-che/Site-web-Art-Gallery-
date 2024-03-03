<?php
require('includes/db.php');
$q = "(SELECT id, nom, pseudo, prenom, email FROM CLIENT ) UNION SELECT id, nom, pseudo, prenom, email FROM ARTISTE )";
$stmt = $bdd->query($q);
$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<div>";
foreach($cards as $card){
    echo "<p>";
    echo $card['nom'];
    echo $card['prenom'];
    echo $card['pseudo'];
    echo $card['email'];
    echo "</p>";
}
echo "</div>";
?>