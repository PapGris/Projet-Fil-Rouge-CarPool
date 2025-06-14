<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

$utilisateurId = $_SESSION['id'] ?? null;
$messageId = $_POST['message_id'] ?? null;

if ($utilisateurId && $messageId) {
    // Vérifie que l'utilisateur est bien destinataire du message
    $verif = $db->prepare("SELECT * FROM message WHERE message_id = :id AND utilisateur_id_1 = :uid");
    $verif->execute([':id' => $messageId, ':uid' => $utilisateurId]);

    if ($verif->rowCount() > 0) {
        $update = $db->prepare("UPDATE message SET message_statut = 1 WHERE message_id = :id");
        $update->execute([':id' => $messageId]);
    }
}

// Redirection vers la page notifications
header("Location: ../notificationUtilisateur.php");
exit;
