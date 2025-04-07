<?php
require '../config/db.php';

$query = $db->prepare("SELECT utilisateur_email FROM utilisateur WHERE utilisateur_email = :email");
$query->bindValue(':email', htmlspecialchars($_POST['email']));
$query->execute();
$result = $query->fetch();

if ($result) {
    echo 'Cet email existe deja';
}
