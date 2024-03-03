<?php
require('includes/db.php');
$q = "SELECT id, nom, prix, description, image FROM ARTICLE";
$stmt = $bdd->query($q);
$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<div>";
foreach($cards as $card){
    echo "<p>";
    echo $card['nom'];
    echo "</p>";
}
echo "</div>";
?>