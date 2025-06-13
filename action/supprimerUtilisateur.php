<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

if (!isset($_SESSION['id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: backoffice.php');
    exit;
}

$utilisateur_id = $_POST['utilisateur_id'] ?? null;

if ($utilisateur_id && is_numeric($utilisateur_id)) {
    // Récupérer les infos pour afficher après
    $stmt = $db->prepare("SELECT utilisateur_nom, utilisateur_prenom FROM utilisateur WHERE utilisateur_id = ?");
    $stmt->execute([$utilisateur_id]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur) {
        $nomPrenom = urlencode($utilisateur['utilisateur_nom'] . ' ' . $utilisateur['utilisateur_prenom']);

        // Supprimer l'utilisateur
        $stmt = $db->prepare("DELETE FROM utilisateur WHERE utilisateur_id = ?");
        $stmt->execute([$utilisateur_id]);

        // Rediriger avec un message GET
        header("Location: backoffice.php?supprime=1&nom={$nomPrenom}");
        exit;
    }
}

header('Location: ./backoffice.php');
exit;
