<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

$utilisateurId = $_SESSION['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $utilisateurId) {
    $trajetId = (int) $_POST['trajet_id'];
    $conducteurId = (int) $_POST['conducteur_id'];
    $nombrePlaces = (int) $_POST['nombre_places'];

    // Évite les duplicatas
    $verif = $db->prepare("SELECT * FROM demande_trajet WHERE utilisateur_id = :uid AND trajet_id = :tid AND statut = 'en_attente'");
    $verif->execute([':uid' => $utilisateurId, ':tid' => $trajetId]);
    if ($verif->rowCount() > 0) {
        $demandeExistante = $verif->fetch(PDO::FETCH_ASSOC);
        $placesExistantes = $demandeExistante['nombre_places'];

        header('Location: ../trajetReserve.php?msg=deja_fait&places=' . urlencode($placesExistantes));
        exit;
    }

    $stmt = $db->prepare("INSERT INTO demande_trajet (utilisateur_id, trajet_id, nombre_places, utilisateur_id_1, statut, date_demande)
                        VALUES (:uid, :tid, :places, :cid, 'en_attente', NOW())");

    $stmt->execute([
        ':uid' => $utilisateurId,
        ':tid' => $trajetId,
        ':places' => $nombrePlaces,
        ':cid' => $conducteurId,
    ]);

    // Récupération des infos du conducteur
    $requeteConducteur = $db->prepare("
        SELECT u.utilisateur_nom, u.utilisateur_prenom
        FROM utilisateur u
        JOIN trajet t ON t.utilisateur_id = u.utilisateur_id
        WHERE t.trajet_id = :trajet_id
        ");
    $requeteConducteur->execute([':trajet_id' => $trajetId]);
    $conduit = $requeteConducteur->fetch(PDO::FETCH_ASSOC);

    $nom = $conduit['utilisateur_nom'] ?? '';
    $prenom = $conduit['utilisateur_prenom'] ?? '';

    // Redirection vers trajetReserve.php avec infos en GET
    header('Location: ../trajetReserve.php?confirmation=1&nom=' . urlencode($nom) . '&prenom=' . urlencode($prenom) . '&places=' . urlencode($nombrePlaces));
    exit;
}
