<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/session.php';

$utilisateurConnecteId = $_SESSION['id'] ?? null;
$autreUtilisateurId = $_GET['id'] ?? null;

if (!$utilisateurConnecteId || !$autreUtilisateurId) {
    die("Accès non autorisé.");
}

// Récupérer tous les messages entre les deux utilisateurs
$query = $db->prepare("
    SELECT m.*, u.utilisateur_pseudo 
    FROM message m
    JOIN utilisateur u ON m.utilisateur_id = u.utilisateur_id
    WHERE 
        (m.utilisateur_id = :id1 AND m.utilisateur_id_1 = :id2)
     OR (m.utilisateur_id = :id2 AND m.utilisateur_id_1 = :id1)
    ORDER BY m.message_date ASC
");
$query->execute([
    ':id1' => $utilisateurConnecteId,
    ':id2' => $autreUtilisateurId
]);
$messages = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpool - Historique Messagerie</title>
    <link rel="stylesheet" href="CSS/styleHistoriqueMessage.css">
    <link rel="stylesheet" href="CSS/styleHeaderBurgerFooterConnecte.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search_hands_free" />
    <link rel="icon" type="image/png" href="Images/favicon.ico" sizes="96x96" />
    <script src="JS/script.js" defer></script>
    <script src="JS/scriptModalMessage.js" defer></script>
</head>

<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <h2>Historique des messages</h2>
    <div class="messagesHistorique">
        <?php if ($messages): ?>
            <?php foreach ($messages as $msg): ?>
                <div class="message">
                    <strong><?= htmlspecialchars($msg['utilisateur_pseudo']) ?> :</strong>
                    <p><?= nl2br(htmlspecialchars($msg['message_contenu'])) ?></p>
                    <small><?= date('d/m/Y H:i', strtotime($msg['message_date'])) ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun message échangé.</p>
        <?php endif; ?>
    </div>
    <div>
        <a href="notificationUtilisateur.php"><button class="retour">Retour aux notifications</button></a>
    </div>


    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>

</body>

</html>