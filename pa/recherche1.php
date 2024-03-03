<?php
include('includes/db.php');
$pseudo = $_GET['pseudo'];
$sql = "SELECT id, nom, prenom, email, pseudo FROM ARTISTE";
$stmt = $bdd->query($sql);
$users = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<div>";
foreach($users as $user){
    echo '<table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>Action</th>
                </tr>';
            echo '<tr>';
                    echo '<td>' . $user['id'] . '</td>';
                    echo '<td>' . $user['pseudo'] . '</td>';
                    echo '<td>' . $user['email'] . '</td>';
                    echo '<td>' . $user['nom'] . '</td>';
                    echo '<td>' . $user['prenom'] . '</td>';
                    echo '<td>
                             <a class="btn btn-secondary btn-sm" href="read-client.php?id=' .  $user['id'] . '">Consulter</a>
                             <a class="btn btn-danger btn-sm" href="delete-client.php?id=' .  $user['id'] . '">Supprimer</a>
                          </td>';
                    echo '</tr>
                    </table>';
}
echo "</div>";
?>