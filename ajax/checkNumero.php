<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';

if (!empty($_POST['numero'])) {
    $numero = trim($_POST['numero']);

    $query = $db->prepare("SELECT 1 FROM utilisateur WHERE utilisateur_telephone = :numero");
    $query->bindValue(':numero', $numero);
    $query->execute();

    if ($query->fetch()) {
        echo "Ce numéro est déjà utilisé.";
    }
}
