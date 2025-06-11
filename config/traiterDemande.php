<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $demandeId = $_POST['demande_id'] ?? null;
    $trajetId = $_POST['trajet_id'] ?? null;
    $nombrePlaces = $_POST['nombre_places'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($demandeId && $trajetId && $nombrePlaces && $action) {
        if ($action === 'accepter') {
            // Accepter la demande + réduire les places
            $db->beginTransaction();

            // Update statut de la demande
            $update = $db->prepare("UPDATE demande_trajet SET statut = 'acceptee' WHERE demande_trajet_id = :id");
            $update->execute([':id' => $demandeId]);

            // Réduire les places disponibles du trajet
            $updatePlaces = $db->prepare("UPDATE trajet SET 	trajet_nombre_places_disponibles = trajet_nombre_places_disponibles - :nb WHERE trajet_id = :trajet_id");
            $updatePlaces->execute([
                ':nb' => $nombrePlaces,
                ':trajet_id' => $trajetId
            ]);

            $db->commit();
        } elseif ($action === 'refuser') {
            $update = $db->prepare("UPDATE demande_trajet SET statut = 'refusee' WHERE demande_trajet_id = :id");
            $update->execute([':id' => $demandeId]);
        }

        // Redirection avec message
        header("Location: ../notificationUtilisateur.php?confirmation=1");
        exit;
    }
}
