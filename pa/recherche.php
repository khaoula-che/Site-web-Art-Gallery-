<?php
if(isset($_GET['pseudo']) && !empty($_GET['pseudo'])){
    $pseudo = $_GET['pseudo'];
    include('includes/db.php');
    $sql = "SELECT id, nom, prenom, email, pseudo FROM ARTISTE WHERE pseudo LIKE ?";

    $stmt = $bdd->prepare($sql);
    $success = $stmt->execute([
        "%" .$pseudo . "%"
    ]);
    if($success){
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    }
}
?>



