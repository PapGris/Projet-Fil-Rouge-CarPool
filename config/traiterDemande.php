<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $demandeId = $_POST['demande_id'] ?? null;
    $trajetId = $_POST['trajet_id'] ?? null;
    $nombrePlaces = $_POST['nombre_places'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($demandeId && $trajetId && $nombrePlaces && $action) {

        // 🔹 Étape 1 : Récupérer les infos du demandeur et du trajet
        $demandeInfo = $db->prepare("
            SELECT d.utilisateur_id AS demandeur_id, t.trajet_lieu_depart, t.trajet_lieu_arrivee
            FROM demande_trajet d
            JOIN trajet t ON d.trajet_id = t.trajet_id
            WHERE d.demande_trajet_id = :id
        ");
        $demandeInfo->execute([':id' => $demandeId]);
        $info = $demandeInfo->fetch(PDO::FETCH_ASSOC);

        $demandeurId = $info['demandeur_id'];
        $lieuDepart = $info['trajet_lieu_depart'];
        $lieuArrivee = $info['trajet_lieu_arrivee'];
        $conducteurId = $_SESSION['id'] ?? null;

        // 🔹 Étape 2 : Traitement en fonction de l'action
        if ($action === 'accepter') {
            // Accepter la demande + réduire les places
            $db->beginTransaction();

            // Mise à jour du statut
            $update = $db->prepare("UPDATE demande_trajet SET statut = 'acceptee' WHERE demande_trajet_id = :id");
            $update->execute([':id' => $demandeId]);

            // Réduction des places disponibles
            $updatePlaces = $db->prepare("
                UPDATE trajet 
                SET trajet_nombre_places_disponibles = trajet_nombre_places_disponibles - :nb 
                WHERE trajet_id = :trajet_id
            ");
            $updatePlaces->execute([
                ':nb' => $nombrePlaces,
                ':trajet_id' => $trajetId
            ]);

            $db->commit();
        } elseif ($action === 'refuser') {
            // Refuser la demande
            $update = $db->prepare("UPDATE demande_trajet SET statut = 'refusee' WHERE demande_trajet_id = :id");
            $update->execute([':id' => $demandeId]);
        }

        // 🔹 Étape 3 : Message automatique de notification
        $messageTexte = ($action === 'accepter')
            ? "✅ Votre demande de réservation pour le trajet $lieuDepart → $lieuArrivee a été acceptée."
            : "❌ Votre demande de réservation pour le trajet $lieuDepart → $lieuArrivee a été refusée.";


        $insertNotif = $db->prepare("
            INSERT INTO message (message_contenu, message_date, message_statut, message_lu, utilisateur_id, utilisateur_id_1, message_type)
            VALUES (:contenu, NOW(), 0, 0, :expediteur, :destinataire, 'systeme')
        ");

        $insertNotif->execute([
            ':contenu' => $messageTexte,
            ':expediteur' => $conducteurId,
            ':destinataire' => $demandeurId
        ]);

        // 🔹 Redirection finale
        header("Location: ../notificationUtilisateur.php?confirmation=1");
        exit;
    }
}
