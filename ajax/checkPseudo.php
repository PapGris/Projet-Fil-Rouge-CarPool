<?php
require '../config/db.php';

$query = $db->prepare("SELECT utilisateur_pseudo FROM utilisateur WHERE utilisateur_pseudo = :pseudo");
$query->bindValue(':pseudo',htmlspecialchars($_POST['pseudo']));
$query->execute();
$result = $query->fetch();

if ($result) {
    echo 'Ce pseudo existe deja';
}  

?>