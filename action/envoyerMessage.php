<?php
require_once 'config/db.php';
require_once 'config/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destinataire_id = (int)$_POST['destinataire_id'];
    $message_contenu = trim($_POST['message_contenu']);

    if (!empty($destinataire_id) && !empty($message_contenu)) {
        $query = "INSERT INTO message (message_contenu, message_date, message_statut, utilisateur_id, trajet_id, utilisateur_id_1)
                VALUES (:contenu, NOW(), 0, :expediteur_id, NULL, :destinataire_id)";

        $stmt = $db->prepare($query);
        $stmt->bindValue(':contenu', $message_contenu);
        $stmt->bindValue(':expediteur_id', $_SESSION['utilisateur']['utilisateur_id']);
        $stmt->bindValue(':destinataire_id', $destinataire_id);

        if ($stmt->execute()) {
            header('Location: profilPublic.php?id=' . $destinataire_id . '&message=envoye');
            exit();
        } else {
            echo "Erreur lors de l'envoi du message.";
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
} else {
    header('Location: index.php');
    exit();
}
